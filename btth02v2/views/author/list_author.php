<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tác giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Danh sách tác giả</h1>
        <?php if ($isAdmin): ?>
            <a href="index.php?action=add" class="btn btn-primary mb-3">Thêm tác giả</a>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã tác giả</th>
                    <th scope="col">Tên tác giả</th>
                    <th scope="col">Hình ảnh</th>
                    <?php if ($isAdmin): ?>
                        <th scope="col">Hành động</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author): ?>
                    <tr>
                        <td><?= htmlspecialchars($author->getId()) ?></td>
                        <td><?= htmlspecialchars($author->getName()) ?></td>
                        <td>
                            <?php if ($author->getImage()): ?>
                                <img src="<?= htmlspecialchars($author->getImage()) ?>" alt="Author Image" class="img-thumbnail" style="max-width: 100px;">
                            <?php endif; ?>
                        </td>
                        <?php if ($isAdmin): ?>
                            <td>
                                <a href="index.php?action=edit&id=<?= $author->getId() ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="index.php?action=delete&id=<?= $author->getId() ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tác giả này?')"><i class="fa-solid fa-trash"></i></a>
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
