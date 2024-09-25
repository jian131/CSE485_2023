<?php
require_once '../../configs/DBConnection.php';
require_once '../../models/Author.php';
require_once '../../services/AuthorService.php';

class AuthorController {
    private $authorService;

    public function __construct() {
        $this->authorService = new AuthorService();
    }

    public function index() {
        $authors = $this->authorService->getAllAuthors();
        require '../../views/author/list_author.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $image = $_FILES['image']['name'];
            $target = "../../assets/images/authors/" . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $this->authorService->addAuthor($name, $target);
                header('Location: index.php');
            } else {
                echo "Failed to upload image.";
            }
        } else {
            require '../../views/author/add_author.php';
        }
    }

    public function edit($id) {
        $author = $this->authorService->getAuthorById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $image = $_FILES['image']['name'];
            $target = "../../assets/images/authors/" . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $this->authorService->updateAuthor($id, $name, $target);
                header('Location: index.php');
            } else {
                echo "Failed to upload image.";
            }
        } else {
            require '../../views/author/edit_author.php';
        }
    }

    public function delete($id) {
        $this->authorService->deleteAuthor($id);
        header('Location: index.php');
    }
}
?>
