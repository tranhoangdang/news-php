<?php
    session_start();
    include('../database/conn.php');
    require_once('functions.php');

    if(!isset($_SESSION['login'])){
        redirect('login.php');
    }

    $id = $_GET['id'];

    if(isset($_POST['update'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $summary = $_POST['summary'];
        $subcategory = $_POST['subcategory'];
        $status = $_POST['status'];

        $sql = "UPDATE articles SET title = '$title', content = '$content',
        summary = '$summary', subcategoryID = '$subcategory', is_active = '$status' WHERE id = $id";

        if($conn->query($sql) === TRUE){
            set_flash_session('mess_flash', 'Bài viết đã được chỉnh sửa.');
            redirect('edit-article.php?id='.$id);
        } else {
            $error = $conn->error;
        }
    }

    if(isset($_POST['change'])){
        $fileName = "../public/uploads/" . $_FILES["fileToUpload"]["name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileName);

        $sql = "UPDATE articles SET cover = '$fileName' WHERE id = $id";

        if($conn->query($sql) === TRUE){
            set_flash_session('mess_flash', 'Ảnh bìa đã được thay đổi.');
            redirect('edit-article.php?id='.$id);
        } else {
            $error = $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức 24/7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../public/images/news-report-icon.png" type="image/x-icon">
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include('components/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include('components/sidebar.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 mb-3 border-bottom">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="article.php">Tin tức</a>
                            </li>
                            <li class="breadcrumb-item">Chỉnh sửa tin tức</li>
                        </ol>
                    </nav>
                </div>
                <?php
                    $mess = get_flash_session('mess_flash');
                    if(isset($mess)){
                ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Thành công!</strong> <?= $mess; ?>
                    </div>
                <?php
                    }
                ?>
                <?php
                    if(isset($error)){
                ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Đã xảy ra lỗi!</strong> <?= $error; ?>
                    </div>
                <?php
                    }
                ?>
                <form method="post">
                    <div class="row">
                        <?php
                            $sql = "SELECT title, cover, content, summary
                            FROM articles WHERE id=$id";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                        ?>
                        <div class="col-md-7 col-sm-12">
                            <div class="mb-3 mt-3">
                                <label for="title" class="form-label">Tiêu đề:</label>
                                <input type="text" class="form-control" id="title" value="<?= $row['title'] ?>" name="title" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="summary" class="form-label">Tóm tắt:</label>
                                <textarea name="summary" class="form-control" id="summary" cols="30" rows="3"><?= $row['summary'] ?></textarea>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label">Nội dung:</label>
                                <textarea name="content" class="form-control" id="content"><?= $row['content'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <div class="mb-3 mt-3">
                                <img src="<?= $row['cover'] ?>" class="mt-3 form-control">
                                <button type="button" class="btn btn-sm btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#changeCover">
                                    Đổi ảnh bìa
                                </button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thuộc chủ đề:</label>
                                <select class="form-select" name="subcategory">
                                    <?php
                                        $sql = 'SELECT subcategories.id as id, subcategories.name as name
                                        FROM subcategories JOIN articles ON subcategories.id=articles.subcategoryID
                                        WHERE articles.id = '.$id;
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                            while ($row = $result->fetch_assoc()){
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                            }
                                        }
                                        $sql = 'SELECT id, name FROM subcategories WHERE is_active = 1
                                        EXCEPT SELECT subcategories.id as id, subcategories.name as name
                                        FROM subcategories JOIN articles ON subcategories.id=articles.subcategoryID
                                        WHERE articles.id = '.$id;
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                            while ($row = $result->fetch_assoc()){
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái:</label>
                                <select class="form-select" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="update">Lưu</button>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <div class="modal" id="changeCover">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đổi ảnh bìa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="fileToUpload" class="form-label">Ảnh bìa:</label>
                        <input type="file" accept="image/png, image/jpg" class="form-control" id="fileToUpload" name="fileToUpload" onchange="preview(event)" required>
                        <img src="../public/images/default-thumbnail.jpeg" class="mt-3" id="frame">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="change">Lưu</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Huỷ</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="../public/js/main.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content'))
        .catch(error => {
            console.error(error)
        });
    </script>
</body>
</html>