
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
    public $forFile;

    public $nombreApellidos;
    public $idClientes;
    public $nombre;
    public $idServicios;
    public $nombreServicios;

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validarContrato()
    {
        $mensajesErrores = array();

        // Validar fechaInicio
        if (empty($this->fechaInicio)) {
            $mensajesErrores[] = 'La fecha de inicio es obligatoria';
        } else {
            $this->fechaInicio = $this->test_input($this->fechaInicio);
            if (!$this->validarFecha($this->fechaInicio)) {
                $mensajesErrores[] = 'La fecha de inicio no es válida';
            }
        }

        // Validar fechaRenovacion
        if (empty($this->fechaRenovacion)) {
            $mensajesErrores[] = 'La fecha de renovación es obligatoria';
        } else {
            $this->fechaRenovacion = $this->test_input($this->fechaRenovacion);
            if (!$this->validarFecha($this->fechaRenovacion)) {
                $mensajesErrores[] = 'La fecha de renovación no es válida';
            }
        }

        // Validar documento
        if (empty($this->documento)) {
            $mensajesErrores[] = 'El documento es obligatorio';
        } else {
            $this->documento = $this->test_input($this->documento);
        }

        // Validar idCredenciales
        if (empty($this->idCredenciales)) {
            $mensajesErrores[] = 'Las credenciales son obligatorias';
        } else {
            $this->idCredenciales = $this->test_input($this->idCredenciales);
        }

        // Validar idAdmin
        if (empty($this->idAdmin)) {
            $mensajesErrores[] = 'El administrador es obligatorio';
        } else {
            $this->idAdmin = $this->test_input($this->idAdmin);
        }

        return $mensajesErrores;
    }

    public function validarFecha($fecha)
    {
        $d = DateTime::createFromFormat('Y-m-d', $fecha);
        return $d && $d->format('Y-m-d') === $fecha;
    }

    public function __construct()
    {
    }
}
?>