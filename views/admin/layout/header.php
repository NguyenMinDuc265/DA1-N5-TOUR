<?php $__act = $_GET['act'] ?? 'dashboard'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản trị — N5 TOUR</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    :root {
      --n5-navy: #0b1930;
      --n5-navy-light: #14294d;
      --n5-blue: #0ea5e9;
      --n5-blue-dark: #0284c7;
      --n5-gold: #f5a524;
      --n5-green: #22c55e;
      --n5-red: #ef4444;
      --n5-orange: #f97316;
      --n5-bg: #f4f6f9;
      --n5-border: #e2e8f0;
      --n5-text: #1e293b;
      --n5-muted: #64748b;
    }

    * {
      box-sizing: border-box;
    }

    body {
      background: var(--n5-bg) !important;
      font-family: "Segoe UI", Roboto, Arial, sans-serif;
      color: var(--n5-text);
    }

    h1, h2, h3, h4, h5 {
      color: var(--n5-navy);
    }

    a {
      color: var(--n5-blue-dark);
    }

    /* ===== Sidebar ===== */
    #sidebar {
      width: 264px;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      background: var(--n5-navy);
      padding: 22px 0;
      color: #fff;
      display: flex;
      flex-direction: column;
      z-index: 20;
    }

    #sidebar .sb-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0 22px 20px;
      margin-bottom: 10px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      font-weight: 800;
      font-size: 18px;
      letter-spacing: .3px;
    }

    #sidebar .sb-brand .mark {
      width: 36px;
      height: 36px;
      border-radius: 9px;
      background: linear-gradient(135deg, var(--n5-blue), var(--n5-gold));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      flex: none;
    }

    #sidebar .sb-role {
      padding: 0 22px 14px;
      font-size: 11.5px;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #64748b;
      font-weight: 700;
    }

    #sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 22px;
      font-size: 14.5px;
      color: #cbd5e1;
      text-decoration: none;
      border-left: 3px solid transparent;
      transition: background .12s ease, color .12s ease;
    }

    #sidebar a:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #fff;
    }

    #sidebar a.active {
      background: rgba(14, 165, 233, 0.14);
      color: #fff;
      border-left-color: var(--n5-blue);
      font-weight: 600;
    }

    #sidebar .sb-spacer {
      flex: 1;
    }

    #sidebar a.sb-logout {
      color: #fca5a5;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      margin-top: 10px;
      padding-top: 16px;
    }

    #sidebar a.sb-logout:hover {
      background: rgba(239, 68, 68, 0.12);
      color: #fecaca;
    }

    /* ===== Content ===== */
    #content {
      margin-left: 264px;
      padding: 24px 28px 50px;
      min-height: 100vh;
    }

    /* Topbar */
    #content > nav.navbar {
      border-radius: 14px !important;
      border: 1px solid var(--n5-border);
    }

    /* ===== Cards ===== */
    .card {
      border: 1px solid var(--n5-border);
      border-radius: 14px !important;
      box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05);
    }

    .card-header {
      background: #fff;
      border-bottom: 1px solid var(--n5-border);
      font-weight: 700;
      color: var(--n5-navy);
    }

    .stat-box {
      padding: 22px;
      border-radius: 14px !important;
      color: #fff;
      box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
    }

    .stat-box h4, .stat-box h5 {
      color: #fff;
    }

    .bg-blue { background: linear-gradient(135deg, var(--n5-blue), var(--n5-blue-dark)) !important; }
    .bg-green { background: linear-gradient(135deg, #34d399, var(--n5-green)) !important; }
    .bg-orange { background: linear-gradient(135deg, #fbbf24, var(--n5-orange)) !important; }

    /* ===== Buttons ===== */
    .btn { border-radius: 8px; font-weight: 600; font-size: 14.5px; }
    .btn-primary { background: var(--n5-blue) !important; border-color: var(--n5-blue) !important; }
    .btn-primary:hover { background: var(--n5-blue-dark) !important; border-color: var(--n5-blue-dark) !important; }
    .btn-success { background: var(--n5-green) !important; border-color: var(--n5-green) !important; }
    .btn-outline-secondary { border-color: var(--n5-border); color: var(--n5-text); }

    /* ===== Tables (covers Bootstrap tables + legacy bare tables) ===== */
    #content table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }

    #content .table thead th,
    #content table:not(.table) th {
      background: var(--n5-navy) !important;
      color: #fff !important;
      font-weight: 600;
      font-size: 13.5px;
      text-transform: uppercase;
      letter-spacing: .4px;
      border-color: var(--n5-navy) !important;
      vertical-align: middle;
    }

    #content table:not(.table) {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 12px rgba(15, 23, 42, 0.06);
      border: 1px solid var(--n5-border);
    }

    #content table:not(.table) td,
    #content table:not(.table) th {
      padding: 11px 14px;
      border: 1px solid var(--n5-border);
    }

    #content table:not(.table) tr:nth-child(even) td {
      background: #f8fafc;
    }

    .table-hover tbody tr:hover { background: #f0f9ff; }

    /* Legacy action links used as buttons (detail/edit/delete classes) */
    #content table a.detail,
    #content table a.edit,
    #content table a.delete,
    #content a[href*="form_add_"],
    #content a[href*="_add_form"] {
      display: inline-block;
      text-decoration: none !important;
      color: #fff !important;
      padding: 6px 12px;
      border-radius: 7px;
      font-size: 13px;
      font-weight: 600;
      margin: 2px 3px 2px 0;
      transition: opacity .15s ease;
    }
    #content table a.detail, #content a[href*="form_add_"], #content a[href*="_add_form"] { background: var(--n5-blue) !important; }
    #content table a.edit { background: var(--n5-green) !important; }
    #content table a.delete { background: var(--n5-red) !important; }
    #content table a.detail:hover,
    #content table a.edit:hover,
    #content table a.delete:hover,
    #content a[href*="form_add_"]:hover,
    #content a[href*="_add_form"]:hover { opacity: .85; }

    /* ===== Forms ===== */
    #content label { font-weight: 600; font-size: 13.8px; color: var(--n5-text); margin-top: 8px; }
    #content input.form-control,
    #content select.form-select,
    #content textarea.form-control,
    #content input[type="text"],
    #content input[type="number"],
    #content input[type="email"],
    #content input[type="password"],
    #content input[type="file"],
    #content select,
    #content textarea {
      border: 1px solid var(--n5-border) !important;
      border-radius: 8px !important;
      padding: 9px 12px;
      font-size: 14.5px;
      width: 100%;
      margin-bottom: 12px;
      background: #fff;
    }
    #content input:focus,
    #content select:focus,
    #content textarea:focus {
      outline: none;
      border-color: var(--n5-blue) !important;
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
    }
    #content form button[type="submit"],
    #content form button:not([type]) {
      background: var(--n5-blue);
      color: #fff;
      border: none;
      padding: 10px 22px;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
    }
    #content form button[type="submit"]:hover,
    #content form button:not([type]):hover { background: var(--n5-blue-dark); }

    /* ===== Alerts / badges ===== */
    .alert { border-radius: 10px; border: none; font-size: 14.5px; }
    .alert-success { background: #dcfce7; color: #166534; }
    .alert-danger { background: #fee2e2; color: #991b1b; }
    .badge { font-weight: 600; font-size: 12px; padding: 5px 10px; border-radius: 6px; }

    @media (max-width: 992px) {
      #sidebar { transform: translateX(-100%); transition: transform .2s ease; }
      #sidebar.show { transform: translateX(0); }
      #content { margin-left: 0; }
    }
  </style>

</head>

<body>

  <!-- SIDEBAR -->
  <div id="sidebar">
    <div class="sb-brand"><span class="mark">🧭</span> N5 TOUR</div>
    <div class="sb-role">Quản trị viên</div>

    <a href="home.php">🌐 Trang chủ</a>
    <a href="admin.php?act=dashboard" class="<?= $__act === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>
    <a href="admin.php?act=category_list" class="<?= $__act === 'category_list' ? 'active' : '' ?>">📂 Danh mục</a>
    <a href="admin.php?act=tour_list" class="<?= $__act === 'tour_list' ? 'active' : '' ?>">🧭 Danh sách Tour</a>
    <a href="admin.php?act=hotel_list" class="<?= $__act === 'hotel_list' ? 'active' : '' ?>">🏨 Khách sạn</a>
    <a href="admin.php?act=booking" class="<?= $__act === 'booking' ? 'active' : '' ?>">📋 Booking</a>
    <a href="admin.php?act=guide" class="<?= $__act === 'guide' ? 'active' : '' ?>">👥 Hướng dẫn viên</a>
    <a href="admin.php?act=attendance" class="<?= $__act === 'attendance' ? 'active' : '' ?>">🕒 Điểm danh</a>
    <a href="admin.php?act=statistical" class="<?= $__act === 'statistical' ? 'active' : '' ?>">📈 Thống kê</a>
    <a href="admin.php?act=customer" class="<?= $__act === 'customer' ? 'active' : '' ?>">👤 Khách hàng</a>

    <div class="sb-spacer"></div>
    <a href="admin.php?act=logout" class="sb-logout">🚪 Đăng xuất</a>
  </div>

  <!-- CONTENT -->
  <div id="content">

    <!-- NAVBAR -->
    <nav class="navbar navbar-light bg-white shadow-sm p-3 rounded mb-4">
      <div class="container-fluid">
        <span class="navbar-brand h4 mb-0">Bảng điều khiển quản trị</span>

        <div class="dropdown">
          <a class="dropdown-toggle fw-bold" href="#" data-bs-toggle="dropdown">
            <?= htmlspecialchars($_SESSION['admin']['username'] ?? 'Admin') ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="admin.php?act=dashboard">Hồ sơ</a></li>
            <li><a class="dropdown-item text-danger" href="admin.php?act=logout">Đăng xuất</a></li>
          </ul>
        </div>
      </div>
    </nav>
