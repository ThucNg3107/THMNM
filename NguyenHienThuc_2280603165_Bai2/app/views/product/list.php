<?php include 'app/views/shares/header.php'; ?>

<div class="container">
    <h1>Danh sách sản phẩm</h1>

    <a href="/NguyenHienThuc_2280603165_Bai2/Product/add" class="btn btn-danger mb-3">Thêm sản phẩm mới</a>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if ($product->image): ?>
                        <img src="/NguyenHienThuc_2280603165_Bai2/<?php echo $product->image; ?>" 
                             class="card-img-top" 
                             alt="Product Image" 
                             style="height: 300px; object-fit: cover;">
                    <?php endif; ?>

                    <div class="card-body">
    <h5 class="card-title">
        <a href="/NguyenHienThuc_2280603165_Bai2/Product/show/<?php echo $product->id; ?>" style="color: blue;">
            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
        </a>
    </h5>

    <p class="card-text" style="font-weight: bold; color: black;">
        Mô tả: <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
    </p>

    
   
    <p class="card-text" style="font-weight: bold; color: red;; font-size: 25px;"><strong>Giá:</strong> <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>

    <p class="card-text"style="font-weight: bold; color: black;">
        Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
    </p>
</div>

                    <div class="card-footer text-end">
                        <a href="/NguyenHienThuc_2280603165_Bai2/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="/NguyenHienThuc_2280603165_Bai2/Product/delete/<?php echo $product->id; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
