<?php
session_start();
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách thể loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Danh sách thể loại</h1>
        <?php if ($isAdmin): ?>
            <a href="index.php?action=add" class="btn btn-primary mb-3">Thêm thể loại</a>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên thể loại</th>
                    <?php if ($isAdmin): ?>
                        <th>Hành động</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category->getId()); ?></td>
                        <td><?php echo htmlspecialchars($category->getName()); ?></td>
                        <?php if ($isAdmin): ?>
                            <td>
                                <a href="index.php?action=edit&id=<?php echo $category->getId(); ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="index.php?action=delete&id=<?php echo $category->getId(); ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
