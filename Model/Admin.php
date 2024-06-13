
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
        if (!empty($this->numDocumento)) {
            $this->numDocumento = $this->test_input($this->numDocumento);
            if (!Validator::isDNI($this->numDocumento)) {
                $mensajesErrores[] = "El campo DNI tiene un formato erroneo";
            }
        } else {
            $mensajesErrores[] = "El  DNI no puede estar vacio";
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
            if (strlen($this->nombreApellidos) > 20) {
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
            $mensajesErrores[] = 'La contraseña es obligatorio';
        } else {
            $this->contrasenia = $this->test_input($this->contrasenia);
        }


        return $mensajesErrores;
    }
    public function __construct()
    {
    }
}
?>