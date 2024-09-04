<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
      
      
      $data = [
        'title'=> 'Home | Rearizth Muhammad Daffaa'
      ];      
        return view('pages/home',$data);
    }

    public function about(){
      $data = [
        'title'=> 'About Me'
      ];
      echo view('pages/about',$data);
    }

    public function contact()
    {
      $data = [
        'title' => 'Contact us',
        'alamat' => [
          [
            'tipe' => 'rumah',
            'alamat' => 'JL jusyan No 111',
            'kota' => 'Sumedang'
          ],
          [
            'tipe' => 'Kantor',
            'alamat' => 'JL Cimalaka No 222',
            'kota' => 'Sumedang'
          ]
        ]
      ];
      return view('pages/contact',$data);
    }
}
