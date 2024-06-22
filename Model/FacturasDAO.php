<?php
    require_once("Connection/conexion.php");
    require_once("Model/Cliente.php");

class ClienteDAO
{
    /*---------------------------------------------------------------------------------*/
    public function insertar(Cliente $cliente)
    {
        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_personal_insertar2(?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);

            $query->bindValue(1, $cliente->tipoDocumento);

            if (empty($cliente->numDocumento)) {
                $query->bindValue(2, 'NULL', PDO::PARAM_NULL);
            } else {
                $query->bindValue(2, $cliente->numDocumento);
            }

            $query->bindValue(3, $cliente->razonSocial);
            $query->bindValue(4, $cliente->nombreComercial);
            $query->bindValue(5, $cliente->telefonoContacto);
            $query->bindValue(6, $cliente->correoContacto);


            $claveEncriptada = md5($cliente->contrasenia);

            $query->bindValue(9, $claveEncriptada);

            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    /*---------------------------------------------------------------------------------*/
    public function actualizar(Cliente $cliente)
    {

        try {
            $con = Conexion::getConexion();
            $sql = "CALL sp_personal_actualizar2(?,?,?,?,?,?,?,?,?,?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $cliente->idClientes);
            $query->bindValue(2, $cliente->tipoDocumento);
            $query->bindValue(3, $cliente->numDocumento);
            $query->bindValue(4, $cliente->razonSocial);
            $query->bindValue(5, $cliente->nombreComercial);
            $query->bindValue(6, $cliente->telefonoContacto);
            $query->bindValue(7, $cliente->correoContacto);
            $query->bindValue(12, $cliente->contrasenia);
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
            $clientes = array();

            while ($row = $query->fetch()) {
                $cliente = new Cliente();
                $cliente->idClientes = $row["idCliente"];
                $cliente->tipoDocumento = $row["tipoDocumento"];
                $cliente->numDocumento = $row["numDocumento"];
                $cliente->razonSocial = $row["razonSocial"];
                $cliente->nombreComercial = $row["nombreComercial"];
                $cliente->telefonoContacto = $row["telefonoContacto"];
                $cliente->correoContacto = $row["correoContacto"];
                $cliente->contrasenia = $row["contrasenia"];
                $clientes[] = $cliente;
            }
            return $clientes;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    //--------------------------------------------------------------------------------------

    public function eliminar($idCliente)
    {

        try {
            $con = Conexion::getconexion();

            $sql = "CALL sp_personal_eliminar(?)";
            $query = $con->prepare($sql);
            $query->bindValue(1, $idCliente);
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
