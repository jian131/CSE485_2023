<?php
require_once '../../configs/DBConnection.php';
require_once '../../models/Author.php';

class AuthorService {
    private $conn;

    public function __construct() {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    public function countAuthors() {
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM tacgia");
        $row = $stmt->fetch();
        return $row['count'];
    }

    public function getAllAuthors() {
        $stmt = $this->conn->query("SELECT * FROM tacgia");
        $authors = [];
        while ($row = $stmt->fetch()) {
            $authors[] = new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        }
        return $authors;
    }

    public function getAuthorById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tacgia WHERE ma_tgia = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        if ($row) {
            return new Author($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        }
        return null;
    }

    public function addAuthor($name, $image) {
        $stmt = $this->conn->prepare("INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (:name, :image)");
        $stmt->execute(['name' => $name, 'image' => $image]);
    }

    public function updateAuthor($id, $name, $image) {
        $stmt = $this->conn->prepare("UPDATE tacgia SET ten_tgia = :name, hinh_tgia = :image WHERE ma_tgia = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'image' => $image]);
    }

    public function deleteAuthor($id) {
        $stmt = $this->conn->prepare("DELETE FROM tacgia WHERE ma_tgia = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>
