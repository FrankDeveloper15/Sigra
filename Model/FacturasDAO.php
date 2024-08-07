<?php
require_once("Connection/conexion.php");
require_once("Model/Facturas.php");
require_once("Model/Credenciales.php");

class FacturasDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_facturas_list()";
            $query = $con->prepare($sql);
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
                $facturas->fechaVencimiento = $row["fechaVencimiento"];
                $facturas->estado = $row["estado"];
                $facturas->documento = $row["documento"];
                $facturas->ordenPago = $row["ordenPago"];
                $facturas->reportePago = $row["reportePago"];
                $facturas->notificacion = $row["notificacion"];
                $facturas->idCredenciales = $row["idCredenciales"];
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
    public function insert(Facturas $facturas)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_facturas_insert(?,?,?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $facturas->mes);
            $query->bindValue(2, $facturas->tipoMoneda);
            $query->bindValue(3, $facturas->monto);
            $query->bindValue(4, $facturas->fechaEmision);
            $query->bindValue(5, $facturas->fechaVencimiento);
            $query->bindValue(6, $facturas->estado);
            $query->bindValue(7, $facturas->documento);
            $query->bindValue(8, $facturas->ordenPago);
            $query->bindValue(9, $facturas->reportePago);
            $query->bindValue(10, $facturas->notificacion);
            $query->bindValue(11, $facturas->idCredenciales);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function edit(Facturas $facturas)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_facturas_edit(?,?,?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $facturas->idFacturas);
            $query->bindValue(2, $facturas->mes);
            $query->bindValue(3, $facturas->tipoMoneda);
            $query->bindValue(4, $facturas->monto);
            $query->bindValue(5, $facturas->fechaEmision);
            $query->bindValue(6, $facturas->fechaVencimiento);
            $query->bindValue(7, $facturas->estado);
            $query->bindValue(8, $facturas->documento);
            $query->bindValue(9, $facturas->ordenPago);
            $query->bindValue(10, $facturas->reportePago);
            $query->bindValue(11, $facturas->idCredenciales);

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idFacturas)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_facturas_delete(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idFacturas);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /* ================================================================ */
    public function searchClientesFac()
    {
        try {
            $con = Conexion::getConexion();

            $sql = "CALL sp_search_clientes_fac()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $searchClientesFac = array();

            while ($row = $query->fetch()) {
                $credenciales = new Credenciales();
                $credenciales->idCredenciales = $row["idCredenciales"];
                $credenciales->nombre = $row["nombre"];
                $credenciales->nombreServicios = $row["nombreServicios"];
                $searchClientesFac[] = $credenciales;
            }
            return $searchClientesFac;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
