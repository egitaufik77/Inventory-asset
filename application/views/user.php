<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar User</h2>
        <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success">
            Tambah User
        </a>
    </div>

    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['flash_success']; ?></div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['flash_error']; ?></div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th style="width: 140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['priviledge'] == 1 ? 'Admin' : 'User'; ?></td>
                        <td>
                            <a href="<?php echo site_url('user/edit/'.$user['username']); ?>" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <a href="javascript:void(0);"
                               class="btn btn-sm btn-danger btn-delete"
                               data-url="<?php echo site_url('user/delete/'.$user['username']); ?>">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Belum ada data user.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Tambahkan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script konfirmasi hapus -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data user ini akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL delete
                    window.location.href = url;
                }
            });
        });
    });
});
</script>

<!-- Tambahkan sedikit margin agar tombol tambah user tidak mepet -->
<style>
.container {
    max-width: 95%;
}
.d-flex {
    margin-bottom: 15px;
}
.table {
    margin-top: 10px;
}
.btn {
    font-size: 14px;
}
.btn-success {
    padding: 8px 14px;
}
</style>
