<?php
// Configuración de la base de datos
$host = 'localhost'; 
$db   = 'contactos_db'; 
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4'; 

// DSN (Data Source Name) de conexión a MySQL
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones para la conexión PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Modo de error: Excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Modo de obtención: Arreglo asociativo
    PDO::ATTR_EMULATE_PREPARES   => false, // Desactivar la emulación de preparaciones
];

try {
    // Crear una nueva instancia de PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
