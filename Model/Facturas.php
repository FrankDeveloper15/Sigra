
<?php
require_once("Validator/Validator.php");
class Facturas
{
    public $idFacturas;
    public $mes;
    public $tipoMoneda;
    public $monto;
    public $fechaEmision;
    public $fechaVencimiento;
    public $estado;
    public $documento;
    public $idClientes;

    public $nombre;
    public $nombreServicios;
    public $forFile;

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validarFacturas()
    {
        $mensajesErrores = array();
        
        //-----------------------------------------------------------------------------

        if (empty($this->mes)) {
            $mensajesErrores[] = "El mes no puede estar vacio.";
        } else {
            if (strlen($this->mes) > 30) {
                $mensajesErrores[] = "Mes no puede exceder de 30 caracteres";
            }
            $this->mes = $this->test_input($this->mes);
        }
        //-----------------------------------------------------------------------------

        if (empty($this->tipoMoneda)) {
            $mensajesErrores[] = "El tipo de moneda no puede estar vacio";
        } else {
            if (strlen($this->tipoMoneda) > 10) {
                $mensajesErrores[] = "El tipo de moneda no tiene que exceder de 255 carácteres.";
            }
            $this->tipoMoneda = $this->test_input($this->tipoMoneda);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->monto)) {
            $mensajesErrores[] = "El monto no puede estar vacio";
        } else {
            if (strlen($this->monto) > 5) {
                $mensajesErrores[] = "El monto no tiene que exceder de 5 carácteres.";
            }
            $this->monto = $this->test_input($this->monto);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->fechaEmision)) {
            $mensajesErrores[] = 'La fecha de emisión es obligatorio';
        } else {
            $this->fechaEmision = $this->test_input($this->fechaEmision);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->fechaVencimiento)) {
            $mensajesErrores[] = 'La fecha de vencimiento es obligatorio';
        } else {
            $this->fechaVencimiento = $this->test_input($this->fechaVencimiento);
        }

        //-----------------------------------------------------------------------------

        if (empty($this->estado)) {
            $mensajesErrores[] = "El estado no puede estar vacio";
        } else {
            if (strlen($this->monto) > 15) {
                $mensajesErrores[] = "El estado no tiene que exceder de 15 carácteres.";
            }
            $this->estado = $this->test_input($this->estado);
        }

        //-----------------------------------------------------------------------------

        $this->documento = $this->test_input($this->documento);

        //-----------------------------------------------------------------------------

        if (empty($this->idClientes)) {
            $mensajesErrores[] = 'El id clientes es obligatorio';
        } else {
            $this->idClientes = $this->test_input($this->idClientes);
        }

        return $mensajesErrores;
    }
    public function __construct()
    {
    }
}
?>