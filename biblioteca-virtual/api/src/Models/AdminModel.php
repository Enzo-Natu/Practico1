<?php
require_once __DIR__ . '/../../config/database.php';
class AdminModel {
    private $conn;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function obtenerEstadisticas() {
        $stmtUsuarios = $this->conn->query("SELECT COUNT(*) AS total FROM usuarios");
        $totalUsuarios = $stmtUsuarios->fetch()['total'] ?? 0;

        $stmtArticulos = $this->conn->query("SELECT COUNT(*) AS total FROM articulos");
        $totalArticulos = $stmtArticulos->fetch()['total'] ?? 0;

        return [
            'usuarios' => $totalUsuarios,
            'articulos' => $totalArticulos
        ];
    }
}
?>