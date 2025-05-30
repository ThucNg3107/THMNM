<?php include 'app/views/shares/header.php'; ?>

<div class="container">
    <h1>Danh sách sản phẩm</h1>

    <a href="/NguyenHienThuc_2280603165_Bai3/Product/add" class="btn btn-danger mb-3">
        Thêm sản phẩm mới
    </a>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-info rounded">
                    
                    <?php if ($product->image): ?>
                        <img src="/NguyenHienThuc_2280603165_Bai3/<?php echo $product->image; ?>" 
                             class="card-img-top" 
                             alt="Product Image" 
                             style="height: 250px; object-fit: cover;">
                    <?php endif; ?>

                    <div class="card-body " style="line-height: 1.3;margin-left:32px">
                        
                        <h5 class="card-title mb-4">
                            <a href="/NguyenHienThuc_2280603165_Bai3/Product/show/<?php echo $product->id; ?>" 
                               style="color:blueviolet; font-weight: bold; font-size: 20px;">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>

                        <p class="card-text mb-1" style="font-weight: bold; color: black;">
                            Mô tả: <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                        <p class="card-text mb-1" style="font-weight: bold; color: red; font-size: 22px;">
                            Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>

                        <p class="card-text mb-1" style="font-weight: bold; color: green;">
                            Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                        </p>

                    </div>

                    <div class="card-footer text-center">
                        <a href="/NguyenHienThuc_2280603165_Bai3/Product/edit/<?php echo $product->id; ?>" 
                           class="btn btn-warning btn-sm">Sửa</a>

                        <a href="/NguyenHienThuc_2280603165_Bai3/Product/delete/<?php echo $product->id; ?>"
                           class="btn btn-info btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>

                        <a href="/NguyenHienThuc_2280603165_Bai3/Product/addToCart/<?php echo $product->id; ?>" 
                           class="btn btn-success btn-sm">Thêm vào giỏ hàng</a>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
