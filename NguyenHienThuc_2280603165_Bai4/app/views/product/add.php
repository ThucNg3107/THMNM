<?php include 'app/views/shares/header.php'; ?>

<div class="container pt-1">
    <h1>Thêm sản phẩm mới</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form 
        method="POST" 
        action="/NguyenHienThuc_2280603165_Bai4/Product/save" 
        enctype="multipart/form-data" 
        onsubmit="return validateForm();"
    >
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                required
            >
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control" 
                required
            ></textarea>
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                class="form-control" 
                step="0.01" 
                required
            >
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select 
                id="category_id" 
                name="category_id" 
                class="form-control" 
                required
            >
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>">
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="form-control"
            >
        </div>

        <!-- Các nút nằm ngang -->
        <div class="d-flex justify-content-between align-items-center gap-4 mt-3">
            <button 
                type="submit" 
                class="btn btn-danger"
            >
               ➕ Thêm sản phẩm
            </button>

            <a 
                href="/NguyenHienThuc_2280603165_Bai4/Product/" 
                class="btn btn-info"
            >
                ⬅️ Quay lại danh sách sản phẩm
            </a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
