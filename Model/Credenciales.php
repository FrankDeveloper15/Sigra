
<?php
require_once("Validator/Validator.php");
class Credenciales
{
    public $idCredenciales;
    public $usuario;
    public $contrasenia;
    public $observacion;
    public $idClientes;
    public $idServicios;

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validarCliente()
    {
        $mensajesErrores = array();
        
        //-----------------------------------------------------------------------------

        if (empty($this->usuario)) {
            $mensajesErrores[] = "El usuario no puede estar vacio.";
        } else {
            if (strlen($this->usuario) > 30) {
                $mensajesErrores[] = "Usuario no puedene excender 30 caracteres";
            }
            $this->usuario = $this->test_input($this->usuario);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->contrasenia)) {
            $mensajesErrores[] = 'La contraseña es obligatorio';
        } else {
            $this->contrasenia = $this->test_input($this->contrasenia);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->observacion)) {
            $mensajesErrores[] = "La observación no puede estar vacio";
        } else {
            if (strlen($this->observacion) > 50) {
                $mensajesErrores[] = "La observación no debe exceder de 50 carácteres.";
            }
            $this->observacion = $this->test_input($this->observacion);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->idClientes)) {
            $mensajesErrores[] = 'El id clientes es obligatorio';
        } else {
            $this->idClientes = $this->test_input($this->idClientes);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->idServicios)) {
            $mensajesErrores[] = 'El id servicios es obligatorio';
        } else {
            $this->idServicios = $this->test_input($this->idServicios);
        }

        return $mensajesErrores;
    }
    public function __construct()
    {
    }
}
?>