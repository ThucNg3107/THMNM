<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Chi tiết sản phẩm</h1>

    <div class="row">
        <!-- Cột ảnh bên trái -->
        <div class="col-md-6">
            <?php if ($product->image): ?>
                <img src="/NguyenHienThuc_2280603165_Bai3/<?php echo $product->image; ?>"
                     alt="Product Image"
                     class="img-fluid rounded shadow"
                     style="max-width: 90%;">
            <?php endif; ?>
        </div>

        <!-- Cột thông tin bên phải -->
        <div class="col-md-6 ">
            <h2 style="color: red;"><?php echo htmlspecialchars($product->name ?? 'Tên sản phẩm', ENT_QUOTES, 'UTF-8'); ?></h2>

            <p><strong>Mô tả:</strong> Laptop Lenovo IdeaPad 5 trang bị CPU Intel Core i5, RAM 8GB, SSD 512GB, màn hình 15.6 inch Full HD, thiết kế mỏng nhẹ, pin bền, phù hợp cho học tập và văn phòng.</p>

            <p><strong >Giá:</strong><span class="text-danger font-weight-bold h5"> 16.490.000 VND </p>

            <p><strong>Danh mục:</strong> Laptop</p>

            <a href="/NguyenHienThuc_2280603165_Bai3/Product/index" class="btn btn-secondary mt-3">Quay lại danh sách</a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
