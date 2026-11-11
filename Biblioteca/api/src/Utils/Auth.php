<?php
class Auth
{
    public static function iniciarSesion(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
            session_start();
        }
    }

    public static function requerirLogin(): void
    {
        self::iniciarSesion();
        if (!isset($_SESSION['id_usuario'])) {
            Response::json(['error' => 'No autenticado'], 401);
        }
    }

    public static function requerirRol(string $rol): void
    {
        self::requerirLogin();
        if ($_SESSION['rol'] !== $rol) {
            Response::json(['error' => 'Acceso denegado'], 403);
        }
    }
}