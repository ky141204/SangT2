<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fc;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #8B0000 !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 1.7rem;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: 0.3s;
            padding: 0.8rem 1rem;
            text-transform: uppercase;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #ff0000 !important;
            background-color: #fff;
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .card {
            transition: transform 0.3s ease-in-out;
            background-color: #000;
            color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #ddd;
        }

        .btn-custom {
            background-color: #ff0000;
            border: none;
            color: #fff;
            font-weight: 600;
        }

        .btn-custom:hover {
            background-color: #e60000;
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin-top: 100px;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/webbanhang/product/list">Quản lý sản phẩm</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/list">📦 Danh sách sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">➕ Thêm sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/Cart">🛒 Giỏ hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/category/list">📂 Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        require_once __DIR__ . '/../../helpers/SessionHelper.php';

                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link'>" . $_SESSION['username'] . "</a>";
                        } else {
                            echo "<a class='nav-link' href='/webbanhang/account/login'>🔑 Đăng nhập</a>";
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (SessionHelper::isLoggedIn()) {
                            echo "<a class='nav-link' href='/webbanhang/account/logout'>🚪 Đăng xuất</a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row">
            <!-- Example of a product card, you can loop through your product data here -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tên sản phẩm</h5>
                        <p class="card-text">Mô tả ngắn gọn về sản phẩm.</p>
                        <a href="#" class="btn btn-custom">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Add more product cards here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
