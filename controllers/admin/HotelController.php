<?php
class HotelController {
    public $modelHotel;
    public $modelTour;

    public function __construct() {
        $this->modelHotel = new HotelModel();
        $this->modelTour  = new TourModel();
    }

    // Danh sách khách sạn
    public function index() {
        $hotels = $this->modelHotel->getAll();
        require './views/admin/hotel/list.php';
    }

    // Form thêm khách sạn
    public function createForm() {
        require './views/admin/hotel/create.php';
    }

    // Xử lý thêm khách sạn
    public function store() {
        $name = trim($_POST['name'] ?? '');
        if (!$name) {
            $_SESSION['error'] = "Tên khách sạn không được để trống";
            header("Location: admin.php?act=hotel_add_form");
            exit();
        }

        $this->modelHotel->create([
            'name'          => $name,
            'address'       => $_POST['address'] ?? '',
            'manager_name'  => $_POST['manager_name'] ?? '',
            'manager_phone' => $_POST['manager_phone'] ?? '',
        ]);

        $_SESSION['success'] = "Thêm khách sạn thành công!";
        header("Location: admin.php?act=hotel_list");
        exit();
    }

    // Form sửa khách sạn
    public function editForm() {
        $id = $_GET['id'] ?? null;
        $hotel = $this->modelHotel->find($id);
        if (!$hotel) {
            $_SESSION['error'] = "Không tìm thấy khách sạn!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }
        require './views/admin/hotel/edit.php';
    }

    // Xử lý sửa khách sạn
    public function update() {
        $id = $_POST['hotel_id'] ?? null;
        $name = trim($_POST['name'] ?? '');

        if (!$id || !$name) {
            $_SESSION['error'] = "Dữ liệu không hợp lệ!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }

        $this->modelHotel->update($id, [
            'name'          => $name,
            'address'       => $_POST['address'] ?? '',
            'manager_name'  => $_POST['manager_name'] ?? '',
            'manager_phone' => $_POST['manager_phone'] ?? '',
        ]);

        $_SESSION['success'] = "Cập nhật khách sạn thành công!";
        header("Location: admin.php?act=hotel_list");
        exit();
    }

    // Xóa khách sạn
    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "ID khách sạn không hợp lệ!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }

        if ($this->modelHotel->countScheduleUsage($id) > 0) {
            $_SESSION['error'] = "Khách sạn đang được gán cho lịch trình, không thể xóa!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }

        $this->modelHotel->delete($id);
        $_SESSION['success'] = "Xóa khách sạn thành công!";
        header("Location: admin.php?act=hotel_list");
        exit();
    }

    // Trang gán khách sạn cho các tour
    public function assignToursForm() {
        $id = $_GET['id'] ?? null;
        $hotel = $this->modelHotel->find($id);
        if (!$hotel) {
            $_SESSION['error'] = "Không tìm thấy khách sạn!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }
        $tours = $this->modelTour->getAllTour();
        $assignedTourIds = $this->modelHotel->getTourIdsByHotel($id);
        require './views/admin/hotel/assign_tours.php';
    }

    // Xử lý gán khách sạn cho các tour
    public function assignTours() {
        $id = $_POST['hotel_id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Dữ liệu không hợp lệ!";
            header("Location: admin.php?act=hotel_list");
            exit();
        }

        $tourIds = $_POST['tour_ids'] ?? [];
        $this->modelHotel->syncTours($id, $tourIds);

        $_SESSION['success'] = "Cập nhật tour áp dụng cho khách sạn thành công!";
        header("Location: admin.php?act=hotel_list");
        exit();
    }
}
