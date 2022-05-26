<?php
    session_start();
    include('../database/conn.php');
    require_once('functions.php');

    if(!isset($_SESSION['login'])){
        redirect('login.php');
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
                            Chuyên mục
                            </li>
                        </ol>
                    </nav>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="add-category.php" type="button" class="btn btn-sm btn-primary">
                            Thêm chuyên mục
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <h3>Danh sách chuyên mục</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên chuyên mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Chỉnh sửa gần đây</th>
                                <th scope="col">Cài đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT id,name,created_at,updated_at FROM categories WHERE is_active = 1";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <th><?= $row['id'] ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= isset($row['updated_at']) ? $row['updated_at'] : 'Chưa chỉnh sửa' ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                else {
                            ?>
                                <td colspan="5" style="text-align: center">No data available</td>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <h3>Danh sách chuyên mục đã ẩn</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên chuyên mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Chỉnh sửa gần đây</th>
                                <th scope="col">Cài đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT id,name,created_at,updated_at FROM categories WHERE is_active = 0";
                                $result= $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <th><?= $row['id'] ?></th>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= isset($row['updated_at']) ? $row['updated_at'] : 'Chưa chỉnh sửa' ?></td>
                                <td>
                                    <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                                else {
                            ?>
                                <td colspan="5" style="text-align: center">No data available</td>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>