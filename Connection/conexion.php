<?php
class Conexion{
    static public function getConexion(){
        try{
            $dns="mysql:host=localhost;dbname=sigra;port=3306";
            $user="root";
            $password="root";
            $opt=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
            $con=new PDO($dns,$user,$password,$opt);
            return $con;
            
        } catch (PDOException $e) {
           echo "No se puede conectar al servidor MYSQL: ".$e->getMessage(); 
           exit;
        }
    }
}

?>