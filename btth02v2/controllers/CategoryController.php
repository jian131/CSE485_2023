<?php
require_once '../../services/CategoryService.php';

class CategoryController {
    private $categoryService;

    public function __construct() {
        $this->categoryService = new CategoryService();
    }

    public function list() {
        $categories = $this->categoryService->getAllCategories();
        include '../../views/category/list_category.php';
    }

    public function add() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->categoryService->addCategory($name);
            header('Location: index.php');
            exit();
        }
        include '../../views/category/add_category.php';
    }

    public function edit($id) {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->categoryService->updateCategory($id, $name);
            header('Location: index.php');
            exit();
        }
        $category = $this->categoryService->getCategoryById($id);
        include '../../views/category/edit_category.php';
    }

    public function delete($id) {
        $this->checkAdmin();
        $this->categoryService->deleteCategory($id);
        header('Location: index.php');
        exit();
    }

    public function showCategory($id) {
        return $this->categoryService->getCategoryById($id);
    }

    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php');
            exit();
        }
    }
}
?>
