<?php
// commons/function.php

// Kết nối CSDL qua PDO
function connectDB()
{
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        // Ghi log hoặc hiển thị thông báo ngắn gọn
        echo ("Connection failed: " . $e->getMessage());
        exit;
    }
}

function uploadFile($file, $folderSave)
{
    $file_upload = $file;
    $pathStorage = $folderSave . rand(10000, 99999) . $file_upload['name'];

    $tmp_file = $file_upload['tmp_name'];
    $pathSave = PATH_ROOT . $pathStorage; // Đường dãn tuyệt đối của file

    if (move_uploaded_file($tmp_file, $pathSave)) {
        return $pathStorage;
    }
    return null;
}

function deleteFile($file)
{
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

// Include header/footer helper (admin)
function headerAdmin()
{
    include PATH_ADMIN . "layout/header.php";
}
function footerAdmin()
{
    include PATH_ADMIN . "layout/footer.php";
}
function headerGuide()
{
    include PATH_GUIDE . "layout/header.php";
}
function footerGuide()
{
    include PATH_GUIDE . "layout/footer.php";
}

function checkIsAdmin() {
    if (!isset($_SESSION['admin'])) {
        header('Location: admin.php?act=login');
        exit;
    }
}

function checkIsGuide() {
    if (!isset($_SESSION['guide'])) {
        header('Location: index.php?act=login');
        exit;
    }
}
