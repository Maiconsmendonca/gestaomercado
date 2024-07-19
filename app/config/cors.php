<?php
header("Access-Control-Allow-Origin: http://localhost:3000"); // URL do frontend
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeçalhos permitidos

// Para responder a uma solicitação OPTIONS, adicione o seguinte:
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}
?>
