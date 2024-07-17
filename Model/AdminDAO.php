<?php
require_once("Connection/conexion.php");
require_once("Model/Admin.php");

class AdminDAO
{
    //--------------------------------------------------------------------------------------

    public function list()
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_admin_list()";
            $query = $con->prepare($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $adminArray = array();

            while ($row = $query->fetch()) {
                $admin = new Admin();
                $admin->idAdmin = $row["idAdmin"];
                $admin->tipoDocumento = $row["tipoDocumento"];
                $admin->numDocumento = $row["numDocumento"];
                $admin->telefonoContacto = $row["telefonoContacto"];
                $admin->nombreApellidos = $row["nombreApellidos"];
                $admin->correoContacto = $row["correoContacto"];
                $admin->contrasenia = $row["contrasenia"];
                $adminArray[] = $admin;
            }
            return $adminArray;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /*---------------------------------------------------------------------------------*/
    public function insert(Admin $admin)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_admin_insert(?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $admin->tipoDocumento);
            $query->bindValue(2, $admin->numDocumento);
            $query->bindValue(3, $admin->telefonoContacto);
            $query->bindValue(4, $admin->nombreApellidos);
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
    public function edit(Admin $admin)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_admin_edit(?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $admin->idAdmin);
            $query->bindValue(2, $admin->tipoDocumento);
            $query->bindValue(3, $admin->numDocumento);
            $query->bindValue(4, $admin->telefonoContacto);
            $query->bindValue(5, $admin->nombreApellidos);
            $query->bindValue(6, $admin->correoContacto);

            if (!empty($admin->forPassword)) {
                $claveEncriptada = md5($admin->contrasenia);
                $query->bindValue(7, $claveEncriptada);
            } else {
                $query->bindValue(7, $admin->contrasenia); //
            }

            $query->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /*------------------------------------------------------------------*/

    public function delete($idAdmin)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_admin_delete(?)";
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
                $_SESSION['msj'] = "Ingreso correctamente la sesión";
                $_SESSION['icon'] = "success";
                return $resp;
            } else {
                $_SESSION['msj'] = "Clave incorrecta";
                $_SESSION['icon'] = "error";
                throw new Exception("E-002"); //clave incorrecta             
            }
        } catch (Exception $e) {

            if (str_contains($e->getMessage(), 'E-001')) {
                $_SESSION['msj'] = "No se pudo encontrar al Administrador";
                $_SESSION['icon'] = "error";
                throw $e;
            } else if (str_contains($e->getMessage(), 'E-002')) {
                $_SESSION['msj'] = "Clave incorrecta";
                $_SESSION['icon'] = "error";
                throw $e;
            } else {
                $_SESSION['msj'] = "Comunicarse con el administrador del sistema";
                $_SESSION['icon'] = "error";
                throw $e;
            }
        }
    }
}
