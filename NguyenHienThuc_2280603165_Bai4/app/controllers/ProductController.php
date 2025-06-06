<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once 'app/helpers/SessionHelper.php';

class ProductController
{
    private $productModel;
    private $db;
 // Kiểm tra quyền Admin
    private function isAdmin() {
        return SessionHelper::isAdmin();
    }
      private function islogin() {
        return SessionHelper::isLoggedIn();
    }
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
   
    // Phương thức helper để lấy giỏ hàng của user hiện tại
    private function getUserCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Tạo session cart nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Nếu có user_id, sử dụng riêng cho từng user
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            if (!isset($_SESSION['cart'][$user_id])) {
                $_SESSION['cart'][$user_id] = [];
            }
            return $_SESSION['cart'][$user_id];
        } else {
            // Nếu chưa đăng nhập, sử dụng giỏ hàng chung (guest)
            if (!isset($_SESSION['cart']['guest'])) {
                $_SESSION['cart']['guest'] = [];
            }
            return $_SESSION['cart']['guest'];
        }
    }

    // Phương thức helper để lưu giỏ hàng của user hiện tại
    private function setUserCart($cart)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $_SESSION['cart'][$user_id] = $cart;
        } else {
            // Lưu cho guest
            $_SESSION['cart']['guest'] = $cart;
        }
    }

    // Phương thức helper để xóa giỏ hàng của user hiện tại
    private function clearUserCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            if (isset($_SESSION['cart'][$user_id])) {
                unset($_SESSION['cart'][$user_id]);
            }
        } else {
            if (isset($_SESSION['cart']['guest'])) {
                unset($_SESSION['cart']['guest']);
            }
        }
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);

        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add() {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }

    // Lưu sản phẩm mới (chỉ Admin)
    public function save() {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                ? $this->uploadImage($_FILES['image'])
                : "";

            $result = $this->productModel->addProduct(
                $name, $description, $price, $category_id, $image
            );

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: /NguyenHienThuc_2280603165_Bai4/Product');
            }
        }
    }

     // Sửa sản phẩm (chỉ Admin)
    public function edit($id) {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();

        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

   // Cập nhật sản phẩm (chỉ Admin)
    public function update() {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                ? $this->uploadImage($_FILES['image'])
                : $_POST['existing_image'];

            $edit = $this->productModel->updateProduct(
                $id, $name, $description, $price, $category_id, $image
            );

            if ($edit) {
                header('Location: /NguyenHienThuc_2280603165_Bai4/Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }


    // Xóa sản phẩm (chỉ Admin)
    public function delete($id) {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }

        if ($this->productModel->deleteProduct($id)) {
            header('Location: /NguyenHienThuc_2280603165_Bai4/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }

    private function uploadImage($file)
    {
        $target_dir = "uploads/";

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem file có phải là hình ảnh không
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception("File không phải là hình ảnh.");
        }

        // Kiểm tra kích thước file (10 MB)
        if ($file["size"] > 10 * 1024 * 1024) {
            throw new Exception("Hình ảnh có kích thước quá lớn.");
        }

        // Chỉ cho phép một số định dạng hình ảnh nhất định
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
        }

        // Lưu file
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
        }

        return $target_file;
    }

    public function addToCart($id)
    {
        if (!$this->islogin()) {
             header('Location: /NguyenHienThuc_2280603165_Bai4/Account/login');
            exit;
        }
        // Debug: Kiểm tra session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        // Lấy giỏ hàng hiện tại của user
        $userCart = $this->getUserCart();

        // Thêm sản phẩm vào giỏ hàng
        if (isset($userCart[$id])) {
            $userCart[$id]['quantity']++;
        } else {
            $userCart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // Lưu lại giỏ hàng
        $this->setUserCart($userCart);

        // Debug: Kiểm tra session sau khi lưu
        error_log("Cart after adding: " . print_r($_SESSION['cart'], true));

        header('Location: /NguyenHienThuc_2280603165_Bai4/Product/cart');
        exit;
    }

    public function cart()
    {
        // Lấy giỏ hàng của user hiện tại
        $cart = $this->getUserCart();
        include 'app/views/product/cart.php';
    }

    public function checkout()
    {
        include 'app/views/product/checkout.php';
    }

    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Lấy giỏ hàng của user hiện tại
            $userCart = $this->getUserCart();

            // Kiểm tra giỏ hàng
            if (empty($userCart)) {
                echo "Giỏ hàng trống.";
                return;
            }

            // Bắt đầu giao dịch
            $this->db->beginTransaction();

            try {
                // Lưu thông tin đơn hàng vào bảng orders
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                
                if ($user_id) {
                    $query = "INSERT INTO orders (user_id, name, phone, address) VALUES (:user_id, :name, :phone, :address)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':user_id', $user_id);
                } else {
                    $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
                    $stmt = $this->db->prepare($query);
                }
                
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                // Lưu chi tiết đơn hàng vào bảng order_details
                foreach ($userCart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price)
                              VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }

                // Xóa giỏ hàng của user hiện tại sau khi đặt hàng thành công
                $this->clearUserCart();

                // Commit giao dịch
                $this->db->commit();

                // Chuyển hướng đến trang xác nhận đơn hàng
                header('Location: /NguyenHienThuc_2280603165_Bai4/Product/orderConfirmation');
            } catch (Exception $e) {
                // Rollback giao dịch nếu có lỗi
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';
    }

    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
            // Lấy giỏ hàng hiện tại
            $userCart = $this->getUserCart();
            
            foreach ($_POST['quantities'] as $productId => $quantity) {
                if (isset($userCart[$productId])) {
                    $userCart[$productId]['quantity'] = max(1, intval($quantity));
                }
            }
            
            // Lưu lại giỏ hàng
            $this->setUserCart($userCart);
        }
        header('Location: /NguyenHienThuc_2280603165_Bai4/Product/cart');
        exit;
    }

    public function removeFromCart($id)
    {
        // Lấy giỏ hàng hiện tại
        $userCart = $this->getUserCart();
        
        if (isset($userCart[$id])) {
            unset($userCart[$id]);
        }
        
        // Lưu lại giỏ hàng
        $this->setUserCart($userCart);
        
        header('Location: /NguyenHienThuc_2280603165_Bai4/Product/cart');
        exit();
    }
}
?>