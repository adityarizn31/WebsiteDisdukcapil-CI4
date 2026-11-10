<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<section class="container py-5" style="min-height: 55vh; max-width: 760px;">
  <div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-md-5">
      <span class="badge bg-primary mb-3">Layanan Si Lancar</span>
      <h1 class="h3 fw-bold mb-2">Lacak Status Permohonan</h1>
      <p class="text-muted mb-4">Masukkan kode pelacakan yang diberikan setelah pengajuan. Demi menjaga privasi, halaman ini tidak menampilkan data pribadi.</p>

      <?php if (!empty($trackingError)) : ?>
        <div class="alert alert-warning" role="alert"><?= esc($trackingError); ?></div>
      <?php endif; ?>

      <form action="<?= site_url('lacak-permohonan/cari'); ?>" method="post" class="mb-4">
        <?= csrf_field(); ?>
        <label for="tracking_code" class="form-label fw-semibold">Kode Pelacakan</label>
        <div class="input-group">
          <input type="text" class="form-control text-uppercase" id="tracking_code" name="tracking_code" minlength="32" maxlength="32" pattern="[A-Fa-f0-9]{32}" autocomplete="off" required placeholder="Contoh: 8F3A...">
          <button type="submit" class="btn btn-primary">Lacak</button>
        </div>
        <div class="form-text">Kode terdiri dari 32 karakter huruf dan angka.</div>
      </form>

      <?php if (!empty($trackingResult)) : ?>
        <?php
          $status = $trackingResult['status'];
          $badgeClass = $status === 'Selesai' ? 'bg-success' : ($status === 'Belum Selesai' ? 'bg-danger' : 'bg-warning text-dark');
        ?>
        <div class="border rounded p-4 bg-light" aria-live="polite">
          <div class="small text-muted mb-1">Jenis layanan</div>
          <div class="fw-semibold mb-3"><?= esc($trackingResult['service']); ?></div>
          <div class="small text-muted mb-1">Status saat ini</div>
          <span class="badge <?= esc($badgeClass); ?> fs-6"><?= esc($status); ?></span>
          <div class="small text-muted mt-3">Kode permohonan tidak ditampilkan kembali demi keamanan.</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection('content'); ?>
