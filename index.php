<?php
require_once 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$tab = $_GET['tab'] ?? 'ton_kho';
$search = trim($_GET['q'] ?? '');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop ERP - Quản trị hệ thống</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- TOP HEADER -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="workspace-select">
                <i class="fa-solid fa-cloud"></i>
                <span>petshop <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></span>
            </div>
            <button class="toggle-sidebar-btn" onclick="toggleSubSidebar()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="page-title">Kiểm tra dữ liệu</span>
        </div>

        <div class="topbar-right">
            <i class="fa-solid fa-magnifying-glass top-icon"></i>
            <div class="icon-badge">
                <i class="fa-regular fa-calendar"></i>
                <span class="badge red">0</span>
            </div>
            <div class="icon-badge">
                <i class="fa-regular fa-bell"></i>
                <span class="badge orange">289</span>
            </div>
            <i class="fa-solid fa-signal top-icon"></i>
            <span class="flag-vn">★</span>
            <a href="logout.php" class="avatar-circle" title="Đăng xuất (<?= htmlspecialchars($_SESSION['user']['hoten']) ?>)">
                <?= strtoupper(substr($_SESSION['user']['hoten'], 0, 1)) ?>
            </a>
        </div>
    </header>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">
        <!-- SIDEBAR CẤP 1 -->
        <aside class="sidebar-primary" id="sidebarPrimary">
            <a href="?tab=tong_quan" class="nav-item <?= $tab === 'tong_quan' ? 'active' : '' ?>">
                <span class="icon-circle blue"><i class="fa-solid fa-house"></i></span>
                <span class="nav-label">Tổng quan</span>
            </a>
            <a href="?tab=crm" class="nav-item">
                <span class="icon-circle cyan"><i class="fa-solid fa-users"></i></span>
                <span class="nav-label">CRM</span>
            </a>
            <a href="?tab=kpi" class="nav-item">
                <span class="icon-circle orange"><i class="fa-solid fa-chart-line"></i></span>
                <span class="nav-label">KPI</span>
            </a>
            <a href="?tab=bi" class="nav-item">
                <span class="icon-circle teal"><i class="fa-solid fa-chart-pie"></i></span>
                <span class="nav-label">BI</span>
            </a>
            <a href="?tab=don_dat_hang" class="nav-item <?= in_array($tab, ['don_dat_hang', 'bao_gia', 'khuyen_mai']) ? 'active' : '' ?>">
                <span class="icon-circle green"><i class="fa-solid fa-bag-shopping"></i></span>
                <span class="nav-label">Bán hàng</span>
            </a>
            <a href="?tab=don_mua" class="nav-item <?= $tab === 'don_mua' ? 'active' : '' ?>">
                <span class="icon-circle blue"><i class="fa-solid fa-cart-shopping"></i></span>
                <span class="nav-label">Mua hàng</span>
            </a>
            <a href="?tab=ton_kho" class="nav-item <?= in_array($tab, ['ton_kho', 'san_pham']) ? 'active' : '' ?>">
                <span class="icon-circle indigo"><i class="fa-solid fa-warehouse"></i></span>
                <span class="nav-label">Kho</span>
            </a>
            <a href="?tab=van_chuyen" class="nav-item <?= $tab === 'van_chuyen' ? 'active' : '' ?>">
                <span class="icon-circle darkblue"><i class="fa-solid fa-truck"></i></span>
                <span class="nav-label">Giao hàng</span>
            </a>
            <a href="#" class="nav-item">
                <span class="icon-circle yellow"><i class="fa-solid fa-industry"></i></span>
                <span class="nav-label">Sản xuất</span>
            </a>
            <a href="?tab=nhan_su" class="nav-item <?= $tab === 'nhan_su' ? 'active' : '' ?>">
                <span class="icon-circle orange"><i class="fa-solid fa-id-card"></i></span>
                <span class="nav-label">Nhân sự</span>
            </a>
        </aside>

        <!-- SIDEBAR CẤP 2 -->
        <aside class="sidebar-secondary" id="sidebarSecondary">
            <div class="sub-header">BÁN HÀNG & KHO</div>
            <ul class="sub-menu">
                <li><a href="?tab=bao_gia" class="<?= $tab === 'bao_gia' ? 'active' : '' ?>">Báo giá (t_baogia)</a></li>
                <li><a href="?tab=don_dat_hang" class="<?= $tab === 'don_dat_hang' ? 'active' : '' ?>">Đơn đặt hàng (t_donhang)</a></li>
                <li><a href="?tab=ton_kho" class="<?= $tab === 'ton_kho' ? 'active' : '' ?>">Quản lý tồn kho (t_tonkho)</a></li>
                <li><a href="?tab=san_pham" class="<?= $tab === 'san_pham' ? 'active' : '' ?>">Danh mục sản phẩm (t_sanpham)</a></li>
                <li><a href="?tab=van_chuyen" class="<?= $tab === 'van_chuyen' ? 'active' : '' ?>">Đơn vận chuyển (t_donvanchuyen)</a></li>
                <li><a href="?tab=khuyen_mai" class="<?= $tab === 'khuyen_mai' ? 'active' : '' ?>">Chương trình khuyến mãi</a></li>
                <li class="sub-group-title">Báo cáo</li>
                <li><a href="#">Báo cáo VNpost đối soát</a></li>
                <li><a href="#">Báo cáo Viettel đối soát</a></li>
                <li><a href="#">Báo cáo GHTK đối soát</a></li>
                <li><a href="#">Tổng hợp bán hàng</a></li>
            </ul>
        </aside>

        <!-- KHUNG NỘI DUNG CHÍNH -->
        <main class="content-area">
            <div class="action-bar">
                <form method="GET" class="search-box">
                    <input type="hidden" name="tab" value="<?= htmlspecialchars($tab) ?>">
                    <input type="text" name="q" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($search) ?>">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="action-buttons">
                    <button class="btn-primary" onclick="alert('Mở form Tạo mới cho mục: <?= $tab ?>')">
                        <i class="fa-solid fa-circle-plus"></i> Tạo mới
                    </button>
                    <button class="btn-outline">Nhập khẩu</button>
                    <a href="?tab=<?= htmlspecialchars($tab) ?>" class="btn-outline">
                        <i class="fa-solid fa-rotate-right"></i> Làm mới
                    </a>
                </div>
            </div>

            <div class="data-card">
                <?php if ($tab === 'ton_kho'): ?>
                    <h3>Danh sách Tồn kho (Bảng `t_tonkho` kết hợp `t_sanpham` & `t_kho`)</h3>
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>Mã SP</th>
                                <th>Tên sản phẩm</th>
                                <th>Kho lưu trữ</th>
                                <th>Số lượng tồn</th>
                                <th>Ngưỡng tối thiểu</th>
                                <th>Cập nhật lần cuối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT tk.*, sp.tensp, k.tenkho 
                                    FROM t_tonkho tk
                                    JOIN t_sanpham sp ON tk.masp = sp.masp
                                    JOIN t_kho k ON tk.makho = k.makho
                                    WHERE sp.tensp LIKE ? OR tk.masp LIKE ?";
                            $like = "%$search%";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $like, $like);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($r = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($r['masp']) ?></strong></td>
                                    <td><?= htmlspecialchars($r['tensp']) ?></td>
                                    <td><?= htmlspecialchars($r['tenkho']) ?> (<?= $r['makho'] ?>)</td>
                                    <td><span class="status-badge green"><?= $r['soluongton'] ?></span></td>
                                    <td><?= $r['nguongtonkhotoithieu'] ?></td>
                                    <td><?= $r['ngaycapnhat'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                <?php elseif ($tab === 'san_pham'): ?>
                    <h3>Danh sách Sản phẩm (Bảng `t_sanpham`)</h3>
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>Mã SP</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá bán</th>
                                <th>Đã bán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT sp.*, dm.tendm FROM t_sanpham sp LEFT JOIN t_danhmuc dm ON sp.madm = dm.madm WHERE sp.tensp LIKE ?";
                            $like = "%$search%";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $like);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($r = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($r['masp']) ?></strong></td>
                                    <td><?= htmlspecialchars($r['tensp']) ?></td>
                                    <td><?= htmlspecialchars($r['tendm'] ?? 'Chưa phân loại') ?></td>
                                    <td><?= number_format($r['giaban'], 0, ',', '.') ?> đ</td>
                                    <td><?= $r['daban'] ?></td>
                                    <td><span class="status-badge blue"><?= $r['trangthai'] ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <h3>Danh sách Đơn đặt hàng (Bảng `t_donhang`)</h3>
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT * FROM t_donhang ORDER BY madon DESC");
                            if ($res && $res->num_rows > 0):
                                while ($r = $res->fetch_assoc()): ?>
                                    <tr>
                                        <td>#<?= $r['madon'] ?></td>
                                        <td><?= htmlspecialchars($r['hotennguoinhan']) ?></td>
                                        <td><?= htmlspecialchars($r['dienthoainguoinhan']) ?></td>
                                        <td><?= number_format($r['tongtien'], 0, ',', '.') ?> đ</td>
                                        <td><?= $r['dathanhtoan'] ? 'Đã thanh toán' : 'Chưa thanh toán' ?></td>
                                        <td><span class="status-badge orange"><?= $r['trangthai'] ?></span></td>
                                        <td><?= $r['ngaydat'] ?></td>
                                    </tr>
                                <?php endwhile;
                            else: ?>
                                <tr>
                                    <td colspan="7" style="text-align:center; padding: 30px; color: #777;">
                                        Chưa có dữ liệu đơn hàng trong bảng <code>t_donhang</code>. Hãy bấm sang tab <strong>Quản lý tồn kho</strong> hoặc <strong>Danh mục sản phẩm</strong> bên trái để xem dữ liệu có sẵn!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        function toggleSubSidebar() {
            const sub = document.getElementById('sidebarSecondary');
            sub.style.display = (sub.style.display === 'none') ? 'block' : 'none';
        }
    </script>
</body>
</html>