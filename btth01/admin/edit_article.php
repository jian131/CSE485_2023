<?php
require_once '../db_connection.php';

$upload_dir = '/btth01/images/songs/';
$message = '';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM baiviet WHERE ma_bviet = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$article) {
        die("Bài viết không tồn tại");
    }
} else {
    die("Không có id bài viết được cung cấp");
}

// Fetch categories and authors for dropdowns
$sql_categories = "SELECT * FROM theloai";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll();

$sql_authors = "SELECT * FROM tacgia";
$stmt_authors = $pdo->query($sql_authors);
$authors = $stmt_authors->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tieude = $_POST['txtTitle'];
    $ten_bhat = $_POST['txtSong'];
    $ma_tloai = $_POST['txtCategory'];
    $tomtat = $_POST['txtSummary'];
    $noidung = $_POST['txtContent'];
    $ma_tgia = $_POST['txtAuthor'];
    $ngayviet = $_POST['txtDate'];

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
        $hinhanh = $article['hinhanh']; // Keep the existing image if no new file is uploaded
    }

    if (empty($message)) {
        $sql = "UPDATE baiviet SET tieude = :tieude, ten_bhat = :ten_bhat, ma_tloai = :ma_tloai,
                tomtat = :tomtat, noidung = :noidung, ma_tgia = :ma_tgia, ngayviet = :ngayviet,
                hinhanh = :hinhanh WHERE ma_bviet = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tieude', $tieude, PDO::PARAM_STR);
        $stmt->bindParam(':ten_bhat', $ten_bhat, PDO::PARAM_STR);
        $stmt->bindParam(':ma_tloai', $ma_tloai, PDO::PARAM_INT);
        $stmt->bindParam(':tomtat', $tomtat, PDO::PARAM_STR);
        $stmt->bindParam(':noidung', $noidung, PDO::PARAM_STR);
        $stmt->bindParam(':ma_tgia', $ma_tgia, PDO::PARAM_INT);
        $stmt->bindParam(':ngayviet', $ngayviet, PDO::PARAM_STR);
        $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: article.php");
            exit();
        } else {
            $message = "Lỗi: " . $stmt->errorInfo()[2];
        }
    }
}
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
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleId">Mã bài viết</span>
                        <input type="text" class="form-control" name="txtArticleId" readonly value="<?= $article['ma_bviet'] ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblTitle">Tiêu đề</span>
                        <input type="text" class="form-control" name="txtTitle" value="<?= htmlspecialchars($article['tieude']) ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblSong">Tên bài hát</span>
                        <input type="text" class="form-control" name="txtSong" value="<?= htmlspecialchars($article['ten_bhat']) ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCategory">Thể loại</span>
                        <select class="form-select" name="txtCategory">
                            <?php
                            foreach ($categories as $category) {
                                $selected = ($category['ma_tloai'] == $article['ma_tloai']) ? 'selected' : '';
                                echo "<option value='{$category['ma_tloai']}' {$selected}>{$category['ten_tloai']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblSummary">Tóm tắt</span>
                        <textarea class="form-control" name="txtSummary" rows="3"><?= htmlspecialchars($article['tomtat']) ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblContent">Nội dung</span>
                        <textarea class="form-control" name="txtContent" rows="10"><?= htmlspecialchars($article['noidung']) ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthor">Tác giả</span>
                        <select class="form-select" name="txtAuthor">
                            <?php
                            foreach ($authors as $author) {
                                $selected = ($author['ma_tgia'] == $article['ma_tgia']) ? 'selected' : '';
                                echo "<option value='{$author['ma_tgia']}' {$selected}>{$author['ten_tgia']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblDate">Ngày viết</span>
                        <input type="date" class="form-control" name="txtDate" value="<?= $article['ngayviet'] ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblImage">Hình ảnh</span>
                        <input type="file" class="form-control" name="txtImage">
                    </div>

                    <?php if (!empty($article['hinhanh'])): ?>
                        <div class="mt-3 mb-3">
                            <img src="<?= $article['hinhanh'] ?>" alt="Current Image" style="max-width: 200px;">
                            <p>Current image: <?= basename($article['hinhanh']) ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="form-group float-end">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
