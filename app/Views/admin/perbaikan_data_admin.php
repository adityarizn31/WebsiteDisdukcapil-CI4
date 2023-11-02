<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<section class="p-4" id="main-content">

  <button class="btn btn-primary" id="button-toggle">
    <i class="bi bi-list"></i>
  </button>

  <div class="card shadow mb-4" style="margin-top: 25px;">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Perbaikan Data</h6>
    </div>

    <div class="card-body">

      <table class="table table-fixed table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pemohon</th>
            <th scope="col">Email Pemohon</th>
            <th scope="col">No Whatsapp</th>
            <th scope="col">Permohonan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
      </table>

      <tbody>
        <tr>
          <?php $i = 1; ?>
          <?php foreach ($perbaikan_data as $perda) :  ?>
            <th scope="row"><?= $i++; ?></th>
            <td><?= $perda['namapemohon']; ?></td>
            <td><?= $perda['emailpemohon']; ?></td>
            <td><?= $perda['nomorpemohon']; ?></td>
            <td>Perbaikan Data</td>
            <td>
              <a href="/DetailAdmin/detail_perbaikandata_admin/<?= $perda['namapemohon']; ?>" class="btn btn-success">Detail</a>
            </td>
          <?php endforeach; ?>
        </tr>
      </tbody>

    </div>
  </div>

</section>

<?= $this->endSection('contentadmin'); ?>