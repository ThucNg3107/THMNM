<!-- app/views/shares/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm By Thục</title>
    <link rel="shortcut icon" href="https://png.pngtree.com/png-clipart/20230923/original/pngtree-colorful-icon-for-small-convenience-store-logo-supermarket-boutique-vector-png-image_12665767.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(233, 238, 244);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            font-weight: 500;
        }
        .custom-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .navbar, .navbar .nav-link {
            font-weight: bold;
            color: rgb(0, 0, 0) !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: honeydew;">
        <a class="navbar-brand text-danger" href="/NguyenHienThuc_2280603165_Bai5_API/Product/">QUẢN LÝ SẢN PHẨM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5_API/Product/">📋 Danh sách sản phẩm</a>
                </li>
                <?php if (SessionHelper::isAdmin()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5_API/Product/add">➕ Thêm sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5_API/Product/edit/1">✏️ Sửa sản phẩm</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5_API/Product/cart">🛒 Giỏ hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5/api/Product">🌐 ApiProduct</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/NguyenHienThuc_2280603165_Bai5/api/Category">🌐 ApiCategory</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php 
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link'>👤 " . $_SESSION['username'] . "</a>";
                        } else {
                            echo "<a class='nav-link' href='/NguyenHienThuc_2280603165_Bai5_API/account/login'>🔐 Login</a>";
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <?php 
                        if (!SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link' href='/NguyenHienThuc_2280603165_Bai5_API/account/register'>📝 Register</a>";
                        }
                    ?>
                </li>
                <li class="nav-item">
                    <?php 
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link' href='/NguyenHienThuc_2280603165_Bai5_API/account/logout'>🚪 Logout</a>";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
