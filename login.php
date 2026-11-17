<?php
require_once 'config.php';

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $matkhau = trim($_POST['matkhau'] ?? '');

    $stmt = $conn->prepare("SELECT id, hoten, email, matkhau, vaitro FROM t_nguoidung WHERE email = ? AND trangthai = 'hoatdong' LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        if ($matkhau === $row['matkhau'] || password_verify($matkhau, $row['matkhau'])) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'hoten' => $row['hoten'],
                'email' => $row['email'],
                'vaitro' => $row['vaitro']
            ];
            header("Location: index.php");
            exit;
        }
    }
    $error = "Email hoặc mật khẩu không chính xác!";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - PetShop ERP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-left">
            <div class="brand-logo">
                <i class="fa-solid fa-paw"></i>
                <span>PetShop</span>
            </div>
            <div class="hero-content">
                <h1>PetShop ERP #1</h1>
                <p>Quản trị chuỗi cửa hàng thú cưng từ xa trên cùng 1 nền tảng, an toàn và bảo mật nhất. Hơn <strong>2.000 doanh nghiệp</strong> đã chuyển đổi số thành công nhờ nền tảng quản trị tổng thể PetShop ERP</p>
            </div>
        </div>

        <div class="login-right">
            <div class="login-box">
                <h2>Hệ thống quản lý PetShop</h2>
                <p class="subtitle">Quản lý tổng thể bán hàng, kho vận và chăm sóc khách hàng thú cưng tập trung tại một nơi duy nhất.</p>

                <?php if ($error): ?>
                    <div class="alert-error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Tên đăng nhập" value="admin@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="matkhau" placeholder="Mật khẩu" value="admin" required>
                    </div>
                    <button type="submit" class="btn-login">Đăng nhập</button>
                </form>
                <div class="powered-by">Powered by PetShop</div>
            </div>
        </div>
    </div>
</body>
</html>