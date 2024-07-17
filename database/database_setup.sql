CREATE TABLE IF NOT EXISTS taxes (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     name VARCHAR(255) NOT NULL,
    rate DECIMAL(5, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
    );

CREATE TABLE IF NOT EXISTS product_types (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             name VARCHAR(255) NOT NULL,
    tax_porcentage DECIMAL(5, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
    );

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

CREATE TABLE IF NOT EXISTS sales (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     date DATE NOT NULL,
                                     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                     deleted_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS sale_items (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          sale_id INT NOT NULL,
                                          product_id INT NOT NULL,
                                          quantity INT NOT NULL,
                                          unit_price DECIMAL(10, 2) NOT NULL,
    tax DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
    );


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