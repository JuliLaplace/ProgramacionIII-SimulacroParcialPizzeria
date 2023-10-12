<?php

class Herramientas {

    static function parametroCorrecto($parametro){
        $retorno = false;
        if($parametro != null){
        
            $tipo = strtolower($parametro);
            if ($tipo === "molde" || $tipo ==="piedra") {
                $retorno=true;
            }
        }
    
        return $retorno;
        
    }
    
    static function EsNumerico($parametro) {
        return is_numeric($parametro);
    }
    
    static function DatoStringCorrecto($param){
        $retorno = false;
        $caracteres = '/^[A-Za-z]+$/';
        if(is_string($param) && strlen($param)>3 && preg_match($caracteres, $param)){
           $retorno=true;
        }
        return $retorno;
    }
}

?>