<?php
class Validator{

//-------------------------------------------------------------
    static function isDNI($cadena){
        //Validamos si es un número y que tenga la longitud que se puso en su creación
        if( (is_numeric($cadena)) && (strlen($cadena)==8)  ){
            return true;
        }else{
            return false;
        }
    }
//-------------------------------------------------------------
static function isCelular($cadena){
    //Validamos si es un número y que tenga la longitud que se puso en su creación
    if( (is_numeric($cadena)) && (strlen($cadena)==9)  ){
        return true;
    }else{
        return false;
    }
}
//-------------------------------------------------------
static function isEmail($cadena){
    if(filter_var($cadena,FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}


//-------------------------------------------------------------
static function isIdApoderado($cadena){
    //Validamos si es un número y que tenga la longitud que se puso en su creación
    if( (is_numeric($cadena))){
        return true;
    }else{
        return false;
    }
}
}

?>