<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5" style="max-width: 600px;">
    <h1 class="mb-4">Thanh toán</h1>

    <form method="POST" action="/NguyenHienThuc_2280603165_Bai4/Product/processCheckout">
        <div class="form-group mb-3">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="form-group mb-4">
            <label for="address">Địa chỉ:</label>
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Thanh toán</button>
    </form>

    <a href="/NguyenHienThuc_2280603165_Bai4/Product/cart" class="btn btn-secondary mt-3 d-block text-center">Quay lại giỏ hàng</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>
