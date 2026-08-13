<?php
class HotelModel {
    protected $conn;
    public function __construct() { $this->conn = connectDB(); }

    // Danh sách khách sạn theo 1 tour (dùng cho AJAX ở bước 1 booking)
    public function getByTour($tourId) {
        $sql = "SELECT h.* FROM tour_hotel th
                JOIN hotel h ON th.hotel_id = h.hotel_id
                WHERE th.tour_id = :tour_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['tour_id' => $tourId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM hotel WHERE hotel_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===== CRUD khách sạn =====

    public function getAll() {
        $sql = "SELECT * FROM hotel ORDER BY hotel_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO hotel (name, address, manager_name, manager_phone)
                VALUES (:name, :address, :manager_name, :manager_phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name'          => $data['name'],
            'address'       => $data['address'] ?? null,
            'manager_name'  => $data['manager_name'] ?? null,
            'manager_phone' => $data['manager_phone'] ?? null,
        ]);
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE hotel
                SET name = :name, address = :address,
                    manager_name = :manager_name, manager_phone = :manager_phone
                WHERE hotel_id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id'            => $id,
            'name'          => $data['name'],
            'address'       => $data['address'] ?? null,
            'manager_name'  => $data['manager_name'] ?? null,
            'manager_phone' => $data['manager_phone'] ?? null,
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM hotel WHERE hotel_id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Có đang được gán cho tour nào / lịch trình nào không (chặn xóa nếu đang dùng)
    public function countTourMapping($id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM tour_hotel WHERE hotel_id = :id");
        $stmt->execute(['id' => $id]);
        return (int) $stmt->fetchColumn();
    }

    public function countScheduleUsage($id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM departure_schedule WHERE hotel_id = :id");
        $stmt->execute(['id' => $id]);
        return (int) $stmt->fetchColumn();
    }

    // ===== Gán khách sạn cho tour (bảng tour_hotel) =====

    // Danh sách tour đã gán cho 1 khách sạn (id các tour)
    public function getTourIdsByHotel($hotelId) {
        $stmt = $this->conn->prepare("SELECT tour_id FROM tour_hotel WHERE hotel_id = :id");
        $stmt->execute(['id' => $hotelId]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tour_id');
    }

    // Danh sách hotel_id đã gán cho 1 tour (dùng ở form thêm/sửa tour)
    public function getHotelIdsByTour($tourId) {
        $stmt = $this->conn->prepare("SELECT hotel_id FROM tour_hotel WHERE tour_id = :id");
        $stmt->execute(['id' => $tourId]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'hotel_id');
    }

    // Cập nhật lại toàn bộ danh sách khách sạn được gán cho 1 tour
    // (dùng khi lưu form Thêm/Sửa tour có tick chọn khách sạn)
    public function syncHotelsForTour($tourId, array $hotelIds) {
        $this->conn->beginTransaction();
        try {
            $del = $this->conn->prepare("DELETE FROM tour_hotel WHERE tour_id = :id");
            $del->execute(['id' => $tourId]);

            if (!empty($hotelIds)) {
                $ins = $this->conn->prepare("INSERT IGNORE INTO tour_hotel (tour_id, hotel_id) VALUES (:tour_id, :hotel_id)");
                foreach ($hotelIds as $hotelId) {
                    $ins->execute(['tour_id' => $tourId, 'hotel_id' => (int) $hotelId]);
                }
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // Cập nhật lại toàn bộ danh sách tour được gán cho 1 khách sạn
    public function syncTours($hotelId, array $tourIds) {
        $this->conn->beginTransaction();
        try {
            $del = $this->conn->prepare("DELETE FROM tour_hotel WHERE hotel_id = :id");
            $del->execute(['id' => $hotelId]);

            if (!empty($tourIds)) {
                $ins = $this->conn->prepare("INSERT IGNORE INTO tour_hotel (tour_id, hotel_id) VALUES (:tour_id, :hotel_id)");
                foreach ($tourIds as $tourId) {
                    $ins->execute(['tour_id' => (int) $tourId, 'hotel_id' => $hotelId]);
                }
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
