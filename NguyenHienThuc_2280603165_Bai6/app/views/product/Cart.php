<?php include 'app/views/shares/header.php'; ?>

<div class="container pt-1 ">
    <h1 class="mb-4">Giỏ hàng</h1>

    <?php if (!empty($cart)): ?>
        <form method="POST" action="/NguyenHienThuc_2280603165_Bai6/Product/updateCart">
            <?php
                $total = 0;
                foreach ($cart as $id => $item):
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
            ?>
                <div class="card mb-2 border border-primary rounded p-0">
                    <div class="row g-0 align-items-center">
                        <?php if ($item['image']): ?>
                            <div class="col-md-2 text-center">
                                <img 
                                    src="/NguyenHienThuc_2280603165_Bai6/<?php echo $item['image']; ?>" 
                                    class="img-fluid rounded-start" 
                                    style="max-height: 100px;" 
                                    alt="Ảnh sản phẩm"
                                >
                            </div>
                        <?php endif; ?>

                        <div class="col-md-10">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </h5>
                                    <p class="card-text mb-1">
                                        Giá: 
                                        <strong style="color: red;">
                                            <?php echo number_format($item['price'], 0, ',', '.'); ?> VND
                                        </strong>
                                    </p>

                                    <div class="form-group w-50">
                                        <label for="quantity_<?php echo $id; ?>">Số lượng:</label>
                                        <input 
                                            type="number" 
                                            class="form-control" 
                                            id="quantity_<?php echo $id; ?>" 
                                            name="quantities[<?php echo $id; ?>]" 
                                            value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" 
                                            min="1" 
                                            required
                                        >
                                    </div>
                                </div>

                                <div>
                                    <a 
                                        href="/NguyenHienThuc_2280603165_Bai6/Product/removeFromCart/<?php echo $id; ?>" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');"
                                    >
                                         Xóa
                                    </a>
                                </div>
                            </div>

                            <!-- Thành tiền ở góc phải dưới -->
                            <div class="card-footer text-end bg-light ">
                                <strong class="text-primary">
                                    Thành tiền: <?php echo number_format($itemTotal, 0, ',', '.'); ?> VND
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="/NguyenHienThuc_2280603165_Bai6/Product" class="btn btn-info">
                    ⬅️ Quay lại danh sách sản phẩm
                </a>

                <div>
                    <button type="submit" class="btn btn-warning me-2">
                        🔄 Cập nhật giỏ hàng
                    </button>

                    <a href="/NguyenHienThuc_2280603165_Bai6/Product/checkout" class="btn btn-success">
                        🧾 Thanh Toán
                    </a>
                </div>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Giỏ hàng của bạn đang trống.
        </div>

        <div class="text-center mt-3">
            <a href="/NguyenHienThuc_2280603165_Bai6/Product" class="btn btn-outline-primary">
                ⬅️ Bắt đầu mua sắm
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>
