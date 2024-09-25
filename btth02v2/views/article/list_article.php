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
    <title>Danh sách bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        .article-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Danh sách bài viết</h1>
        <?php if ($isAdmin): ?>
            <a href="index.php?action=add" class="btn btn-primary mb-3">Thêm bài viết</a>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Tên bài hát</th>
                    <th scope="col">Tóm tắt</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Thể loại</th>
                    <th scope="col">Ngày viết</th>
                    <?php if ($isAdmin): ?>
                        <th scope="col">Hành động</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $index => $article): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($article['tieude']) ?></td>
                    <td><?= htmlspecialchars($article['ten_bhat']) ?></td>
                    <td><?= htmlspecialchars($article['tomtat']) ?></td>
                    <td><?= htmlspecialchars($article['noidung']) ?></td>
                    <td>
                        <?php if ($article['hinhanh']): ?>
                            <img src="<?= htmlspecialchars($article['hinhanh']) ?>" alt="Article Image" class="article-image">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($article['ten_tgia']) ?></td>
                    <td><?= htmlspecialchars($article['ten_tloai']) ?></td>
                    <td><?= htmlspecialchars($article['ngayviet']) ?></td>
                    <?php if ($isAdmin): ?>
                        <td>
                            <a href="index.php?action=edit&id=<?= $article['ma_bviet'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?action=delete&id=<?= $article['ma_bviet'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')"><i class="fa-solid fa-trash"></i></a>
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
