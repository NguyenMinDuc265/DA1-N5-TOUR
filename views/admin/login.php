<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập Quản trị viên — N5 TOUR</title>
  <link rel="stylesheet" href="views/shared/login.css">
</head>

<body class="admin-theme">

  <div class="login-topbar">
    <a href="home.php" class="brand">
      <span class="mark">🧭</span> N5 TOUR
    </a>
    <a href="home.php" class="back">← Về trang chủ</a>
  </div>

  <div class="login-wrap">
    <div class="login-card">
      <div class="brand">
        <div class="logo">AD</div>
        <div>
          <h1>Đăng nhập quản trị</h1>
          <p class="lead">Cổng quản trị hệ thống N5 TOUR</p>
        </div>
      </div>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?php echo htmlspecialchars($_SESSION['error']);
                            unset($_SESSION['error']); ?></div>
      <?php endif; ?>

      <form action="admin.php?act=login" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" placeholder="admin@n5tour.vn" required>
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
        Không phải quản trị viên? <a href="index.php?act=login">Đăng nhập với vai trò Hướng dẫn viên</a>
        <div style="margin-top:8px;">&copy; <?= date('Y') ?> N5 TOUR. Công ty Quản Lý Tour Du Lịch.</div>
      </footer>
    </div>
  </div>

</body>

</html>
