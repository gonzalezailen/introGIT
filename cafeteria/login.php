<?php
// Leer el archivo JSON
$json_data = file_get_contents('usuarios.json');
$usuarios = json_decode($json_data, true);

// Obtener los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Buscar usuario
$usuario_encontrado = null;
foreach ($usuarios['usuarios'] as $usuario) {
    if ($usuario['username'] === $username && $usuario['password'] === $password) {
        $usuario_encontrado = $usuario;
        break;
    }
}

// Validar login
if ($usuario_encontrado) {
    // Login exitoso
    session_start();
    $_SESSION['username'] = $usuario_encontrado['username'];
    $_SESSION['rol'] = $usuario_encontrado['rol'];
    header('Location: dashboard.php'); // Redirige a una página principal
} else {
    // Login fallido, redirigir con mensaje de error
    $error_message = urlencode("Usuario o contraseña incorrectos");
    header("Location: login.html?error=$error_message");
    exit();
}
?>
