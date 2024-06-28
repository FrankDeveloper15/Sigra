
<?php
require_once("Validator/Validator.php");
class Cliente
{
    public $idClientes;
    public $tipoDocumento;
    public $numDocumento;
    public $nombre;
    public $razonSocial;
    public $nombreComercial;
    public $telefonoContacto;
    public $correoContacto;
    public $contrasenia;
    public $forPassword;

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

        if (empty($this->tipoDocumento)) {
            $mensajesErrores[] = 'El tipo de documento es obligatorio';
        } else {
            $this->tipoDocumento = $this->test_input($this->tipoDocumento);
        }
        //-----------------------------------------
        if (empty($this->numDocumento)) {
            $mensajesErrores[] = 'El número de documento es obligatorio';
        } else if($this->numDocumento === 8 || $this->numDocumento !== 11) {
            $this->numDocumento = $this->test_input($this->numDocumento);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->nombre)) {
            $mensajesErrores[] = "El nombre no puede estar vacio";
        } else {
            if (strlen($this->razonSocial) > 60) {
                $mensajesErrores[] = "El nombre no tiene que exceder de 60 carácteres.";
            }
            $this->nombre = $this->test_input($this->nombre);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->razonSocial)) {
            $mensajesErrores[] = "La razon social no puede estar vacio.";
        } else {
            if (strlen($this->razonSocial) > 50) {
                $mensajesErrores[] = "La razon social no puedene excender 50 caracteres";
            }
            $this->razonSocial = $this->test_input($this->razonSocial);
        }
        

        //-----------------------------------------------------------------------------

        if (empty($this->nombreComercial)) {
            $mensajesErrores[] = "El nombre comercial no puede estar vacio";
        } else {
            if (strlen($this->nombreComercial) > 50) {
                $mensajesErrores[] = "El nombre comercial no tiene que exceder de 50 carácteres.";
            }
            $this->nombreComercial = $this->test_input($this->nombreComercial);
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