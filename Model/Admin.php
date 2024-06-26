
<?php
require_once("Validator/Validator.php");
class Admin
{
    public $idAdmin;
    public $tipoDocumento;
    public $numDocumento;
    public $telefonoContacto;
    public $nombreApellidos;
    public $correoContacto;
    public $contrasenia;
    public $forPassword;

    // Constructor vacío
    public function __construct()
    {
    }

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validarAdmin()
    {
        $mensajesErrores = array();
        //-----------------------------------------------------------------------------
        if (empty($this->tipoDocumento)) {
            $mensajesErrores[] = 'El tipo de documento es obligatorio';
        } else {
            $this->tipoDocumento = $this->test_input($this->tipoDocumento);
        }
        //-----------------------------------------
        if (empty($this->numDocumento)) {
            $mensajesErrores[] = 'El número de documento es obligatorio';
        } else {
            $this->numDocumento = $this->test_input($this->numDocumento);
        }
        //-----------------------------------------------------------------------------
        if (!empty($this->telefonoContacto)) {
            $this->telefonoContacto = $this->test_input($this->telefonoContacto);
            if (!Validator::isCelular($this->telefonoContacto)) {
                $mensajesErrores[] = "Celular con formato erroneo";
            }
        } else {
            $mensajesErrores[] = "El celular no puede estar vacio";
        }
        //-----------------------------------------------------------------------------

        if (empty($this->nombreApellidos)) {
            $mensajesErrores[] = "El nombre y apellidos no puede estar vacio";
        } else {
            if (strlen($this->nombreApellidos) > 60) {
                $mensajesErrores[] = "El nombre y apellidos no tiene que exceder de 255 carácteres.";
            }
            $this->nombreApellidos = $this->test_input($this->nombreApellidos);
        }
        //-----------------------------------------------------------------------------
        if (!empty($this->correoContacto)) {
            $this->correoContacto = $this->test_input($this->correoContacto);
            if (!Validator::isEmail($this->correoContacto)) {
                $mensajesErrores[] = "El correo con formato erroneo";
            }
        } else {
            $mensajesErrores[] = "El correo no puede estar vacio";
        }
        //-----------------------------------------------------------------------------

        if (empty($this->contrasenia)) {
            $mensajesErrores[] = 'La contraseña no puede estar vacia.'.$this->contrasenia;
        } else {
            $this->contrasenia = $this->test_input($this->contrasenia);
        }

        return $mensajesErrores;
    }
}
