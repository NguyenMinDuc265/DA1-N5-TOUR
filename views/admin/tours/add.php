<?php headerAdmin(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Thêm Tour mới</h2>
    <a href="admin.php?act=tour_list" class="btn btn-outline-secondary btn-sm">← Quay lại danh sách</a>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" enctype="multipart/form-data" action="admin.php?act=add_tour">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($categories as $cate): ?>
                            <option value="<?= $cate['category_id'] ?>"><?= htmlspecialchars($cate['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên tour</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên tour" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Mô tả chi tiết về tour"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nhà cung cấp</label>
                    <input type="text" name="supplier" class="form-control" placeholder="Tên nhà cung cấp">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giá tour / người</label>
                    <input type="number" name="price" class="form-control" required step="1000" placeholder="VD: 2500000">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Khách sạn áp dụng cho tour này</label>
                <div class="border rounded p-3">
                    <div class="row">
                        <?php foreach ($hotels as $h): ?>
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hotel_ids[]"
                                           value="<?= $h['hotel_id'] ?>" id="hotel_<?= $h['hotel_id'] ?>">
                                    <label class="form-check-label" for="hotel_<?= $h['hotel_id'] ?>">
                                        <?= htmlspecialchars($h['name']) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($hotels)): ?>
                            <p class="text-muted mb-0">
                                Chưa có khách sạn nào. <a href="admin.php?act=hotel_add_form">+ Thêm khách sạn</a> trước.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <small class="text-muted">Chỉ những khách sạn được tick ở đây mới hiện ra khi tạo Booking cho tour này.</small>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">💾 Lưu tour</button>
                <a href="admin.php?act=tour_list" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

<?php footerAdmin(); ?>
