<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách sản phẩm</h1>

<a href="/NguyenHienThuc_2280603165_Bai5_API/Product/add" class="btn btn-success mb-3">Thêm sản phẩm mới</a>

<div class="row" id="product-list">
    <!-- Danh sách sản phẩm sẽ được tải từ API và hiển thị tại đây -->
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch('/NguyenHienThuc_2280603165_Bai5_API/api/Product')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');

            data.forEach(product => {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';

                col.innerHTML = `
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/NguyenHienThuc_2280603165_Bai5_API/Product/show/${product.id}">
                                    ${product.name}
                                </a>
                            </h5>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text"><strong>Giá:</strong> ${product.price} VND</p>
                            <p class="card-text"><strong>Danh mục:</strong> ${product.category_name}</p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="/NguyenHienThuc_2280603165_Bai5_API/Product/edit/${product.id}" class="btn btn-warning btn-sm">Sửa</a>
                            <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Xóa</button>
                        </div>
                    </div>
                `;

                productList.appendChild(col);
            });
        });
});

function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        fetch(`/NguyenHienThuc_2280603165_Bai5_API/api/Product/${id}`, {
            method: 'DELETE'
        })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Product deleted successfully') {
                    location.reload();
                } else {
                    alert('Xóa sản phẩm thất bại');
                }
            });
    }
}
</script>
