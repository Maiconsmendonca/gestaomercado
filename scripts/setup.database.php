<?php
require 'path/to/your/config/database.php'; // Ajuste o caminho conforme necessário

$db = Database::getInstance();

// Caminho para o arquivo SQL
$sqlFilePath = 'path/to/database_setup.sql'; // Ajuste o caminho conforme necessário

try {
    $query = file_get_contents($sqlFilePath);
    $db->exec($query);
    echo "Banco de dados configurado com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao configurar o banco de dados: " . $e->getMessage();
}