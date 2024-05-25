<?php
require 'db.php'; // Incluye el archivo de configuración de la base de datos

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    // Prepara una declaración SQL para insertar un nuevo contacto en la base de datos
    $stmt = $pdo->prepare('INSERT INTO contactos (nombre, direccion, email) VALUES (?, ?, ?)');
    $stmt->execute([$nombre, $direccion, $email]);

    // Redirige al usuario de vuelta a la página principal después de agregar el contacto
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Agregar Contacto</h1>
    <!-- Formulario para agregar un nuevo contacto -->
    <form method="post">
        <label>Nombre: <input type="text" name="nombre" required></label><br>
        <label>Dirección: <input type="text" name="direccion" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit" class="btn">Agregar</button>
    </form>
    <!-- Enlace para regresar a la página principal -->
    <a href="index.php" class="btn">Regresar</a>
</body>
</html>
