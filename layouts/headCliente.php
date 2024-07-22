<?php
header("Expires: Tue, 01 Jan 2030 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html; charset=UTF-8');
?>
<?php
session_start();
// Verificar si no hay sesión iniciada
if (!isset($_SESSION['idClientes'])) {
    header("Location: login_cliente.php"); // Redirigir a la página de inicio
    exit; // Asegurar que el script se detenga después de la redirección
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Para borrar la cache -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <!-- Meta Description -->
    <meta name="description" content="Corporación V Y S Perú E.I.R.L ofrece los mejores servicios y productos en Perú. Contáctanos para más información.">
    
    <!-- Meta Keywords -->
    <meta name="keywords" content="Corporación V Y S, productos, servicios, consultoría, informática, Perú, contacto, empresa">
    
    <!-- Author -->
    <meta name="author" content="Corporación V Y S Perú E.I.R.L">
    
    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Corporación V Y S Perú E.I.R.L - Tu Mejor Opción en Servicios y Productos">
    <meta property="og:description" content="Corporación V Y S Perú E.I.R.L ofrece los mejores servicios y productos en Perú, como consultores informaticos. Contáctanos para más información.">
    <meta property="og:image" content="https://avsci.org.pe/assets/img/corplogocirculo.png">
    <meta property="og:url" content="https://avsci.org.pe">
    <meta property="og:type" content="website">
    
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Cliente'; ?></title>
    <link rel="icon" href="assets/img/corplogocirculo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <!-- Alerta -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/styleClientes.css">
</head>
