<?php
require_once '../../configs/DBConnection.php';

$db = DBConnection::getInstance();
$pdo = $db->getConnection();

$sql = "SELECT * FROM baiviet";
$stmt = $pdo->query($sql);
$articles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .carousel-item img {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .carousel-item img.broken {
            background-color: #f0f0f0;
            display: block;
            width: 100%;
            height: 400px;
        }
        .carousel-item.broken .carousel-caption {
            color: red; /* Change this to the desired color */
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="../../assets/images/logo2.png" alt="Logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../../">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../../views/member/login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Nội dung cần tìm" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>

        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <?php foreach ($articles as $index => $article): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($articles as $index => $article): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?> <?= !file_exists($article['hinhanh']) ? 'broken' : '' ?>">
                        <img src="<?= htmlspecialchars($article['hinhanh']) ?>" class="d-block w-100 <?= !file_exists($article['hinhanh']) ? 'broken' : '' ?>" alt="<?= htmlspecialchars($article['tieude']) ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= htmlspecialchars($article['tieude']) ?></h5>
                            <p><?= htmlspecialchars($article['tomtat']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Music for Life
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
