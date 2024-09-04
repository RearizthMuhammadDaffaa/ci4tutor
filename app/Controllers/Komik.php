<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\CodeIgniter;

class Komik extends BaseController
{
  protected $komikModel;
  
  public function __construct()
  {
    $this->komikModel = new KomikModel();
    
  }
  public function index()
  {
    // $komik = $this->komikModel->findAll();

    $data = [
      'title' => 'Daftar Komik',
      'komik' => $this->komikModel->getKomik()
    ];
    return view('komik/index',$data);
  }

  public function detail($id = "")
  {
    $komik = $this->komikModel->getKomik($id);
    $data = [
      'title' => 'Detail Komik',
      'komik' => $this->komikModel->getKomik($id)
    ];
    // jika komik tidak ada ditabel
    if(empty($data['komik'])){
      throw new \CodeIgniter\Exceptions\PageNotFoundException("judul Komik $id tidak ditemukan");
    }
    return view('komik/detail',$data);
  }

  public function create()
  {
    $validation = session()->getFlashdata('validation');
    $data = [
      "title" => "Form Tambah Data Komik",
      'validation' => $validation
    ];

    
    
    return view("komik/create",$data);
  }

  public function save()
  {

     // validattion input
     if(!$this->validate([
      'judul' => [
        'rules' => 'required|is_unique[komik.judul]',
        'errors' => [
          'required' => '{field} komik harus diisi',
          'is_unique' => '{field} komik sudah ada'
        ]
      ],
      'sampul' => [
        'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mine_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {

      session()->setFlashdata('validation', $this->validator);
      return redirect()->to('/komik/create')->withInput();
      // $validation = \Config\Services::validation();
      // return redirect()->to('/komik/create')->withInput()->with('validation',$validation);
      // $data = [
      //   "title" => "Form Tambah Data Komik",
      //   'validation' => $validation
      // ];
      // return view("komik/create",$data);
    }
    
    // ambil gambar
    $fileSampul = $this->request->getFile('sampul');
    

    // apakah tidak ada gambar yang di upload
    if($fileSampul->getError() == 4){
      $namaSampul = 'default.png';
    }else{
      // generate nama sampul random
    $namaSampul = $fileSampul->getRandomName();
    // pindahkan file ke folder img
    $fileSampul->move('img',$namaSampul);
    // ambil nama file jika nama sesuai dengan yang di upload 
    // $namaSampul = $fileSampul->getName();
    }

    $slug = url_title($this->request->getVar('judul'),'-',true);
    $this->komikModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $namaSampul
    ]);
    
   
    session()->setFlashdata('pesan','Data berhasil ditambahkan.');

    return redirect()->to('/komik');
    
  }

  public function delete($id)
  {

    // cari gambar berdasarkan id
    $komik = $this->komikModel->find($id);

    // hapus gambar 
    // cek jika file gambar nya default
    if($komik['sampul'] != 'default.png'){
      unlink('img/' . $komik['sampul']);
    }
   

    $this->komikModel->delete($id);
    session()->setFlashdata('pesan','data berhasil dihapus.');
    return redirect()->to('/komik');
  }

  public function edit($id =" ")
  {
    $validation = session()->getFlashdata('validation');
    $data = [
      "title" => "Form Tambah Edit Komik",
      'validation' => $validation,
      'komik' => $this->komikModel->getKomik($id)
    ];

    

    
    
    return view("komik/edit",$data);
  }

  public function update($id)
  {
    
     // validattion input
     $komikLama = $this->komikModel->getKomik($id);

     if (!$komikLama) {
         throw new \CodeIgniter\Exceptions\PageNotFoundException("Komik dengan ID $id tidak ditemukan");
     }
 
     // Validasi input
     $rule_judul = $komikLama['judul'] === $this->request->getVar('judul') 
                   ? 'required' 
                   : 'required|is_unique[komik.judul]';
     if(!$this->validate([
      'judul' => [
        'rules' => $rule_judul,
        'errors' => [
          'required' => '{field} komik harus diisi',
          'is_unique' => '{field} komik sudah ada'
        ]
      ],
      'sampul' => [
        'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'Yang anda pilih bukan gambar',
          'mine_in' => 'Yang anda pilih bukan gambar'
        ]
      ]
    ])) {

      session()->setFlashdata('validation', $this->validator);
      return redirect()->to('/edit/'.$id)->withInput();
    }

    $fileSampul = $this->request->getFile('sampul');

    

    // cek gambar,apakah tetap gambar lama
    if($fileSampul->getError() == 4){
      // $namaSampul = $komikLama['sampul'];
      $namaSampul = $this->request->getVar('sampulLama');
    }else {
      // generate nama file random
      $namaSampul = $fileSampul->getRandomName();
      $fileSampul->move('img',$namaSampul);
      // hapus file lama
      // unlink('img/' . $komikLama['sampul']);
      unlink('img/' .$this->request->getVar('sampulLama'));
    }


    $slug = url_title($this->request->getVar('judul'),'-',true);
    $this->komikModel->save([
      'id' => $id,
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $namaSampul
    ]);
    
   
    session()->setFlashdata('pesan','Data berhasil diubah.');

    return redirect()->to('/komik');
  }
}