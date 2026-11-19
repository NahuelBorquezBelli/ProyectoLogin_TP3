<?php
session_start();
require __DIR__ . '/config/db.php';

if (isset($_SESSION['id_usuario'])) {
    header('Location: bienvenida.php');
    exit;
}

$error = '';
$ok = isset($_GET['registro']) && $_GET['registro'] === 'ok';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo   = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($correo === '' || $password === '') {
        $error = 'Completá todos los campos.';
    } else {
        $stmt = $pdo->prepare('SELECT id_usuario, nombre, apellido, password_hash FROM usuarios WHERE correo = ?');
        $stmt->execute([$correo]);
        $u = $stmt->fetch();

        if ($u && password_verify($password, $u['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['id_usuario'] = $u['id_usuario'];
            $_SESSION['nombre']     = $u['nombre'];
            $_SESSION['apellido']   = $u['apellido'];
            header('Location: bienvenida.php');
            exit;
        }
        $error = 'Correo o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión | Proyecto Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="card">
    <div class="logo">●</div>
    <h1>Bienvenido de nuevo</h1>
    <p class="sub">Ingresá con tu cuenta para continuar</p>

    <?php if ($ok): ?><div class="alert success">Cuenta creada con éxito. Ya podés iniciar sesión.</div><?php endif; ?>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <form id="formLogin" method="post" novalidate>
      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required
             value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
      <small class="msg"></small>

      <label for="password">Contraseña</label>
      <div class="pw">
        <input type="password" id="password" name="password" placeholder="••••••••" required>
        <button type="button" class="toggle" data-target="password">Ver</button>
      </div>
      <small class="msg"></small>

      <button type="submit" class="btn">Ingresar</button>
    </form>

    <p class="foot">¿No tenés cuenta? <a href="registro.php">Crear cuenta nueva</a></p>
  </main>
  <script src="assets/js/validacion.js"></script>
</body>
</html>
