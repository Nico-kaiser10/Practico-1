<?php
class AdminController
{
    public function resumen(): void
    {
        Auth::requerirRol('Administrador');
        Response::json(['usuarios' => (new UsuarioModel())->contar()]);
    }
}