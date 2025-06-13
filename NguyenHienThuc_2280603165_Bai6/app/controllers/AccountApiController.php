<?php
require_once 'app/models/UserModel.php';
require_once 'app/utils/JWTHandler.php';

class AccountApiController
{
    public function login()
    {
        header('Content-Type: application/json');

        // Nhận dữ liệu JSON từ body
        $data = json_decode(file_get_contents("php://input"), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $jwt = new JWTHandler();
            $token = $jwt->encode([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]);

            echo json_encode(['token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}
