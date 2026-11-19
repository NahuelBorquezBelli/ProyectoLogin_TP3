<?php
session_start();
require __DIR__ . '/config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirmar'] ?? '';

    if ($nombre === '' || $apellido === '' || $correo === '' || $password === '' || $confirm === '') {
        $error = 'Completá todos los campos.';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'El correo no es válido.';
    } elseif (strlen($password) < 8) {
        $error = 'La contraseña debe tener al menos 8 caracteres.';
    } elseif ($password !== $confirm) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        $stmt = $pdo->prepare('SELECT 1 FROM usuarios WHERE correo = ?');
        $stmt->execute([$correo]);
        if ($stmt->fetch()) {
            $error = 'Ese correo ya está registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO usuarios (nombre, apellido, correo, password_hash) VALUES (?, ?, ?, ?)');
            $ins->execute([$nombre, $apellido, $correo, $hash]);
            header('Location: index.php?registro=ok');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear cuenta | Proyecto Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="card">
    <div class="logo">●</div>
    <h1>Crear cuenta</h1>
    <p class="sub">Completá tus datos para registrarte</p>

    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <form id="formRegistro" method="post" novalidate>
      <div class="row">
        <div>
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
          <small class="msg"></small>
        </div>
        <div>
          <label for="apellido">Apellido</label>
          <input type="text" id="apellido" name="apellido" required value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>">
          <small class="msg"></small>
        </div>
      </div>

      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
      <small class="msg"></small>

      <label for="password">Contraseña</label>
      <div class="pw">
        <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
        <button type="button" class="toggle" data-target="password">Ver</button>
      </div>
      <small class="msg"></small>

      <label for="confirmar">Confirmar contraseña</label>
      <div class="pw">
        <input type="password" id="confirmar" name="confirmar" required>
        <button type="button" class="toggle" data-target="confirmar">Ver</button>
      </div>
      <small class="msg"></small>

      <button type="submit" class="btn">Crear cuenta</button>
    </form>

    <p class="foot">¿Ya tenés cuenta? <a href="index.php">Volver al login</a></p>
  </main>
  <script src="assets/js/validacion.js"></script>
</body>
</html>
