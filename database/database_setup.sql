CREATE TABLE tipos_de_produtos (
                                   id INT AUTO_INCREMENT PRIMARY KEY,
                                   nome VARCHAR(255) NOT NULL
);

CREATE TABLE produtos (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nome VARCHAR(255) NOT NULL,
                          tipo_produto_id INT,
                          preco DECIMAL(10, 2) NOT NULL,
                          FOREIGN KEY (tipo_produto_id) REFERENCES tipos_de_produtos(id)
);

CREATE TABLE impostos (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          tipo_produto_id INT,
                          percentual DECIMAL(5, 2) NOT NULL,
                          FOREIGN KEY (tipo_produto_id) REFERENCES tipos_de_produtos(id)
);

CREATE TABLE vendas (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
                        valor_total DECIMAL(10, 2) NOT NULL,
                        imposto_total DECIMAL(10, 2) NOT NULL
);

CREATE TABLE itens_de_venda (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                venda_id INT,
                                produto_id INT,
                                quantidade INT,
                                preco DECIMAL(10, 2) NOT NULL,
                                imposto DECIMAL(10, 2) NOT NULL,
                                FOREIGN KEY (venda_id) REFERENCES vendas(id),
                                FOREIGN KEY (produto_id) REFERENCES produtos(id)
);