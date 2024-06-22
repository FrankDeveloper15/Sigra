<?php
    require_once("Connection/conexion.php");
    require_once("Model/Servicios.php");

class ServiciosDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_servicios_list()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $serviciosArray = array();

            while ($row = $query->fetch()) {
                $servicios = new Servicios();
                $servicios->idServicios = $row["idServicios"];
                $servicios->nombreServicios = $row["nombreServicios"];
                $servicios->correoProveedor = $row["correoProveedor"];
                $servicios->linkAcceso = $row["linkAcceso"];
                $serviciosArray[] = $servicios;
            }
            return $serviciosArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*---------------------------------------------------------------------------------*/
    public function insert(Servicios $servicios)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_servicios_insert(?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $servicios->nombreServicios);
            $query->bindValue(2, $servicios->correoProveedor);
            $query->bindValue(3, $servicios->linkAcceso);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function edit(Servicios $servicios)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_servicios_edit(?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $servicios->idServicios);
            $query->bindValue(2, $servicios->nombreServicios);
            $query->bindValue(3, $servicios->correoProveedor);
            $query->bindValue(4, $servicios->linkAcceso);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idServicios)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_servicios_delete(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idServicios);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function login($clienteLogin){

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
