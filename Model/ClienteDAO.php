<?php
require_once("Connection/conexion.php");
require_once("Model/Cliente.php");
require_once("Model/Credenciales.php");
require_once("Model/Contrato.php");
require_once("Model/Facturas.php");

class ClienteDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_clientes_list()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $clientesArray = array();

            while ($row = $query->fetch()) {
                $cliente = new Cliente();
                $cliente->idClientes = $row["idClientes"];
                $cliente->tipoDocumento = $row["tipoDocumento"];
                $cliente->numDocumento = $row["numDocumento"];
                $cliente->nombre = $row["nombre"];
                $cliente->razonSocial = $row["razonSocial"];
                $cliente->nombreComercial = $row["nombreComercial"];
                $cliente->telefonoContacto = $row["telefonoContacto"];
                $cliente->correoContacto = $row["correoContacto"];
                $cliente->contrasenia = $row["contrasenia"];
                $clientesArray[] = $cliente;
            }
            return $clientesArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*---------------------------------------------------------------------------------*/
    public function insert(Cliente $cliente)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_clientes_insert(?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $cliente->tipoDocumento);
            $query->bindValue(2, $cliente->numDocumento);
            $query->bindValue(3, $cliente->nombre);
            $query->bindValue(4, $cliente->razonSocial);
            $query->bindValue(5, $cliente->nombreComercial);
            $query->bindValue(6, $cliente->telefonoContacto);
            $query->bindValue(7, $cliente->correoContacto);

            $claveEncriptada = md5($cliente->contrasenia);

            $query->bindValue(8, $claveEncriptada);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function edit(Cliente $cliente)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_clientes_edit(?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $cliente->idClientes);
            $query->bindValue(2, $cliente->tipoDocumento);
            $query->bindValue(3, $cliente->numDocumento);
            $query->bindValue(4, $cliente->nombre);
            $query->bindValue(5, $cliente->razonSocial);
            $query->bindValue(6, $cliente->nombreComercial);
            $query->bindValue(7, $cliente->telefonoContacto);
            $query->bindValue(8, $cliente->correoContacto);

            if (!empty($cliente->forPassword)) {
                $claveEncriptada = md5($cliente->contrasenia);
                $query->bindValue(9, $claveEncriptada);
            } else {
                $query->bindValue(9, $cliente->contrasenia); //
            }

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idClientes)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_clientes_delete(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idClientes);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*-------------------------------------------------------------------------------------------------*/

    public function infoClientes($idClientes)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_info_clientes(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idClientes);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $cliente = new Cliente();
            while ($row = $query->fetch()) {
                $cliente->idClientes = $row["idClientes"];
                $cliente->tipoDocumento = $row["tipoDocumento"];
                $cliente->numDocumento = $row["numDocumento"];
                $cliente->nombre = $row["nombre"];
                $cliente->razonSocial = $row["razonSocial"];
                $cliente->nombreComercial = $row["nombreComercial"];
                $cliente->telefonoContacto = $row["telefonoContacto"];
                $cliente->correoContacto = $row["correoContacto"];
            }
            return $cliente;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function infoCredenciales($idClientes)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_info_credenciales(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idClientes);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();

            $credencialesArray = array();
            while ($row = $query->fetch()) {
                $credenciales = new Credenciales();
                $credenciales->idCredenciales = $row["idCredenciales"];
                $credenciales->usuario = $row["usuario"];
                $credenciales->observacion = $row["observacion"];
                $credenciales->idClientes = $row["idClientes"];
                $credenciales->idServicios = $row["idServicios"];
                $credenciales->nombre = $row["nombre"];
                $credenciales->nombreServicios = $row["nombreServicios"];
                $credenciales->linkAcceso = $row["linkAcceso"];
                $credencialesArray[] = $credenciales;
            }
            return $credencialesArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function infoContrato($idClientes)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_info_contrato(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idClientes);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $contratoArray = array();
            while ($row = $query->fetch()) {
                $contrato = new Contrato();
                $contrato->idContrato = $row["idContrato"];
                $contrato->fechaInicio = $row["fechaInicio"];
                $contrato->fechaRenovacion = $row["fechaRenovacion"];
                $contrato->documento = $row["documento"];
                $contrato->idCredenciales = $row["idCredenciales"];
                $contrato->idAdmin = $row["idAdmin"];
                $contrato->idClientes = $row["idClientes"];
                $contrato->idServicios = $row["idServicios"];
                $contrato->nombre = $row["nombre"];
                $contrato->nombreServicios = $row["nombreServicios"];
                $contrato->nombreApellidos = $row["nombreApellidos"];
                $contratoArray[] = $contrato;
            }
            return $contratoArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function infoFacturas($idClientes)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_info_facturas(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idClientes);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $facturasArray = array();
            while ($row = $query->fetch()) {
                $facturas = new Facturas();
                $facturas->idFacturas = $row["idFacturas"];
                $facturas->mes = $row["mes"];
                $facturas->tipoMoneda = $row["tipoMoneda"];
                $facturas->monto = $row["monto"];
                $facturas->fechaEmision = $row["fechaEmision"];
                $facturas->estado = $row["estado"];
                $facturas->documento = $row["documento"];
                $facturas->reportePago = $row["reportePago"];
                $facturas->notificacion = $row["notificacion"];
                $facturas->idClientes = $row["idClientes"];
                $facturas->nombre = $row["nombre"];
                $facturas->nombreServicios = $row["nombreServicios"];
                $facturasArray[] = $facturas;
            }
            return $facturasArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*---------------------------------------------------------------------------------*/
    public function editReportePago(Facturas $facturas)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_facturas_edit_reportePago(?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $facturas->idFacturas);
            $query->bindValue(2, $facturas->reportePago);
            $query->bindValue(3, $facturas->notificacion);

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function login($clienteLogin)
    {

        try {

            $con = Conexion::getconexion();

            $sql = "call sp_clientes_login(?)";
            $query = $con->prepare($sql);
            $query->fetch(PDO::FETCH_ASSOC);

            $query->bindValue(1, $clienteLogin->correoContacto);

            $query->execute();

            if ($row = $query->fetch()) {
                $_SESSION['idClientes'] = $row["idClientes"];
                $_SESSION['numDocumento'] = $row["numDocumento"];
                $_SESSION['razonSocial'] = $row["razonSocial"];
                $_SESSION['nombre'] = $row["nombre"];
                $_SESSION['nombreComercial'] = $row["nombreComercial"];
                $_SESSION['correoContacto'] = $row["correoContacto"];
                $_SESSION['contrasenia'] = $row["contrasenia"];
            } else {
                throw new Exception('E-001'); //usuario no encontrado
            }

            $resp = strcmp(md5($clienteLogin->contrasenia), $_SESSION['contrasenia']) == 0;
            //$resp=password_verify($usuarioLoguin->clave, $_SESSION['clave']);
            $_SESSION['contrasenia'] = "";

            if ($resp) {
                return $resp;
            } else {
                throw new Exception("E-002"); //clave incorrecta             
            }
        } catch (Exception $e) {

            if (str_contains($e->getMessage(), 'E-001')) {
                throw $e;
            } else if (str_contains($e->getMessage(), 'E-002')) {
                throw $e;
            } else {
                //echo $e->getMessage();
                //throw new Exception ('Error crítico: Comunicarse con el administrador del sistema');            
                throw $e;
            }
        }
    }
}
