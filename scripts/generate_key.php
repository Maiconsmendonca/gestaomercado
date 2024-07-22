<?php

$generatedKey = bin2hex(random_bytes(32));

$envFile = __DIR__ . '/../.env';
$envContent = file_get_contents($envFile);

if (strpos($envContent, 'APP_KEY=') !== false) {
    if (preg_match("/^APP_KEY={$generatedKey}$/m", $envContent)) {
        echo "A chave de aplicativo já está presente no arquivo .env.\n";
    } else {
        $envContent = preg_replace("/^APP_KEY=(.*)$/m", "APP_KEY={$generatedKey}", $envContent);
        file_put_contents($envFile, $envContent);
        echo "A chave de aplicativo foi atualizada no arquivo .env.\n";
    }
} else {
    $envContent .= "\nAPP_KEY={$generatedKey}\n";
    file_put_contents($envFile, $envContent);
    echo "Chave de aplicativo gerada e adicionada ao arquivo .env na raiz do projeto.\n";
}
