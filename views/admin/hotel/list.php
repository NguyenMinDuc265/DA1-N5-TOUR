<?php headerAdmin() ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Danh sách khách sạn</h2>
    <a href="admin.php?act=hotel_add_form" class="btn btn-primary">+ Thêm khách sạn</a>
</div>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" id="flash-message">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" id="flash-message">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khách sạn</th>
                    <th>Địa chỉ</th>
                    <th>Người quản lý</th>
                    <th>SĐT quản lý</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $index => $hotel): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($hotel['name']) ?></td>
                        <td><?= htmlspecialchars($hotel['address'] ?? '') ?></td>
                        <td><?= htmlspecialchars($hotel['manager_name'] ?? '') ?></td>
                        <td><?= htmlspecialchars($hotel['manager_phone'] ?? '') ?></td>
                        <td>
                            <a class="detail" href="admin.php?act=hotel_assign_tours_form&id=<?= $hotel['hotel_id'] ?>">Gán Tour</a>
                            <a class="edit" href="admin.php?act=hotel_edit_form&id=<?= $hotel['hotel_id'] ?>">Sửa</a>
                            <a class="delete" href="admin.php?act=hotel_delete&id=<?= $hotel['hotel_id'] ?>" onclick="return confirm('Xóa khách sạn này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($hotels)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Chưa có khách sạn nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php footerAdmin() ?>

<script>
    const flash = document.getElementById('flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.transition = "opacity 0.5s ease";
            flash.style.opacity = "0";
            setTimeout(() => flash.remove(), 500);
        }, 2000);
    }
</script>
