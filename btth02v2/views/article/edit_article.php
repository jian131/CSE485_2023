<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Sửa bài viết</h1>
        <form method="post" action="index.php?action=edit&id=<?= $article['ma_bviet'] ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($article['tieude']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên bài hát:</label>
                <input type="text" class="form-control" id="ten_bhat" name="ten_bhat" value="<?= htmlspecialchars($article['ten_bhat']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Tóm tắt:</label>
                <textarea class="form-control" id="summary" name="summary" rows="3" required><?= htmlspecialchars($article['tomtat']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung:</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5"><?= htmlspecialchars($article['noidung']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="cat_id" class="form-label">Thể loại:</label>
                <select class="form-select" id="cat_id" name="cat_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['ma_tloai'] ?>" <?= $category['ma_tloai'] == $article['ma_tloai'] ? 'selected' : '' ?>><?= $category['ten_tloai'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Tác giả:</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['ma_tgia'] ?>" <?= $author['ma_tgia'] == $article['ma_tgia'] ? 'selected' : '' ?>><?= $author['ten_tgia'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Sửa bài viết</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
