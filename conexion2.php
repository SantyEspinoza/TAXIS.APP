<?php

class Connection {
    private $host = 'localhost';
    private $db = 'taxis_app';
    private $user = 'root';
    private $pass = 'taxis2026';
    private $charset = 'utf8mb4';

    public function getConnection() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        try {
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function store_data($nombre, $email, $ciudad, $origen, $destino, $fecha, $pago, $tipo, $celular) {
        $sql = "INSERT INTO datos (nombre_y_apellidos, direccion_email, ciudad, origen, destino, fecha_hora, metodo_pago, identifiquese, num_celular) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([$nombre, $email, $ciudad, $origen, $destino, $fecha, $pago, $tipo, $celular]);
    }
}
