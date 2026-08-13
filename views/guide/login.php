<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Hướng dẫn viên — N5 TOUR</title>
    <link rel="stylesheet" href="views/shared/login.css">
</head>

<body class="guide-theme">

    <div class="login-topbar">
        <a href="home.php" class="brand">
            <span class="mark">🧭</span> N5 TOUR
        </a>
        <a href="home.php" class="back">← Về trang chủ</a>
    </div>

    <div class="login-wrap">
        <div class="login-card">
            <div class="brand">
                <div class="logo">HD</div>
                <div>
                    <h1>Đăng nhập Hướng dẫn viên</h1>
                    <p class="lead">Quản lý lịch làm việc, điểm danh</p>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?= htmlspecialchars($_SESSION['error']);
                                    unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?act=login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="vd. you@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input id="password" type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Đăng nhập</button>
                    <a href="home.php" class="btn secondary">Hủy</a>
                </div>
            </form>

            <footer>
                Bạn là quản trị viên? <a href="admin.php?act=login">Đăng nhập cổng Quản trị</a>
                <div style="margin-top:8px;">&copy; <?= date('Y') ?> N5 TOUR. Công ty Quản Lý Tour Du Lịch.</div>
            </footer>
        </div>
    </div>

</body>

</html>
