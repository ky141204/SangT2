<?php
// Require các file cần thiết
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';

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
        $categories = $this->categoryModel->getAllCategories() ?? [];
        include 'app/views/category/list.php';
    }

    // Thêm danh mục
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (!empty($name)) {
                $this->categoryModel->addCategory($name, $description);
                header("Location: /webbanhang/Category/list");
                exit();
            }
        }
        include 'app/views/category/add.php';
    }

    // Chỉnh sửa danh mục
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            die("Danh mục không tồn tại.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (!empty($name)) {
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
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            die("Danh mục không tồn tại.");
        }

        $this->categoryModel->deleteCategory($id);
        header("Location: /webbanhang/Category/list");
        exit();
    }
}
?>
