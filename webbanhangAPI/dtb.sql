-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~15 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(4, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(5, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(6, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(7, 'Laptop', 'Danh mục các loại laptop'),
	(8, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(9, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(10, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(11, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(12, 'Laptop', 'Danh mục các loại laptop'),
	(13, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(14, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(15, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~1 rows (approximately)
INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
	(1, 'aa', '000', 'rytuiytui', '2025-03-10 01:59:28');

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~1 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 1, 3, 17890000.00);

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~3 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(1, 'Apple Iphone 14 ProMax 256GB Version', 'Nằm ở phân khúc cao cấp thế nên iPhone 14 Pro Max thể hiện được hiệu năng mạnh mẽ đáng ngạc nhiên của mình. Hiện tại, thiết bị sở hữu con chip mới nhất A16 Bionic của Apple mang lại hiệu năng đầy vượt trội. Con chip này chạy trên tiến trình 4nm giúp cải thiện hiệu suất và tiết kiệm điện năng cho máy. Song song với đó là GPU Apple 5 nhân, hiệu năng tăng 35% giúp đáp ứng tốt khả năng chơi game của máy. ', 17890000.00, 'uploads/230623024256-iphone-14-promax-256g-purple-minh-tuan-mobile.png', 1),
	(2, 'Laptop Lenovo LOQ 15IAX9 83GS001RVN', 'Laptop Lenovo LOQ 15IAX9 83GS001RVN được trang bị bộ xử lý Intel Core i5-12450HX với 8 lõi, 12 luồng cùng RAM DDR5-4800 cho khả năng đa nhiệm ấn tượng. Ổ cứng SSD 512GB chuẩn kết nối PCIe rút ngắn thời gian truy xuất dữ liệu và có thể nâng cấp với lên đến 1TB. Màn hình 15.6 inch cho vùng hiển thị rộng và tốc độ phản hồi nhanh nhờ tần số quét 144Hz. Sản phẩm laptop Lenovo Gaming trang bị đầy đủ cổng giao tiếp để kết nối với nhiều thiết bị ngoại vi. ', 28000000.00, 'uploads/loq_2024_mac24h.png', 2),
	(3, 'MacBook Pro 14 inch', 'Với sức mạnh từ chip M4, MacBook Pro 14 2024 cung cấp hiệu năng vượt trội để bạn làm việc hiệu quả. Sản phẩm đạt thời lượng pin lên đến 24 giờ trải nghiệm, được trang bị màn hình Liquid Retina XDR và hỗ trợ video call hiệu quả với camera 12MP Center Stage. Bộ công cụ Apple Intelligence sẽ đem lại sự trợ giúp tối ưu cho công việc.', 40200000.00, 'uploads/m3-250206041801.png', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
