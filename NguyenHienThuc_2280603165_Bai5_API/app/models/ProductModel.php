<?php

class ProductModel
{
    private $conn;
    private $table_name = "product";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Lấy tất cả sản phẩm cùng tên danh mục.
     */
    public function getProducts(): array
    {
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name
                  FROM " . $this->table_name . " p
                  LEFT JOIN category c ON p.category_id = c.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy 1 sản phẩm theo ID.
     */
    public function getProductById(int $id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Thêm sản phẩm mới.
     */
    public function addProduct(string $name, string $description, float $price, int $category_id)
    {
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if ($price < 0) {
            $errors['price'] = 'Giá sản phẩm phải >= 0';
        }
        if ($category_id <= 0) {
            $errors['category_id'] = 'Danh mục không hợp lệ';
        }

        if (!empty($errors)) return $errors;

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id)
                  VALUES (:name, :description, :price, :category_id)";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price); // float nên không cần ép kiểu param
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Cập nhật sản phẩm.
     */
    public function updateProduct(int $id, string $name, string $description, float $price, int $category_id): bool
    {
        $query = "UPDATE " . $this->table_name . "
                  SET name = :name,
                      description = :description,
                      price = :price,
                      category_id = :category_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Xoá sản phẩm theo ID.
     */
    public function deleteProduct(int $id): bool
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
