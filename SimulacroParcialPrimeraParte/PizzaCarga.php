<?php
    
/*B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.*/


include 'Pizza.php';
include 'archivosJson.php';

if ((isset($_GET['sabor']) && isset($_GET['precio']) && isset($_GET['tipo']) && isset($_GET['cantidad']) && (!empty($_GET['sabor'])) && !empty($_GET['precio']) && !empty($_GET['tipo']) && !empty($_GET['cantidad']))) {
    
    $sabor = Herramientas::convertirAMinusculas($_GET['sabor']);
    $precio = $_GET['precio'];
    $tipo = Herramientas::convertirAMinusculas($_GET['tipo']);
    $cantidad = $_GET['cantidad'];


    if (Pizza::ValidarPizzaCorrecta($sabor, $precio, $tipo, $cantidad)) {

        if (Pizza::ValidarSiPizzaYaExiste($tipo, $sabor) && Pizza::AgregarStockDePizza($tipo, $sabor, $cantidad, $precio)) {
            echo "Actualizado";
        } else {
            if (Pizza::AltaDePizzaJson($sabor, $precio, $tipo, $cantidad)) {
                echo "Guardado";
            } else {
                echo "Error en guardar o actualizar la pizza.";
            }
        }
        
    } else {
        echo "Error - Datos de la pizza incorrectos. Reintente";
    }
} else {
    echo "Error - Datos ingresados incompletos. Reintente";
}

?>