<?php
class UsuarioModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::conectar();
    }

    public function buscarPorEmail(string $email): ?array
    {
        $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.contrasenia, r.nombre_rol
                FROM usuario u
                INNER JOIN rol r ON r.id_rol = u.id_rol
                WHERE u.email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function contar(): int
    {
        return (int) $this->pdo->query("SELECT COUNT(*) FROM usuario")->fetchColumn();
    }
}