<?php

require_once '../../services/ArticleService.php';

class ArticleController {
    private $articleService;

    public function __construct($conn) {
        $this->articleService = new ArticleService($conn);
    }

    public function index() {
        $articles = $this->articleService->getAllArticles();
        include '../../views/article/list_article.php';
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM baiviet";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $ten_bhat = $_POST['ten_bhat'];
            $summary = $_POST['summary'];
            $noidung = $_POST['noidung'];
            $cat_id = $_POST['cat_id'];
            $author_id = $_POST['author_id'];

            // Kiểm tra tính hợp lệ của cat_id và author_id
            if (!$this->articleService->isValidCategory($cat_id) || !$this->articleService->isValidAuthor($author_id)) {
                // Xử lý lỗi nếu không hợp lệ
                echo "Invalid category or author.";
                return;
            }

            // Xử lý tải lên ảnh
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = '../../assets/images/songs/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            }

            $this->articleService->addArticle($title, $ten_bhat, $summary, $noidung, $cat_id, $author_id, $image);
            header('Location: index.php');
            exit();
        }
        $categories = $this->articleService->getAllCategories();
        $authors = $this->articleService->getAllAuthors();
        include '../../views/article/add_article.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $ten_bhat = $_POST['ten_bhat'];
            $summary = $_POST['summary'];
            $noidung = $_POST['noidung'];
            $cat_id = $_POST['cat_id'];
            $author_id = $_POST['author_id'];

            // Kiểm tra tính hợp lệ của cat_id và author_id
            if (!$this->articleService->isValidCategory($cat_id) || !$this->articleService->isValidAuthor($author_id)) {
                // Xử lý lỗi nếu không hợp lệ
                echo "Invalid category or author.";
                return;
            }

            // Xử lý tải lên ảnh
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = '../../assets/images/songs/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            }

            $this->articleService->updateArticle($id, $title, $ten_bhat, $summary, $noidung, $cat_id, $author_id, $image);
            header('Location: index.php');
            exit();
        }
        $article = $this->articleService->getArticleById($id);
        $categories = $this->articleService->getAllCategories();
        $authors = $this->articleService->getAllAuthors();
        include '../../views/article/edit_article.php';
    }

    public function delete($id) {
        $this->articleService->deleteArticle($id);
        header('Location: index.php');
        exit();
    }
}
