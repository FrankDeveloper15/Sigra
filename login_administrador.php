<?php
require 'Model/AdminDAO.php';
require 'AdminLoguin.php';
session_start();

$adminLoguin = new AdminLoguin();
$datosProcesados = false;
$inicioSesionError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $adminLoguin->correoContacto = $_POST["correoContacto"];
    $adminLoguin->contrasenia = $_POST["contrasenia"];

    $mensajesErrores = $adminLoguin->validarCampos();

    if (count($mensajesErrores) > 0) {
        $datosProcesados = false;
    } else {

        try {

            $adminDAO = new AdminDAO();
            $resp = $adminDAO->login($adminLoguin);

            $datosProcesados = true;

            $recordarme = $_POST["chkRecordarme"];
            if ($recordarme) {
                setcookie("admin", $nombreApellidos, time() + (60 * 60));
            }
        } catch (Exception $e) {

            $datosProcesados = false;

            if (str_contains($e->getMessage(), 'E-001')) {
                $mensajesErrores[] = "Administrador no encontrado";
                //  $inicioSesionError="Usuario no encontrado"
            } else if (str_contains($e->getMessage(), 'E-002')) {
                $mensajesErrores[] = "Clave incorrecta";
                // $inicioSesionError="Clave incorrecta"   
            } else {
                $mensajesErrores[] = $e->getMessage();
                //$inicioSesionError= $e->getMessage();       
            }
        }
    }
}

?>
<?php
require 'layouts/head.php';
?>

<body>
    <?php
    require 'layouts/headerLogin.php';
    ?>
    <?php
    if (!$datosProcesados) {
    ?>
        <div id="mensajeMovil">
            <img src="assets/img/administrador.svg" alt="Imagen para dispositivos móviles">
            <p>LO SENTIMOS, ESTA PÁGINA WEB NO ESTÁ DISPONIBLE EN UNA EXPERIENCIA MÓVIL.</p>
            <br>
            <p>RECUERDE INICIAR SESIÓN EN SU ORDENADOR PARA GARANTIZAR MAYOR PRODUCTIVIDAD EN SUS LABORES</p>
            <a href="index.php"><button id="irAlInicio">Ir al Inicio</button></a>
        </div>

        <div class="container-fluid d-flex justify-content-center align-items-center container-administrador">
            <div class="col-12 col-md-6 m-4 p-4 text-center" style="background-color: #eee7ff; max-width: 550px; box-shadow: 0 8px 8px rgba(0, 0, 0, 0.8); border-radius: 8px;">
                <div class="mb-4" style="color: #7c19ed;">
                    <h2>INICIAR SESIÓN ADMINISTRADOR</h2>
                </div>
                <?php if (isset($mensajesErrores)) : ?>
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
                                <input type="text" class="form-control" id="email" name="correoContacto">
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
                                <input type="checkbox" class="form-check-input" id="chkRecordarme" name="chkRecordarme" <?php if (isset($_COOKIE["correoContacto"])) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="chkRecordarme" style="color: #000;">Recordarme</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-50 btn-login" name="login">INGRESAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mb-3">
                    <p class="link-acceso"><a href="#">He olvidado mi correo/contraseña</a></p>
                </div>
                <div class="admin-login">
                    <p><a href="login_cliente.php">Accede como CLIENTE</a></p>
                </div>
            </div>
        </div>
    <?php
    } else {
        header("Location: menuAdministrador.php");
    }
    ?>
    <?php
    require 'layouts/footer.php';
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