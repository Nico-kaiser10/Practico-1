<?php
class EnvLoader
{
    public static function cargar(string $ruta): void
    {
        if (!file_exists($ruta)) {
            return;
        }
        $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if ($linea === '' || $linea[0] === '#') {
                continue;
            }
            [$clave, $valor] = array_pad(explode('=', $linea, 2), 2, '');
            $_ENV[trim($clave)] = trim($valor);
        }
    }
}