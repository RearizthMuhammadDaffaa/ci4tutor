<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">

  <div class="row">
    <div class="col">
      <h1 class="mt-2">Daftar Orang</h1>
      <form action="" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="keyword" placeholder="Masukkan keyword pencarian" >
        <button class="btn btn-outline-secondary"  type="submit" name="submit" id="button-addon2">Cari</button>
      </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">ALamat</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 + (6 * ($currentPage - 1)); ?>
          <?php foreach ($orang as $k): ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $k['nama']; ?></td>
              <td><?= $k['alamat']; ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <?= $pager->links('orang', 'orang_pagination'); ?>

    </div>
  </div>
</div>
<?= $this->endSection('content'); ?>