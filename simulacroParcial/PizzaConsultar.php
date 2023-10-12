<?php

/*(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/


include 'Pizza.php';
include 'archivosJson.php';

if (isset($_POST['sabor']) && isset($_POST['tipo'])) {
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];

    $pizza = new Pizza($sabor, null, $tipo, null);
    $pizzasEnJson = ArchivosJson::LeerListaPizzas();
    
    if (Pizza::ValidarSiPizzaYaExiste($pizza, $pizzasEnJson)!= null) {
        echo "Si Hay";

    } else {
        echo "No hay";
    }
} else {
    echo "Error - Datos ingresados incorrectos/incompletos. Reintente";
}
?>