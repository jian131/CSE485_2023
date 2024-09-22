<?php
require_once '../db_connection.php';

$upload_dir = '/btth01/images/songs/';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST['txtTitle'];
    $ten_bhat = $_POST['txtSongName'];
    $ma_tloai = $_POST['txtCategoryId'];
    $tomtat = $_POST['txtSummary'];
    $noidung = $_POST['txtContent'];
    $ma_tgia = $_POST['txtAuthorId'];
    $ngayviet = date("Y-m-d H:i:s");

    // Handle file upload
    if(isset($_FILES['txtImage']) && $_FILES['txtImage']['error'] == 0) {
        $file_name = basename($_FILES["txtImage"]["name"]);
        $target_file = $_SERVER['DOCUMENT_ROOT'] . $upload_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["txtImage"]["tmp_name"]);
        if($check !== false) {
            // Allow certain file formats
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                if (move_uploaded_file($_FILES["txtImage"]["tmp_name"], $target_file)) {
                    $hinhanh = $upload_dir . $file_name;
                } else {
                    $message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            $message = "File is not an image.";
        }
    } else {
        $hinhanh = null;
    }

    if (empty($message)) {
        $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh)
                VALUES (:tieude, :ten_bhat, :ma_tloai, :tomtat, :noidung, :ma_tgia, :ngayviet, :hinhanh)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tieude', $tieude, PDO::PARAM_STR);
        $stmt->bindParam(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
        $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt->bindParam(':tomtat', $tomtat, PDO::PARAM_STR);
        $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
        $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt->bindParam(':ngayviet', $ngayviet, PDO::PARAM_STR);
        $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: article.php");
            exit();
        } else {
            $message = "Lỗi: " . $stmt->errorInfo()[2];
        }
    }
}

// Fetch categories and authors for dropdowns
$categories = $pdo->query("SELECT * FROM theloai")->fetchAll();
$authors = $pdo->query("SELECT * FROM tacgia")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTitle">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblSongName">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSongName" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCategoryId">Thể loại</span>
                        <select class="form-select" name="txtCategoryId" required>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['ma_tloai'] ?>"><?= $category['ten_tloai'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                        <textarea class="form-control" name="txtSummary" required></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblContent">Nội dung</span>
                        <textarea class="form-control" name="txtContent" required></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthorId">Tác giả</span>
                        <select class="form-select" name="txtAuthorId" required>
                            <?php foreach($authors as $author): ?>
                                <option value="<?= $author['ma_tgia'] ?>"><?= $author['ten_tgia'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblImage">Hình ảnh</span>
                        <input type="file" class="form-control" name="txtImage">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
