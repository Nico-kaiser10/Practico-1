<?php
spl_autoload_register(function (string $clase) {
    $candidatos = [
        __DIR__ . "/src/Controllers/$clase.php",
        __DIR__ . "/src/Models/$clase.php",
        __DIR__ . "/src/Utils/$clase.php",
        __DIR__ . "/config/" . strtolower($clase) . ".php",
    ];
    foreach ($candidatos as $archivo) {
        if (file_exists($archivo)) {
            require_once $archivo;
            return;
        }
    }
});