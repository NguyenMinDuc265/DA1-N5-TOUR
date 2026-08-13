<?php
session_start();
require_once './commons/env.php';

$isAdminLoggedIn = isset($_SESSION['admin']);
$isGuideLoggedIn = isset($_SESSION['guide']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N5 TOUR — Hệ thống quản lý Tour Du lịch</title>
    <meta name="description" content="Hệ thống quản lý tour du lịch cho doanh nghiệp: quản trị tour, đặt chỗ, lịch trình hướng dẫn viên và báo cáo thống kê.">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/shared/site.css">
</head>

<body>

    <?php include './views/shared/header.php'; ?>

    <!-- ================= HERO BANNER ================= -->
    <section class="hero-banner">
        <div class="container-n5 hero-inner">
            <div class="hero-copy">
                <div class="hero-badge"><span class="dot"></span> Nền tảng quản lý tour dành cho doanh nghiệp</div>
                <h1>Quản lý tour du lịch <span class="accent">chuyên nghiệp</span>, chính xác &amp; tập trung</h1>
                <p>
                    N5 TOUR giúp doanh nghiệp lữ hành quản lý tour, đặt chỗ khách hàng, lịch trình
                    hướng dẫn viên và số liệu kinh doanh trên một hệ thống duy nhất — nhanh chóng, minh bạch,
                    dễ vận hành.
                </p>
                <div class="hero-cta">
                    <a href="#portal" class="btn-n5 btn-n5-primary">Chọn cổng đăng nhập →</a>
                    <a href="#dich-vu" class="btn-n5 btn-n5-outline">Xem tính năng</a>
                </div>

                <div class="hero-stats">
                    <div class="stat"><b>2</b><span>Cổng truy cập</span></div>
                    <div class="stat"><b>24/7</b><span>Vận hành liên tục</span></div>
                    <div class="stat"><b>100%</b><span>Dữ liệu tập trung</span></div>
                </div>
            </div>

            <div class="hero-visual">
                <svg viewBox="0 0 420 380" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="210" cy="190" r="150" fill="#14294d" />
                    <circle cx="210" cy="190" r="112" fill="#0ea5e9" opacity="0.18" />
                    <rect x="95" y="120" width="230" height="150" rx="16" fill="#ffffff" />
                    <rect x="95" y="120" width="230" height="34" rx="16" fill="#0b1930" />
                    <circle cx="115" cy="137" r="5" fill="#f5a524" />
                    <circle cx="132" cy="137" r="5" fill="#0ea5e9" />
                    <circle cx="149" cy="137" r="5" fill="#22c55e" />
                    <rect x="112" y="170" width="110" height="10" rx="5" fill="#cbd5e1" />
                    <rect x="112" y="190" width="150" height="10" rx="5" fill="#e2e8f0" />
                    <rect x="112" y="210" width="90" height="10" rx="5" fill="#e2e8f0" />
                    <rect x="112" y="234" width="196" height="26" rx="8" fill="#0ea5e9" />
                    <circle cx="290" cy="90" r="26" fill="#f5a524" />
                    <path d="M278 90 l8 8 l16 -18" stroke="#0b1930" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M60 260 q150 -40 300 0" stroke="#f5a524" stroke-width="4" fill="none" stroke-dasharray="2 10" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </section>

    <!-- ================= PORTAL CHOOSER ================= -->
    <section class="portal-section" id="portal">
        <div class="container-n5">
            <div class="section-head">
                <div class="section-eyebrow">Cổng đăng nhập</div>
                <h2>Bạn muốn đăng nhập với vai trò nào?</h2>
                <p>Chọn đúng cổng truy cập tương ứng với vai trò của bạn trong hệ thống.</p>
            </div>

            <div class="portal-grid">
                <!-- ADMIN -->
                <div class="portal-card admin">
                    <div class="portal-icon">🛡️</div>
                    <h3>Quản trị viên</h3>
                    <p>Dành cho quản trị hệ thống: quản lý tour, danh mục, booking, hướng dẫn viên, khách hàng và báo cáo thống kê.</p>
                    <ul>
                        <li>Quản lý tour &amp; danh mục</li>
                        <li>Xử lý đặt chỗ (booking)</li>
                        <li>Thống kê &amp; báo cáo</li>
                    </ul>
                    <?php if ($isAdminLoggedIn): ?>
                        <a href="admin.php?act=dashboard" class="btn-n5 btn-n5-primary">Vào trang quản trị →</a>
                    <?php else: ?>
                        <a href="admin.php?act=login" class="btn-n5 btn-n5-primary">Đăng nhập Quản trị viên</a>
                    <?php endif; ?>
                </div>

                <!-- GUIDE -->
                <div class="portal-card guide">
                    <div class="portal-icon">🧑‍✈️</div>
                    <h3>Hướng dẫn viên</h3>
                    <p>Dành cho hướng dẫn viên: xem lịch làm việc, điểm danh khách hàng, cập nhật hồ sơ và lịch sử dẫn tour.</p>
                    <ul>
                        <li>Lịch làm việc theo tháng/ngày</li>
                        <li>Điểm danh khách hàng</li>
                        <li>Hồ sơ &amp; lịch sử dẫn tour</li>
                    </ul>
                    <?php if ($isGuideLoggedIn): ?>
                        <a href="index.php" class="btn-n5 btn-n5-gold">Vào trang làm việc →</a>
                    <?php else: ?>
                        <a href="index.php?act=login" class="btn-n5 btn-n5-gold">Đăng nhập Hướng dẫn viên</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FEATURES ================= -->
    <section class="features-section" id="dich-vu">
        <div class="container-n5">
            <div class="section-head">
                <div class="section-eyebrow">Tính năng</div>
                <h2>Một hệ thống, đầy đủ nghiệp vụ</h2>
                <p>Các module chính phục vụ vận hành tour du lịch của doanh nghiệp.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🧭</div>
                    <h4>Quản lý Tour</h4>
                    <p>Tạo, chỉnh sửa tour, danh mục và lịch trình chi tiết cho từng chuyến đi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h4>Đặt chỗ (Booking)</h4>
                    <p>Quy trình đặt chỗ nhiều bước, quản lý khách hàng và trạng thái thanh toán.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🕒</div>
                    <h4>Lịch &amp; điểm danh HDV</h4>
                    <p>Hướng dẫn viên theo dõi lịch làm việc và điểm danh khách hàng theo từng tour.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h4>Thống kê &amp; báo cáo</h4>
                    <p>Số liệu kinh doanh, chi phí tour và hiệu suất vận hành theo thời gian thực.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= ABOUT ================= -->
    <section class="about-section" id="gioi-thieu">
        <div class="container-n5">
            <div class="about-inner">
                <div>
                    <div class="section-eyebrow">Vì sao chọn N5 TOUR</div>
                    <h2 style="font-size:28px;font-weight:800;color:var(--n5-navy);">
                        Nền tảng vận hành nội bộ dành riêng cho doanh nghiệp lữ hành
                    </h2>
                    <ul class="about-list">
                        <li>
                            <div class="num">1</div>
                            <div>
                                <b>Phân quyền rõ ràng</b>
                                <span>Hai cổng truy cập tách biệt cho Quản trị viên và Hướng dẫn viên.</span>
                            </div>
                        </li>
                        <li>
                            <div class="num">2</div>
                            <div>
                                <b>Dữ liệu tập trung</b>
                                <span>Toàn bộ tour, booking, khách hàng và lịch trình lưu trữ trên một hệ thống.</span>
                            </div>
                        </li>
                        <li>
                            <div class="num">3</div>
                            <div>
                                <b>Dễ mở rộng</b>
                                <span>Kiến trúc MVC rõ ràng, thuận tiện bổ sung nghiệp vụ mới.</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="about-panel">
                    <h3>Bắt đầu ngay</h3>
                    <p>Chọn cổng phù hợp với vai trò của bạn để truy cập vào hệ thống quản lý tour.</p>
                    <div class="hero-cta">
                        <a href="admin.php?act=login" class="btn-n5 btn-n5-primary">Quản trị viên</a>
                        <a href="index.php?act=login" class="btn-n5 btn-n5-gold">Hướng dẫn viên</a>
                    </div>
                    <div class="mini-stats" style="margin-top:26px;">
                        <div><b>MVC</b><span>Kiến trúc hệ thống</span></div>
                        <div><b>PHP</b><span>Nền tảng xử lý</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './views/shared/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
