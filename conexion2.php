<?php

class Connection {
private $host;
private $db;
private $user;
private $pass;
private $charset = 'utf8mb4';

public function __construct() {
    $this->host = getenv('DB_HOST') ?: 'localhost';
    $this->db   = getenv('DB_NAME') ?: 'taxis_app';
    $this->user = getenv('DB_USER');
    $this->pass = getenv('DB_PASS');
}
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
