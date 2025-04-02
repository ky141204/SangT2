<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <h1 class="text-center mb-4">Danh sách sản phẩm</h1>
    
    <div class="d-flex justify-content-between mb-3">
        <?php if (SessionHelper::isAdmin()): ?>
            <a href="/webbanhang/Product/add" class="btn btn-success">
                ➕ Thêm sản phẩm mới
            </a>
        <?php endif; ?>
        
        <a href="/webbanhang/cart" class="btn btn-warning">
            🛒 Giỏ hàng
        </a>
    </div>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <?php if ($product->image): ?>
                        <img src="/webbanhang/<?php echo $product->image; ?>" alt="Product Image" class="card-img-top">
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted">
                            <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                        <p class="fw-bold">💰 Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                        <p class="text-primary">📂 Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                        
                        <div class="d-flex justify-content-between">
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">
                                    ✏️ Sửa
                                </a>
                                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    ❌ Xóa
                                </a>
                            <?php endif; ?>
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary">
                                🛒 Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>
