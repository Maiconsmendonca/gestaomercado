<?php

use App\config\database;

require 'path/to/your/config/database.php';

$db = Database::getInstance();

$sqlFilePath = 'path/to/database_setup.sql';

try {
    $query = file_get_contents($sqlFilePath);
    $db->exec($query);
    echo "Banco de dados configurado com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao configurar o banco de dados: " . $e->getMessage();
}