<?php headerAdmin(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Sửa Tour</h2>
    <a href="admin.php?act=tour_list" class="btn btn-outline-secondary btn-sm">← Quay lại danh sách</a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form method="POST" enctype="multipart/form-data" action="admin.php?act=update_tour">

            <input type="hidden" name="tour_id" value="<?= $tour['tour_id'] ?>">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($tour['image'] ?? '') ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $cate): ?>
                            <option value="<?= $cate['category_id'] ?>"
                                <?= ($cate['category_id'] == $tour['category_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cate['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên tour</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($tour['name']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($tour['description']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nhà cung cấp</label>
                    <input type="text" name="supplier" class="form-control" value="<?= htmlspecialchars($tour['supplier']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giá tiền</label>
                    <input type="number" name="price" class="form-control" value="<?= $tour['price'] ?? '' ?>" required step="1000">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hình ảnh mới (tùy chọn)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" <?= $tour['status'] ? 'selected' : '' ?>>Hiển thị</option>
                        <option value="0" <?= !$tour['status'] ? 'selected' : '' ?>>Ẩn</option>
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
                                           value="<?= $h['hotel_id'] ?>" id="hotel_<?= $h['hotel_id'] ?>"
                                           <?= in_array($h['hotel_id'], $assignedHotelIds) ? 'checked' : '' ?>>
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
                <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                <a href="admin.php?act=tour_list" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

<?php footerAdmin(); ?>
