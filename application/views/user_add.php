<div class="row">
  <div class="col-md-12">
    <div class="card-form">
      <h4><i class="fa fa-user-plus"></i> Tambah User</h4>

      <?php if(isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
      <?php endif; ?>
      <?php if(isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('user/add') ?>">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required placeholder="username">
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required placeholder="password">
        </div>

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control" required placeholder="Nama lengkap">
        </div>

        <div class="form-group">
          <label>Email (opsional)</label>
          <input type="email" name="email" class="form-control" placeholder="email@domain.com">
        </div>

        <div class="text-center">
          <button class="btn btn-submit"><i class="fa fa-save"></i> Simpan</button>
          <a href="<?= site_url('user') ?>" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
