<?php
require 'db.php'; // Incluye el archivo de configuración de la base de datos

// Obtiene todos los contactos desde la base de datos
$stmt = $pdo->query('SELECT * FROM contactos');
$contacts = $stmt->fetchAll(); 

// Verifica si se ha enviado una solicitud para eliminar un contacto
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare('DELETE FROM contactos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contactos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Contactos</h1>
    <!-- Enlace para agregar un nuevo contacto -->
    <a href="add.php" class="btn">Agregar</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>E-mail</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <!-- Muestra el nombre, dirección y email del contacto -->
                    <td><?= htmlspecialchars($contact['nombre']) ?></td>
                    <td><?= htmlspecialchars($contact['direccion']) ?></td>
                    <td><?= htmlspecialchars($contact['email']) ?></td>
                    <td>
                        <!-- Enlace para editar el contacto -->
                        <a href="edit.php?id=<?= $contact['id'] ?>" class="btn edit">Editar</a>
                        <!-- Formulario para eliminar el contacto -->
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                            <button type="submit" name="delete" class="btn delete">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
