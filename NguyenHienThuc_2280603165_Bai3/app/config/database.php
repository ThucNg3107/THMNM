<?php

class Database
{
    private $host = "localhost";
    private $db_name = "my_store";
    private $username = "root";
    private $password = "";
    public $conn;

    /**
     * Lấy kết nối đến cơ sở dữ liệu.
     *
     * @return PDO|null Đối tượng PDO nếu kết nối thành công, ngược lại là null.
     */
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // Trong môi trường production, bạn nên log lỗi thay vì hiển thị trực tiếp.
            echo "Lỗi kết nối: " . $exception->getMessage();
        }

        return $this->conn;
    }
}