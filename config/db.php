<?php
// Conexión PDO a MySQL (XAMPP: usuario root sin contraseña, puerto 3306)
$host = '127.0.0.1';
$port = 3306;
$db   = 'proyecto_login';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die('No se pudo conectar a la base de datos. Revisá que MySQL esté iniciado en XAMPP.');
}
