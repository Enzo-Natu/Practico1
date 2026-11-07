<?php
session_start();
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($email) && !empty($password)) {
        try {
            $database = new Database();
            $pdo = $database->getConnection();

            $sql = "SELECT u.*, r.nombre_rol FROM usuarios u 
                    INNER JOIN roles r ON u.id_rol = r.id_rol 
                    WHERE u.email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre']     = $usuario['nombre'];
                $_SESSION['email']      = $usuario['email'];
                $_SESSION['rol']        = $usuario['nombre_rol'];

                if ($usuario['nombre_rol'] === 'Administrador') {
                    header("Location: ../front/dist/paginas/administrador/dashboard.html");
                    exit();
                } else {
                    header("Location: ../front/dist/paginas/usuario/panel.html");
                    exit();
                }
            } else {
                header("Location: ../front/dist/paginas/login.html?error=credenciales_invalidas");
                exit();
            }

        } catch (Exception $e) {
            die("Error en el servidor: " . $e->getMessage());
        }
    } else {
        header("Location: ../front/dist/paginas/login.html?error=campos_vacios");
        exit();
    }
} else {
    header("Location: ../front/dist/paginas/login.html");
    exit();
}
?>