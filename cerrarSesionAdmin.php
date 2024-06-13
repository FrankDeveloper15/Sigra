<?php
// Inicia la sesión si aún no está iniciada
session_start();

// Destruye todas las variables de sesión
$_SESSION = array();

// Borra la cookie de sesión si se creó
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Finalmente, destruye la sesión
session_destroy();

// Redirigir a la página de inicio después de cerrar sesión
header("Location: login_administrador.php");
exit;
?>
