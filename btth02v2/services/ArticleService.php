<?php
require_once '../../configs/DBConnection.php';
require_once '../../models/Article.php';

class ArticleService {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllArticles() {
        $stmt = $this->conn->query("SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, bv.tomtat, bv.noidung, tg.ten_tgia, tl.ten_tloai, bv.ngayviet, bv.hinhanh
                                    FROM baiviet bv
                                    JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
                                    JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai
                                    ORDER BY bv.ma_bviet");
        $articles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = $row;
        }
        return $articles;
    }

    public function countArticles() {
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM baiviet");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public function addArticle($title, $ten_bhat, $summary, $noidung, $cat_id, $author_id, $image) {
        $stmt = $this->conn->prepare("INSERT INTO baiviet (tieude, ten_bhat, tomtat, noidung, ma_tloai, ma_tgia, hinhanh) VALUES (:title, :ten_bhat, :summary, :noidung, :cat_id, :author_id, :image)");
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
        $stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
        $stmt->bindValue(':noidung', $noidung, PDO::PARAM_STR);
        $stmt->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
        $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateArticle($id, $title, $ten_bhat, $summary, $noidung, $cat_id, $author_id, $image) {
        if ($image) {
            $stmt = $this->conn->prepare("UPDATE baiviet SET tieude = :title, ten_bhat = :ten_bhat, tomtat = :summary, noidung = :noidung, ma_tloai = :cat_id, ma_tgia = :author_id, hinhanh = :image WHERE ma_bviet = :id");
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
            $stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
            $stmt->bindValue(':noidung', $noidung, PDO::PARAM_STR);
            $stmt->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
            $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt = $this->conn->prepare("UPDATE baiviet SET tieude = :title, ten_bhat = :ten_bhat, tomtat = :summary, noidung = :noidung, ma_tloai = :cat_id, ma_tgia = :author_id WHERE ma_bviet = :id");
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
            $stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
            $stmt->bindValue(':noidung', $noidung, PDO::PARAM_STR);
            $stmt->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
            $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }
        return $stmt->execute();
    }

    public function deleteArticle($id) {
        $stmt = $this->conn->prepare("DELETE FROM baiviet WHERE ma_bviet = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getArticleById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM baiviet WHERE ma_bviet = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $stmt = $this->conn->query("SELECT * FROM theloai");
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function getAllAuthors() {
        $stmt = $this->conn->query("SELECT * FROM tacgia");
        $authors = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $authors[] = $row;
        }
        return $authors;
    }

    public function isValidCategory($cat_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM theloai WHERE ma_tloai = ?");
        $stmt->execute([$cat_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function isValidAuthor($author_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM tacgia WHERE ma_tgia = ?");
        $stmt->execute([$author_id]);
        return $stmt->fetchColumn() > 0;
    }
}
