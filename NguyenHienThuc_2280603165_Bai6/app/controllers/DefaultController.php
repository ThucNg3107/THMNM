<?php
class DefaultController
{
    public function index()
    {
        echo '
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <title>Trang chính</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-light d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            <div class="text-center">
                <h1 class="text-danger mb-4">BÀI 4</h1>
                <a href="/NguyenHienThuc_2280603165_Bai4/Product/" class="btn btn-success btn-lg">
                    Click zô đây!!
                </a>
            </div>
        </body>
        </html>';
    }
}
