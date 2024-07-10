<?php
require 'Model/ClienteDAO.php';
require 'clienteLoguin.php';
session_start();

$clienteLoguin = new ClienteLoguin();
$datosProcesados = false;
$inicioSesionError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteLoguin->correoContacto = $_POST["correoContactoCliente"];
    $clienteLoguin->contrasenia = $_POST["contrasenia"];

    $mensajesErrores = $clienteLoguin->validarCampos();

    if (count($mensajesErrores) > 0) {
        $_SESSION['mensajesErrores'] = $mensajesErrores;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        try {
            $clienteDAO = new ClienteDAO();
            $resp = $clienteDAO->login($clienteLoguin);
            $datosProcesados = true;

            $recordarme = isset($_POST["chkRecordarme"]) ? $_POST["chkRecordarme"] : false;
            if ($recordarme) {
                setcookie("correoContactoCliente", $clienteLoguin->correoContacto, time() + (60 * 60 * 24 * 30)); // 30 días
            } else {
                setcookie("correoContactoCliente", "", time() - 3600); // Eliminar cookie
            }

            header('Location: menuCliente.php');
            exit();
        } catch (Exception $e) {
            $mensajesErrores = [];
            if (str_contains($e->getMessage(), 'E-001')) {
                $mensajesErrores[] = "Cliente no encontrado";
            } else if (str_contains($e->getMessage(), 'E-002')) {
                $mensajesErrores[] = "Clave incorrecta";
            } else {
                $mensajesErrores[] = $e->getMessage();
            }
            $_SESSION['mensajesErrores'] = $mensajesErrores;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

$mensajesErrores = isset($_SESSION['mensajesErrores']) ? $_SESSION['mensajesErrores'] : [];
unset($_SESSION['mensajesErrores']);
?>
<?php
require_once("layouts/head.php");
?>

<body>
    <?php
    require 'layouts/headerLogin.php';
    ?>
    <?php
    if (!$datosProcesados) {
    ?>
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6 m-4 p-4 text-center" style="background-color: #eee7ff; max-width: 550px; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.8); border-radius: 8px;">
                <div class="mb-4" style="color: #7c19ed;">
                    <h2>INICIAR SESIÓN CLIENTE</h2>
                </div>
                <?php if (!empty($mensajesErrores)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach ($mensajesErrores as $mensajeError) { ?>
                            <strong><?php echo $mensajeError; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?php }; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-12 form-group mb-4">
                                <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
                                <input type="text" class="form-control" id="email" name="correoContactoCliente" value="<?php echo isset($_COOKIE["correoContactoCliente"]) ? $_COOKIE["correoContactoCliente"] : ''; ?>">
                            </div>
                            <div class="col-lg-8 col-md-12 form-group mb-4">
                                <label for="password" class="form-label">CONTRASEÑA</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="contrasenia">
                                    <button class="input-group-text" type="button" id="togglePasswordVisibility" style="width: 50px;">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" id="chkRecordarme" name="chkRecordarme" <?php if (isset($_COOKIE["correoContactoCliente"])) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="chkRecordarme" style="color: #000;">Recordarme</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-50 btn-login" name="login">INGRESAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="admin-login">
                    <p><a href="login_administrador.php">Accede como ADMINISTRADOR</a></p>
                </div>
            </div>
        </div>
    <?php
    } else {
        header("Location: menuCliente.php");
    }
    ?>
    <?php
    require_once("layouts/footer.php");
    ?>
    <script>
        /* Visibilidada de contraseña */
        document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
    <?php require_once("layouts/script.php"); ?>
</body>

</html>