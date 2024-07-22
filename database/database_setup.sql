-- Criação do schema
CREATE SCHEMA IF NOT EXISTS market_management;

-- Seleciona o schema
USE market_management;

-- Criação da tabela `product_types`
CREATE TABLE IF NOT EXISTS product_types (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             name VARCHAR(255) NOT NULL,
    tax_percentage DECIMAL(5, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
    );

-- Criação da tabela `products`
CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
    productTypeId INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (productTypeId) REFERENCES product_types(id)
    );

-- Criação da tabela `sales`
CREATE TABLE IF NOT EXISTS sales (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     date DATE NOT NULL,
                                     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                     deleted_at TIMESTAMP NULL
);

-- Criação da tabela `sale_items`
CREATE TABLE IF NOT EXISTS sale_items (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          sale_id INT NOT NULL,
                                          product_id INT NOT NULL,
                                          quantity INT NOT NULL,
                                          unit_price DECIMAL(10, 2) NOT NULL,
    tax DECIMAL(10, 2) NOT NULL,
    tax_percentage DECIMAL(5, 2),
    tax_amount DECIMAL(10, 2),
    total_amount DECIMAL(10, 2),
    total_amount_with_tax DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
    );
