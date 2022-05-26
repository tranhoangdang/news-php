<?php
    session_start();
    include('../database/conn.php');
    require_once('functions.php');

    if(!isset($_SESSION['login'])){
        redirect('login.php');
    }

    if(isset($_POST['change'])){
        $pwd = $_POST['pwd'];
        $new_pwd = $_POST['new_pwd'];
        $re_pwd = $_POST['re_pwd'];
        $id = $_SESSION['login'];

        $sql = "SELECT password FROM admins WHERE id = $id AND password = md5('$pwd')";
        $result = $conn->query($sql);

        if($result->num_rows == 0){
            echo "<script> alert('Mật khẩu hiện tại không đúng') </script>";
        }
        else{
            if($new_pwd == $re_pwd){
                $sql = "UPDATE admins SET password = md5('$new_pwd') WHERE id = $id";

                if($conn->query($sql) === TRUE){
                    set_flash_session('mess_flash', 'Mật khẩu đã được thay đổi.');
                    redirect('change-pass.php?id='.$id);
                } else {
                    $error = $conn->error;
                }
            }
            else{
                echo "<script> alert('Mật khẩu không trùng nhau.') </script>";
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
                            Đổi mật khẩu
                            </li>
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
                        <label for="pwd" class="form-label">Mật khẩu hiện tại:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu hiện tại" name="pwd" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="new_pwd" class="form-label">Mật khẩu mới:</label>
                        <input type="password" class="form-control" id="new_pwd" placeholder="Nhập mật khẩu mới" name="new_pwd" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="re_pwd" class="form-label">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="re_pwd" placeholder="Nhập mật khẩu hiện tại" name="re_pwd" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="change">Lưu</button>
                </form>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>