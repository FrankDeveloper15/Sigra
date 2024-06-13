<?php
require_once("Validator/Validator.php");

class ClienteLoguin
{
    public $correoContacto;
    public $contrasenia;

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    public function validarCampos()
    {

        $mensajesErrores = array();

        return $mensajesErrores;
    }

    public function __construct()
    {
    }
}
