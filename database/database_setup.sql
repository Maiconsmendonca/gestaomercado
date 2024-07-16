CREATE TABLE IF NOT EXISTS taxes (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     name VARCHAR(255) NOT NULL,
    rate DECIMAL(5, 2) NOT NULL
    );

CREATE TABLE IF NOT EXISTS product_types (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             name VARCHAR(255) NOT NULL,
    tax_rate DECIMAL(5, 2) NOT NULL
    );

CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(255) NOT NULL,
    productTypeId INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (productTypeId) REFERENCES product_types(id)
    );

CREATE TABLE IF NOT EXISTS sales (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS sale_items (
                                          id INT AUTO_INCREMENT PRIMARY KEY,
                                          sale_id INT NOT NULL,
                                          product_id INT NOT NULL,
                                          quantity INT NOT NULL,
                                          unit_price DECIMAL(10, 2) NOT NULL,
    tax DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (sale_id) REFERENCES sales(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
    );

