<?php

class Herramientas {

    static function parametroTipoPizzaCorrecto($parametro){
        $retorno = false;
        if($parametro != null){
            if ($parametro === "molde" || $parametro ==="piedra") {
                $retorno=true;
            }
        }
        return $retorno;
        
    }
   
    
    static function parametroNumericoValido($parametro, $min, $max) {
        return (is_numeric($parametro) && ($parametro>=$min) && ($parametro<=$max));
    }
    
    static function DatoStringCorrecto($parametro){
        $retorno = false;
        $caracteres = '/^[A-Za-z]+$/';
        $parametro = strtolower($parametro);
        if(is_string($parametro) && strlen($parametro)>3 && preg_match($caracteres, $parametro)){
           $retorno=true;
        }
        return $retorno;
    }

    static function convertirAMinusculas($parametro) {
        return strtolower($parametro);
    }
}

?>