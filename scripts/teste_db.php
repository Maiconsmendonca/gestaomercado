<?php

require_once 'app/config/database.php';

use App\config\database;

try {
    $pdo = database::getInstance();
    echo "Conexão com o banco de dados estabelecida com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}