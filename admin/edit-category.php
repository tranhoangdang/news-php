<?php
    session_start();
    include('../database/conn.php');
    require_once('functions.php');

    if(!isset($_SESSION['login'])){
        redirect('login.php');
    }

    $id = $_GET['id'];

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $status = $_POST['status'];

        $sql = "UPDATE categories SET name = '$name', is_active = '$status' WHERE id = $id";

        if($conn->query($sql) === TRUE){
            set_flash_session('mess_flash', 'Chuyên mục đã được chỉnh sửa.');
            redirect('edit-category.php?id='.$id);
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
                                <a href="category.php">Chuyên mục</a>
                            </li>
                            <li class="breadcrumb-item">Chỉnh sửa chuyên mục</li>
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
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên chuyên mục:</label>
                        <?php
                            $sql = "SELECT name FROM categories WHERE id = $id";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                        ?>
                        <input type="text" class="form-control" id="name" value="<?= $row['name'] ?>" name="name" required>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái:</label>
                        <select class="form-select" name="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Sửa</button>
                </form>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>