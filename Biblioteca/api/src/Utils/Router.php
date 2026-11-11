<?php
class Router
{
    private array $rutas = [];

    public function get(string $ruta, string $accion): void
    {
        $this->rutas['GET'][$ruta] = $accion;
    }

    public function post(string $ruta, string $accion): void
    {
        $this->rutas['POST'][$ruta] = $accion;
    }

    public function despachar(): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $ruta = '/' . trim(substr($uri, strlen($base)), '/');

        if (!isset($this->rutas[$metodo][$ruta])) {
            Response::json(['error' => 'Ruta no encontrada'], 404);
        }

        [$clase, $funcion] = explode('@', $this->rutas[$metodo][$ruta]);
        (new $clase())->$funcion();
    }
}