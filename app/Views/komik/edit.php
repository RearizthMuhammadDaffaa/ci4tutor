<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col-8">
      <h2 class="my-3">Form Edit Data Komik</h2>


      <form action="/edit/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
       
        <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
        <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
        <div class="row mb-3">
          <label for="judul" class="col-sm-2 col-form-label">judul</label>
          <div class="col-sm-10">
            <input type="text" name="judul" class="form-control <?= ($validation && $validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="judul" value="<?= (old('judul')) ? old('judul'): $komik['judul'] ?>" autofocus>
            <!-- <div class="invalid-feedback">
            
           </div> -->
            <?php if ($validation && $validation->hasError('judul')): ?>
              <div class="invalid-feedback">
                <?= $validation->getError('judul'); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" name="penulis" class="form-control" id="penulis"value="<?= (old('penulis')) ? old('penulis'): $komik['penulis'] ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
          <div class="col-sm-10">
            <input type="text" name="penerbit" class="form-control" id="penerbit " value="<?= (old('penerbit')) ? old('penerbit'): $komik['penerbit'] ?>" autofocus>
          </div>
        </div>
        <div class="row mb-3">
          <label for="sampul" class="col-sm-2 col-form-label">sampul</label>
          <div class="col-sm-4">
            <img src="/img/<?= $komik['sampul']; ?>" class="img-thumbnail img-preview" alt="">
          </div>
          <div class="col-sm-8">
            <div class="mb-3">
              <label for="Sampul" class="form-label"><?= $komik['sampul']; ?></label>
              <input class="form-control <?= ($validation && $validation->hasError('sampul')) ? 'is-invalid' : '' ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
              <?php if ($validation && $validation->hasError('judul')): ?>
                <div class="invalid-feedback">
                  <?= $validation->getError('judul'); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" class="btn btn-primary">Edit data</button>
      </form>

    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>