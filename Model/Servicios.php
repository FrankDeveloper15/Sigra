<?php
require_once("Validator/Validator.php");

class Servicios
{
    public $idServicios;
    public $nombreServicios;
    public $correoProveedor;
    public $linkAcceso;

    // Constructor vacío
    public function __construct()
    {
    }

    // Método para limpiar y validar datos de entrada
    public function test_input($data)
    {
        $data = trim($data);        // Elimina espacios en blanco al inicio y final
        $data = stripslashes($data);   // Elimina barras invertidas (\)
        $data = htmlspecialchars($data);   // Convierte caracteres especiales en entidades HTML
        return $data;
    }

    // Método para validar los datos de los servicios
    public function validarServicios()
    {
        $mensajesErrores = array();

        // Validación del nombre de servicios
        if (empty($this->nombreServicios)) {
            $mensajesErrores[] = "El nombre de servicios no puede estar vacío.";
        } else {
            if (strlen($this->nombreServicios) > 50) {
                $mensajesErrores[] = "Nombre de servicios no puede exceder 50 caracteres.";
            }
            $this->nombreServicios = $this->test_input($this->nombreServicios);
        }

        // Validación del correo del proveedor
        if (!empty($this->correoProveedor)) {
            $this->correoProveedor = $this->test_input($this->correoProveedor);
            if (!Validator::isEmail($this->correoProveedor)) {
                $mensajesErrores[] = "El correo del proveedor tiene formato incorrecto.";
            }
        } else {
            $mensajesErrores[] = "El correo no puede estar vacío.";
        }

        // Validación del link de acceso
        if (empty($this->linkAcceso)) {
            $mensajesErrores[] = "El link de acceso no puede estar vacío.";
        } else {
            if (strlen($this->linkAcceso) > 255) {
                $mensajesErrores[] = "El link de acceso no debe exceder los 255 caracteres.";
            }
            $this->linkAcceso = $this->test_input($this->linkAcceso);
        }

        return $mensajesErrores;
    }
}
