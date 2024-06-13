<?php
require_once("Connection/conexion.php");
require_once("Model/Admin.php");
require_once("Model/Cliente.php");

class AdminDAO
{
    /*---------------------------------------------------------------------------------*/
    public function registrarCliente(Cliente $cliente)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_registrar_cliente(?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $cliente->tipoDocumento);

            if (empty($cliente->numDocumento)) {
                $query->bindValue(2, 'NULL', PDO::PARAM_NULL);
            } else {
                $query->bindValue(2, $cliente->numDocumento);
            }

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
    public function insertar(Admin $admin)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_personal_insertar2(?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $admin->tipoDocumento);

            if (empty($admin->numDocumento)) {
                $query->bindValue(2, 'NULL', PDO::PARAM_NULL);
            } else {
                $query->bindValue(2, $admin->numDocumento);
            }

            $query->bindValue(3, $admin->nombreApellidos);
            $query->bindValue(4, $admin->telefonoContacto);
            $query->bindValue(5, $admin->correoContacto);

            $claveEncriptada = md5($admin->contrasenia);

            $query->bindValue(6, $claveEncriptada);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function actualizar(Admin $admin)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_personal_actualizar2(?,?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $admin->idAdmin);
            $query->bindValue(2, $admin->tipoDocumento);
            $query->bindValue(3, $admin->numDocumento);
            $query->bindValue(4, $admin->nombreApellidos);
            $query->bindValue(5, $admin->telefonoContacto);
            $query->bindValue(6, $admin->correoContacto);
            $query->bindValue(7, $admin->contrasenia);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function listar()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_personal_listar()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $admins = array();

            while ($row = $query->fetch()) {
                $admin = new Admin();
                $admin->idAdmin = $row["idAdmin"];
                $admin->tipoDocumento = $row["tipoDocumento"];
                $admin->numDocumento = $row["numDocumento"];
                $admin->telefonoContacto = $row["telefonoContacto"];
                $admin->nombreApellidos = $row["nombreApellidos"];
                $admin->correoContacto = $row["correoContacto"];
                $admin->contrasenia = $row["contrasenia"];
                $admins[] = $admin;
            }
            return $admins;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    //--------------------------------------------------------------------------------------

    public function eliminar($idAdmin)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_personal_eliminar(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idAdmin);
            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*-------------------------------------------------------------------------------------------------*/

    public function login($adminLoguin)
    {

        try {

            $con = Conexion::getconexion();

            $sql = "call sp_admin_login(?)";
            $query = $con->prepare($sql);
            $query->fetch(PDO::FETCH_ASSOC);

            $query->bindValue(1, $adminLoguin->correoContacto);

            $query->execute();

            if ($row = $query->fetch()) {
                $_SESSION['idAdmin'] = $row["idAdmin"];
                $_SESSION['numDocumento'] = $row["numDocumento"];
                $_SESSION['telefonoContacto'] = $row["telefonoContacto"];
                $_SESSION['nombreApellidos'] = $row["nombreApellidos"];
                $_SESSION['correoContacto'] = $row["correoContacto"];
                $_SESSION['contrasenia'] = $row["contrasenia"];
            } else {
                throw new Exception('E-001'); //usuario no encontrado
            }

            $resp = strcmp(md5($adminLoguin->contrasenia), $_SESSION['contrasenia']) == 0;
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
