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
                            Tin tức
                            </li>
                        </ol>
                    </nav>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="add-article.php" type="button" class="btn btn-sm btn-primary">
                            Thêm tin tức
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <div class="pt-3 pb-2 mb-3">
                    <h3>Danh sách tin tức</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Chủ đề</th>
                                <th scope="col">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'SELECT articles.id as id, articles.title as title, articles.summary as summary,
                                subcategories.name as subcategory FROM articles JOIN subcategories ON articles.subcategoryID=subcategories.id
                                WHERE articles.is_active = 1';
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <th><?= $row['id'] ?></th>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['summary'] ?></td>
                                <td><?= $row['subcategory'] ?></td>
                                <td>
                                    <a href="edit-article.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">
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
                    <h3>Danh sách tin tức đã ẩn</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Chủ đề</th>
                                <th scope="col">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'SELECT articles.id as id, articles.title as title, articles.summary as summary,
                                subcategories.name as subcategory FROM articles JOIN subcategories ON articles.subcategoryID=subcategories.id
                                WHERE articles.is_active = 0';
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <th><?= $row['id'] ?></th>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['summary'] ?></td>
                                <td><?= $row['subcategory'] ?></td>
                                <td>
                                    <a href="edit-article.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">
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