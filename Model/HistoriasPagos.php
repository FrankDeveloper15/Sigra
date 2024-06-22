
<?php
require_once("Validator/Validator.php");
class Cliente
{
    public $idHistoriaPagos;
    public $idFacturas;

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

        if (empty($this->idFacturas)) {
            $mensajesErrores[] = 'El tipo de documento es obligatorio';
        } else {
            $this->idFacturas = $this->test_input($this->idFacturas);
        }

        return $mensajesErrores;
    }
    public function __construct()
    {
    }
}
?>