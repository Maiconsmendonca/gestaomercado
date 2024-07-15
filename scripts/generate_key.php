<?php

$generatedKey = bin2hex(random_bytes(32));

// Ajuste o caminho absoluto para o arquivo .env na raiz do seu projeto
$envFile = __DIR__ . '/../.env';
$envContent = file_get_contents($envFile);

// Verifica se a APP_KEY já existe no arquivo .env
if (strpos($envContent, 'APP_KEY=') !== false) {
    // Verifica se a chave já está na frente da APP_KEY
    if (preg_match("/^APP_KEY={$generatedKey}$/m", $envContent)) {
        echo "A chave de aplicativo já está presente no arquivo .env.\n";
    } else {
        // Substitui apenas a chave existente pela nova chave
        $envContent = preg_replace("/^APP_KEY=(.*)$/m", "APP_KEY={$generatedKey}", $envContent);
        file_put_contents($envFile, $envContent);
        echo "A chave de aplicativo foi atualizada no arquivo .env.\n";
    }
} else {
    // Adiciona a nova chave ao final do arquivo .env
    $envContent .= "\nAPP_KEY={$generatedKey}\n";
    file_put_contents($envFile, $envContent);
    echo "Chave de aplicativo gerada e adicionada ao arquivo .env na raiz do projeto.\n";
}
