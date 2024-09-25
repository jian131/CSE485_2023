<?php
require_once '../../configs/DBConnection.php';
require_once '../../models/Category.php';

class CategoryService {
    private $conn;

    public function __construct() {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    public function getAllCategories() {
        $stmt = $this->conn->query("SELECT * FROM theloai");
        $categories = [];
        while ($row = $stmt->fetch()) {
            $categories[] = new Category($row['ma_tloai'], $row['ten_tloai']);
        }
        return $categories;
    }

    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM theloai WHERE ma_tloai = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        if ($row) {
            return new Category($row['ma_tloai'], $row['ten_tloai']);
        }
        return null;
    }

    public function addCategory($name) {
        $stmt = $this->conn->prepare("INSERT INTO theloai (ten_tloai) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }

    public function updateCategory($id, $name) {
        $stmt = $this->conn->prepare("UPDATE theloai SET ten_tloai = :name WHERE ma_tloai = :id");
        $stmt->execute(['id' => $id, 'name' => $name]);
    }

    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM theloai WHERE ma_tloai = :id");
        $stmt->execute(['id' => $id]);
    }
    public function countCategories() {
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM theloai");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}
?>
