<div class="row">
  <div class="col-md-12">
    <div class="card-form">
      <h4><i class="fa fa-pencil"></i> Edit User: <?= htmlspecialchars($user['username']) ?></h4>

      <?php if(isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
      <?php endif; ?>
      <?php if(isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('user/edit/' . urlencode($user['username'])) ?>">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" disabled>
        </div>

        <div class="form-group">
          <label>Password <small>(kosongkan jika tidak ingin diubah)</small></label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password baru jika ingin mengganti">
        </div>

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
        </div>

        <div class="text-center">
          <button class="btn btn-submit"><i class="fa fa-save"></i> Update</button>
          <a href="<?= site_url('user') ?>" class="btn btn-default">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
