<?php
    
/*B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.*/


include 'Pizza.php';
include 'archivosJson.php';
if (isset($_GET['sabor']) && isset($_GET['precio']) && isset($_GET['tipo']) && isset($_GET['cantidad'])) {
    $sabor = $_GET['sabor'];
    $precio = $_GET['precio'];
    $tipo = $_GET['tipo'];
    $cantidad = $_GET['cantidad'];

    if (Pizza::ValidarPizzaCorrecta($sabor, $precio, $tipo, $cantidad)) {
        $pizza = new Pizza($sabor, $precio, $tipo, $cantidad);


        if (Pizza::ValidarSiPizzaYaExiste($pizza, ArchivosJson::LeerListaPizzas())!=null) {

            if(Pizza::AgregarStockDePizza($pizza)){
                echo "Actualizado";
            }else{
               echo "error en actualizar stock";
            }
    
        } else if (Pizza::AltaDePizzaJson($pizza)) {
            echo "Guardado";
        }
        

    } else {
        echo "Error - Datos de la pizza incorrectos. Reintente";
    }
} else {
    echo "Error - Datos ingresados incorrectos/incompletos. Reintente";
}

?>