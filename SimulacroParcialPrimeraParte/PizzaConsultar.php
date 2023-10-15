<?php

/*Julieta Laplace
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/


include 'Pizza.php';
include 'archivosJson.php';

if (isset($_POST['sabor']) && isset($_POST['tipo']) && (!empty($_POST['sabor']) && !empty($_POST['tipo']))) {

    $tipo = Herramientas::convertirAMinusculas($_POST['tipo']);
    $sabor = Herramientas::convertirAMinusculas($_POST['sabor']);
    
    if(Pizza::ValidarSiPizzaYaExiste($tipo, $sabor)){
        echo "Si Hay";
    }else{

        $retorno = Pizza::VerificarExistenciaTipoOSabor($tipo, $sabor);

        switch($retorno){
            case -1:
                echo "No hay";
                break;
            case 1:
                echo "No hay tipo";
                break;
            case 2:
                echo "No hay sabor";
            break;
            default:
            echo "entre al default";
            break;
            
        }
    }
    


} else {
    echo "Error - Datos ingresados incorrectos/incompletos. Reintente";
}
?>