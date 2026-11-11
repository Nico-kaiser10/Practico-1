<?php
class AuthController
{
    public function login(): void
    {
        $datos       = json_decode(file_get_contents('php://input'), true) ?? [];
        $email       = trim($datos['email'] ?? '');
        $contrasenia = $datos['contrasenia'] ?? '';

        if ($email === '' || $contrasenia === '') {
            Response::json(['error' => 'Email y contraseña son obligatorios'], 400);
        }

        $usuario = (new UsuarioModel())->buscarPorEmail($email);

        if (!$usuario || !password_verify($contrasenia, $usuario['contrasenia'])) {
            Response::json(['error' => 'Email o contraseña incorrectos'], 401);
        }

        Auth::iniciarSesion();
        session_regenerate_id(true);
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre']     = $usuario['nombre'] . ' ' . $usuario['apellido'];
        $_SESSION['rol']        = $usuario['nombre_rol'];

        $destino = ($usuario['nombre_rol'] === 'Administrador')
            ? '/front/dist/paginas/admin/dashboard.html'
            : '/front/dist/paginas/usuario/inicio.html';

        Response::json([
            'nombre'   => $_SESSION['nombre'],
            'rol'      => $_SESSION['rol'],
            'redirect' => $destino,
        ]);
    }

    public function logout(): void
    {
        Auth::iniciarSesion();
        $_SESSION = [];
        session_destroy();
        Response::json(['ok' => true]);
    }

    public function me(): void
    {
        Auth::requerirLogin();
        Response::json([
            'nombre' => $_SESSION['nombre'],
            'rol'    => $_SESSION['rol'],
        ]);
    }
}