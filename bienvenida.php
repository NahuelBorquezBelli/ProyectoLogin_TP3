<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: index.php');
    exit;
}
$nombre = htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bienvenido | Proyecto Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="card center">
    <div class="logo">●</div>
    <h1>¡Hola, <?= $nombre ?>!</h1>
    <p class="sub">Iniciaste sesión correctamente. Bienvenido al sistema.</p>
    <a href="logout.php" class="btn link">Cerrar sesión</a>
  </main>
</body>
</html>
