<!-- Halaman List Berita Admin  -->

<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<section class="p-4" id="main-content">

  <button class="btn btn-primary" id="button-toggle">
    <i class="bi bi-list"></i>
  </button>

  <div class="card shadow mb-4 border-2" style="margin-top: 25px;">

    <div class="card-header py-3">

      <div class="d-sm-flex align-items-center justify-content-between" style="padding-top: 10px;">
        <h6 class="m-0 font-weight-bold text-primary">Berita Disdukcapil Majalengka</h6>

        <!-- Method Create untuk Menampilkan Form Insert Data -->
        <a href="/admin/create_berita_admin/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Berita</a>
      </div>

    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>

      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata(); ?>
      </div>

    <?php endif; ?>

    <div class="card-body">
      <table class="table table-fixed table-hover">

        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Foto Berita</th>
            <th scope="col">Judul</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($berita as $b) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><img src="/img/berita/<?= $b['fotoberita']; ?>" class="foto_berita" alt="..."></td>
              <td><?= $b['judulberita']; ?></td>
              <td><?= $b['keteranganberita']; ?></td>
              <td>
                <a href="/admin/detail_berita_admin/<?= $b['judulberita']; ?>" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>

</section>

<?= $this->endSection('contentadmin'); ?>