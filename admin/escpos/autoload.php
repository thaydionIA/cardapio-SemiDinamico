<?php
spl_autoload_register(function ($class) {
    $prefix = 'Mike42\\';
    $base_dir = __DIR__ . '/Mike42/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        echo "Carregando classe: $file\n"; // Log para depurar
        require $file;
    } else {
        echo "Erro: Arquivo não encontrado para a classe $class\n"; // Log para depurar
    }
});


