<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category"; // Table name

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả danh mục
    public function getCategories()
    {
        return $this->getAllCategories();
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Return error message in case of failure
            return ['error' => 'Lỗi khi lấy danh mục: ' . $e->getMessage()];
        }
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Return error message in case of failure
            return ['error' => 'Lỗi khi lấy danh mục theo ID: ' . $e->getMessage()];
        }
    }

    // Thêm danh mục mới
    public function addCategory($name)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " (name) VALUES (:name)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            // Return error message in case of failure
            return ['error' => 'Lỗi khi thêm danh mục: ' . $e->getMessage()];
        }
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE category SET name = :name, description = :description WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            // Return error message in case of failure
            return ['error' => 'Lỗi khi cập nhật danh mục: ' . $e->getMessage()];
        }
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM category WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            // Return error message in case of failure
            return ['error' => 'Lỗi khi xóa danh mục: ' . $e->getMessage()];
        }
    }
}
?>
