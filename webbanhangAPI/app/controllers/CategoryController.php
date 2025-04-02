<?php
// Require các file cần thiết
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/helpers/SessionHelper.php'; // Đảm bảo bạn đã bao gồm helper này để kiểm tra quyền

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        // Kết nối database
        $db = (new Database())->getConnection();
        
        if ($db) {
            $this->categoryModel = new CategoryModel($db);
        } else {
            die("Lỗi kết nối cơ sở dữ liệu.");
        }
    }

    // Hiển thị danh sách danh mục
    public function list()
    {
        // Kiểm tra quyền admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang'); // Chuyển hướng về trang chủ hoặc thông báo lỗi
            exit();
        }

        $categories = $this->categoryModel->getAllCategories() ?? [];
        include 'app/views/category/list.php';
    }

    // Thêm danh mục
    public function add() {
        // Kiểm tra quyền admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang'); // Chuyển hướng về trang chủ hoặc thông báo lỗi
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                if ($this->categoryModel->addCategory($name)) {
                    header('Location: /webbanhang/category/list');
                    exit;
                } else {
                    $error = "Lỗi khi thêm danh mục!";
                }
            } else {
                $error = "Tên danh mục không được để trống!";
            }
        }
        include 'app/views/category/add.php';
    }

    // Chỉnh sửa danh mục
    public function edit($id)
    {
        // Kiểm tra quyền admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang'); // Chuyển hướng về trang chủ hoặc thông báo lỗi
            exit();
        }

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            die("Danh mục không tồn tại.");
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (!empty($name) && !empty($description)) {
                $this->categoryModel->updateCategory($id, $name, $description);
                header("Location: /webbanhang/Category/list");
                exit();
            }
        }
        include 'app/views/category/edit.php';
    }

    // Xóa danh mục
    public function delete($id)
    {
        // Kiểm tra quyền admin
        if (!SessionHelper::isLoggedIn() || !SessionHelper::isAdmin()) {
            header('Location: /webbanhang'); // Chuyển hướng về trang chủ hoặc thông báo lỗi
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->categoryModel->deleteCategory($id);
            header("Location: /webbanhang/Category/list");
            exit();
        }
    }
}
?>
