
<?php
require_once("Validator/Validator.php");
class Contrato
{
    public $idContrato;
    public $fechaInicio;
    public $fechaRenovacion;
    public $documento;
    public $idCredenciales;
    public $idAdmin;

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

        if (empty($this->fechaInicio)) {
            $mensajesErrores[] = 'La fecha de inicio es obligatorio';
        } else {
            $this->fechaInicio = $this->test_input($this->fechaInicio);
        }
        //-----------------------------------------------------------------------------

        if (empty($this->fechaRenovacion)) {
            $mensajesErrores[] = 'La fecha de renovación es obligatorio';
        } else {
            $this->fechaRenovacion = $this->test_input($this->fechaRenovacion);
        }
        //-----------------------------------------------------------------------------

        if (empty($this->documento)) {
            $mensajesErrores[] = 'El documento es obligatorio';
        } else {
            $this->documento = $this->test_input($this->documento);
        }
        //-----------------------------------------------------------------------------

        if (empty($this->idCredenciales)) {
            $mensajesErrores[] = 'La fecha de inicio es obligatorio';
        } else {
            $this->idCredenciales = $this->test_input($this->idCredenciales);
        }
        //-----------------------------------------------------------------------------

        if (empty($this->idAdmin)) {
            $mensajesErrores[] = 'La fecha de inicio es obligatorio';
        } else {
            $this->idAdmin = $this->test_input($this->idAdmin);
        }
        
        return $mensajesErrores;
    }
    public function __construct()
    {
    }
}
?>