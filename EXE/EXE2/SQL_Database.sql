-- Tạo database
IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'bke_management')
    CREATE DATABASE bke_management;
GO
USE bke_management;
GO

-- Tạo bảng users
CREATE TABLE users (
    user_id INT IDENTITY(1,1) PRIMARY KEY,
    user_name VARCHAR(25) NOT NULL,
    user_email VARCHAR(55) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    updated_at DATETIME,
    created_at DATETIME
);

-- Thêm dữ liệu vào bảng users
INSERT INTO users (user_name, user_email, user_pass, updated_at, created_at) VALUES
('Alice', 'alice@example.com', 'pass123', GETDATE(), GETDATE()),
('Bob', 'bob@example.com', 'pass456', GETDATE(), GETDATE());

-- Tạo bảng products
CREATE TABLE products (
    product_id INT IDENTITY(1,1) PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price FLOAT NOT NULL,
    product_description TEXT NOT NULL,
    updated_at DATETIME,
    created_at DATETIME
);

-- Thêm dữ liệu vào bảng products
INSERT INTO products (product_name, product_price, product_description, updated_at, created_at) VALUES
('Laptop', 1200.50, 'Laptop cao cấp', GETDATE(), GETDATE()),
('Smartphone', 800.00, 'Điện thoại thông minh', GETDATE(), GETDATE());

-- Tạo bảng orders
CREATE TABLE orders (
    order_id INT IDENTITY(1,1) PRIMARY KEY,
    user_id INT NOT NULL,
    updated_at DATETIME,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Thêm dữ liệu vào bảng orders
INSERT INTO orders (user_id, updated_at, created_at) VALUES
(1, GETDATE(), GETDATE()),
(2, GETDATE(), GETDATE());

-- Tạo bảng order_details
CREATE TABLE order_details (
    order_detail_id INT IDENTITY(1,1) PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    updated_at DATETIME,
    created_at DATETIME,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- Thêm dữ liệu vào bảng order_details
INSERT INTO order_details (order_id, product_id, updated_at, created_at) VALUES
(1, 1, GETDATE(), GETDATE()),
(1, 2, GETDATE(), GETDATE()),
(2, 1, GETDATE(), GETDATE());

SELECT * FROM users;
