<?php headerAdmin(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Danh sách Tour</h2>
    <a href="admin.php?act=form_add_tour" class="btn btn-primary">+ Thêm tour</a>
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

<div class="card mb-3">
    <div class="card-body">
        <form action="admin.php" method="GET" class="d-flex gap-2">
            <input type="hidden" name="act" value="tour_list">
            <input type="text" name="q" class="form-control" placeholder="Tìm tour ..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên tour</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp</th>
                    <th>Giá tour/người</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $index => $tour): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($tour['name']) ?></td>
                        <td><?= htmlspecialchars($tour['category_name']) ?></td>
                        <td><?= htmlspecialchars($tour['supplier']) ?></td>
                        <td><?= number_format($tour['price'], 0, ',', '.') . ' đ' ?></td>
                        <td>
                            <?php if ($tour['status']): ?>
                                <span class="badge bg-success">Hiển thị</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Ẩn</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="detail" href="admin.php?act=tour_detail&id=<?= $tour['tour_id'] ?>">Chi tiết</a>
                            <a class="edit" href="admin.php?act=form_edit_tour&id=<?= $tour['tour_id'] ?>">Sửa</a>
                            <a class="delete" href="admin.php?act=delete_tour&id=<?= $tour['tour_id'] ?>" onclick="return confirm('Xóa tour này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($tours)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không có tour nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php footerAdmin(); ?>

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
