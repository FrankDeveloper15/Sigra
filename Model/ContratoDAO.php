<?php
require_once("Connection/conexion.php");
require_once("Model/Contrato.php");
require_once("Model/Credenciales.php");
require_once("Model/Admin.php");

class ContratoDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_contrato_list()";
            $query = $con->prepare($sql);
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
                $contrato->idClientes = $row["idServicios"];
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

    /*---------------------------------------------------------------------------------*/
    public function insert(Contrato $contrato)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_contrato_insert(?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $contrato->fechaInicio);
            $query->bindValue(2, $contrato->fechaRenovacion);
            $query->bindValue(3, $contrato->documento);
            $query->bindValue(4, $contrato->idCredenciales);
            $query->bindValue(5, $contrato->idAdmin);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function edit(Contrato $contrato)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_contrato_edit(?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $contrato->idContrato);
            $query->bindValue(2, $contrato->fechaInicio);
            $query->bindValue(3, $contrato->fechaRenovacion);
            $query->bindValue(4, $contrato->documento);
            $query->bindValue(5, $contrato->idCredenciales);
            $query->bindValue(6, $contrato->idAdmin);

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idContrato)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_contrato_delete(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idContrato);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /* ================================================================ */
    public function searchClientesCon()
    {
        try {
            $con = Conexion::getConexion();

            $sql = "CALL sp_search_clientes_con()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $searchClientesCon = array();

            while ($row = $query->fetch()) {
                $credenciales = new Credenciales();
                $credenciales->idCredenciales = $row["idCredenciales"];
                $credenciales->idClientes = $row["idClientes"];
                $credenciales->nombre = $row["nombre"];
                $credenciales->idServicios = $row["idServicios"];
                $credenciales->nombreServicios = $row["nombreServicios"];
                $searchClientesCon[] = $credenciales;
            }
            return $searchClientesCon;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /* ================================================================ */
    public function searchAdmin()
    {
        try {
            $con = Conexion::getConexion();

            $sql = "CALL sp_search_admin_con()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $searchAdmin = array();

            while ($row = $query->fetch()) {
                $admin = new Admin();
                $admin->idAdmin = $row["idAdmin"];
                $admin->nombreApellidos = $row["nombreApellidos"];
                $searchAdmin[] = $admin;
            }
            return $searchAdmin;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
