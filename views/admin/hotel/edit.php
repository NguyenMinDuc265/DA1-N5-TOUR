<?php headerAdmin() ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Sửa khách sạn</h2>
    <a href="admin.php?act=hotel_list" class="btn btn-outline-secondary btn-sm">← Quay lại danh sách</a>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-4">
        <form action="admin.php?act=hotel_update" method="POST">

            <input type="hidden" name="hotel_id" value="<?= $hotel['hotel_id'] ?>">

            <div class="mb-3">
                <label class="form-label">Tên khách sạn</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($hotel['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($hotel['address'] ?? '') ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Người quản lý</label>
                    <input type="text" name="manager_name" class="form-control" value="<?= htmlspecialchars($hotel['manager_name'] ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">SĐT quản lý</label>
                    <input type="text" name="manager_phone" class="form-control" value="<?= htmlspecialchars($hotel['manager_phone'] ?? '') ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="admin.php?act=hotel_list" class="btn btn-outline-secondary">Hủy</a>
        </form>
    </div>
</div>

<?php footerAdmin() ?>
