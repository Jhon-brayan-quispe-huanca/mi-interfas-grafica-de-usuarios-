<?php
require 'db.php'; // Incluye el archivo de configuración de la base de datos

// Obtiene el ID del contacto a editar desde la URL
$id = $_GET['id'];

// Prepara una declaración SQL para seleccionar el contacto específico por ID
$stmt = $pdo->prepare('SELECT * FROM contactos WHERE id = ?');
$stmt->execute([$id]);
$contact = $stmt->fetch();

// Verifica si la solicitud es de tipo POST (cuando se envía el formulario de edición)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    // Prepara una declaración SQL para actualizar el contacto
    $stmt = $pdo->prepare('UPDATE contactos SET nombre = ?, direccion = ?, email = ? WHERE id = ?');
    $stmt->execute([$nombre, $direccion, $email, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Contacto</h1>
    <!-- Formulario para editar el contacto -->
    <form method="post">
        <label>Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($contact['nombre']) ?>" required></label><br>
        <label>Dirección: <input type="text" name="direccion" value="<?= htmlspecialchars($contact['direccion']) ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required></label><br>
        <button type="submit" class="btn">Actualizar</button>
    </form>
    <!-- Enlace para regresar a la página principal -->
    <a href="index.php" class="btn">Regresar</a>
</body>
</html>

