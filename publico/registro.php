<?php
session_start();
require_once __DIR__ . "/../app/modelos/Usuario.php";

$mensaje = "";

if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($nombre) || empty($email) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no tiene un formato válido.";
    } elseif (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $usuario = new Usuario();

        if ($usuario->registrar($nombre, $email, $password)) {
            $mensaje = "Usuario registrado correctamente.";
        } else {
            $mensaje = "Error al registrar. Puede que el correo ya exista.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Registro de usuario</h1>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-info"><?php echo $mensaje; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre" required>

        <input type="email" name="email" class="form-control mb-3" placeholder="Correo" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>

        <button class="btn btn-primary">Registrarse</button>
        <a href="login.php" class="btn btn-link">Ya tengo cuenta</a>
    </form>
</div>

</body>
</html>