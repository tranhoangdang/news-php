<?php
    session_start();
    include('../database/conn.php');
    require_once('functions.php');

    if(isset($_SESSION['login'])){
        redirect('index.php');
    }

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = $_POST['pswd'];

        $sql = "SELECT email, password,id FROM admins WHERE email = '$email' AND password = md5('$pwd') AND is_active=1";
        $result = $conn->query($sql);

        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result);
            $_SESSION["login"] = $row['id'];

            redirect('index.php');
        }
        else
        {
            echo '<script> alert("Email hoặc password không đúng"); </script>';
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
    <div id="login-form">
        <form method="post">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="pswd" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>