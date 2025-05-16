<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center text-danger">DANH SÁCH SẢN PHẨM</h1>
        <div class="text-end mb-4">
            <a href="/NguyenHienThuc_2280603165_Bai1/Product/add" class="btn btn-success">+ Thêm sản phẩm mới</a>
        </div>

        <?php if (!empty($products)) : ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($products as $product) : ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    <?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo nl2br(htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8')); ?>
                                </p>
                                <p class="card-text fw-bold text-success">
                                    Giá: <?php echo number_format($product->getPrice(), 0, ',', '.'); ?>₫
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="/NguyenHienThuc_2280603165_Bai1/Product/edit/<?php echo $product->getID(); ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="/NguyenHienThuc_2280603165_Bai1/Product/delete/<?php echo $product->getID(); ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?');">Xoá</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-muted text-center">Không có sản phẩm nào.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
