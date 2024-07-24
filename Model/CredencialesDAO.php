<?php
    require_once("Connection/conexion.php");
    require_once("Model/Credenciales.php");
    require_once("Model/Cliente.php");
    require_once("Model/Servicios.php");

class CredencialesDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_credenciales_list()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $credencialesArray = array();

            while ($row = $query->fetch()) {
                $credenciales = new Credenciales();
                $credenciales->idCredenciales = $row["idCredenciales"];
                $credenciales->usuario = $row["usuario"];
                $credenciales->contrasenia = $row["contrasenia"];
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

    /*---------------------------------------------------------------------------------*/
    public function insert(Credenciales $credenciales)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_credenciales_insert(?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $credenciales->usuario);
            $query->bindValue(2, $credenciales->contrasenia);
            $query->bindValue(3, $credenciales->observacion);
            $query->bindValue(4, $credenciales->idClientes);
            $query->bindValue(5, $credenciales->idServicios);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function edit(Credenciales $credenciales)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_credenciales_edit(?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $credenciales->idCredenciales);
            $query->bindValue(2, $credenciales->usuario);
            $query->bindValue(3, $credenciales->contrasenia);
            $query->bindValue(4, $credenciales->observacion);
            $query->bindValue(5, $credenciales->idClientes);
            $query->bindValue(6, $credenciales->idServicios);          
            
            

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idCredenciales)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_credenciales_delete(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idCredenciales);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /* ================================================================ */
    public function searchClientesCre()
    {
        try {
            $con = Conexion::getConexion();

            $sql = "CALL sp_search_clientes_cre()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $searchClientes = array();

            while($row = $query->fetch()){
                $clientes = new Cliente();
                $clientes->idClientes = $row["idClientes"];
                $clientes->nombre = $row["nombre"];
                $searchClientes[] = $clientes;
            }
            return $searchClientes;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /* ================================================================ */
    public function searchServiciosCre()
    {
        try {
            $con = Conexion::getConexion();

            $sql = "CALL sp_search_servicios_cre()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $searchServicios = array();

            while($row = $query->fetch()){
                $servicios = new Servicios();
                $servicios->idServicios = $row["idServicios"];
                $servicios->nombreServicios = $row["nombreServicios"];
                $searchServicios[] = $servicios;
            }
            return $searchServicios;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
