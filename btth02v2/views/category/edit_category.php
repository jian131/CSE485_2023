<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once '../../controllers/CategoryController.php';

$categoryController = new CategoryController();
$category = $categoryController->showCategory($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $categoryController->edit($_GET['id'], $name);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thể loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Sửa thể loại</h1>
        <form action="edit_category.php?id=<?php echo $category->getId(); ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên thể loại</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category->getName()); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>
