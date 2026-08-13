<?php headerAdmin() ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h3 mb-0">Gán Tour cho khách sạn: <?= htmlspecialchars($hotel['name']) ?></h2>
    <a href="admin.php?act=hotel_list" class="btn btn-outline-secondary btn-sm">← Quay lại danh sách</a>
</div>

<p class="text-muted">
    Chọn những tour mà khách sạn <strong><?= htmlspecialchars($hotel['name']) ?></strong> có thể phục vụ.
    Chỉ những tour được chọn ở đây mới hiện lên ô "Chọn Khách Sạn" khi tạo Booking cho tour đó.
</p>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-4">
        <form action="admin.php?act=hotel_assign_tours" method="POST">
            <input type="hidden" name="hotel_id" value="<?= $hotel['hotel_id'] ?>">

            <div class="row">
                <?php foreach ($tours as $t): ?>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tour_ids[]"
                                   value="<?= $t['tour_id'] ?>" id="tour_<?= $t['tour_id'] ?>"
                                   <?= in_array($t['tour_id'], $assignedTourIds) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="tour_<?= $t['tour_id'] ?>">
                                <?= htmlspecialchars($t['name']) ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($tours)): ?>
                    <p class="text-muted">Chưa có tour nào trong hệ thống.</p>
                <?php endif; ?>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
                <a href="admin.php?act=hotel_list" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

<?php footerAdmin() ?>
