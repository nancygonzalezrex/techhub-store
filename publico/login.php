<?php
session_start();
require_once __DIR__ . "/../app/modelos/Usuario.php";

$mensaje = "";

if ($_POST) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $mensaje = "Debes ingresar correo y contraseña.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no tiene un formato válido.";
    } else {

        $usuarioModelo = new Usuario();
        $usuario = $usuarioModelo->login($email, $password);

        if ($usuario) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'email' => $usuario['email'],
                'rol' => $usuario['rol']
            ];

            header("Location: index.php");
            exit;

        } else {
            $mensaje = "Correo o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - TechHub Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/techhub_store/publico/css/estilos.css">
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <div class="card shadow-sm border-0 p-4">
                <h1 class="text-center mb-4">Iniciar sesión</h1>

                <?php if ($mensaje != "") { ?>
                    <div class="alert alert-danger">
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>

                <form method="POST">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control mb-3" 
                        placeholder="Correo" 
                        required
                    >

                    <input 
                        type="password" 
                        name="password" 
                        class="form-control mb-3" 
                        placeholder="Contraseña" 
                        required
                    >

                    <button class="btn btn-primary w-100 mb-2">
                        Ingresar
                    </button>

                    <a href="registro.php" class="btn btn-link w-100">
                        Crear cuenta
                    </a>

                    <a href="index.php" class="btn btn-secondary w-100">
                        Volver al catálogo
                    </a>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>