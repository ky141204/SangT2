<?php
session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/app/controllers/$class.php";
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once 'app/models/ProductModel.php';
require_once 'app/helpers/SessionHelper.php';
require_once('app/controllers/AccountController.php');



// Product/add
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DefaultController';

// Kiểm tra phần thứ hai của URL để xác định action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

$controllerPath = __DIR__ . "/app/controllers/$controllerName.php";

// Kiểm tra xem controller và action có tồn tại không
if (!file_exists($controllerPath)) {
    // Xử lý không tìm thấy controller
    die('Controller not found');
}

require_once $controllerPath;

if (!class_exists($controllerName)) {
    die("Controller class not found");
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    // Xử lý không tìm thấy action
    die('Action not found');
}

// Routes cho danh mục
elseif ($controller === 'category') {
    require_once 'app/controllers/CategoryController.php';
    $categoryController = new CategoryController();
    if ($action === 'list') {
        $categoryController->list();
    } elseif ($action === 'add') {
        $categoryController->add();
    }
}


// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));
