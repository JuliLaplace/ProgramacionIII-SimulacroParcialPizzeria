<?php
/*Julieta Laplace
B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.*/

include 'herramientas.php';
class Pizza{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $id;



    public function __construct($sabor, $precio, $tipo, $cantidad) {
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

 

   static function AltaDePizzaJson($sabor, $precio, $tipo, $cantidad) {
        $retorno = false;
        $pizzas = [];
    
        if (file_exists('pizzas.json')) {
            $pizzas = ArchivosJson::LeerListaPizzas();
        }
    
        $idMasAlto = 1; //si el archivo no tiene elementos pizza, el id va a ser 1
    
        if (!empty($pizzas)) {
            foreach ($pizzas as $pizza) {
                if ($pizza['id'] >= $idMasAlto) {
                    $idMasAlto = $pizza['id'] + 1; //agrego uno mas al ultimo id en mi archivo
                }
            }
        }
    
        $nuevaPizza = [
            'sabor' => $sabor,
            'precio' => (float)$precio,
            'tipo' => $tipo,
            'cantidad' => (int)$cantidad,
            'id' => (int)$idMasAlto
        ];
    
        $pizzas[] = $nuevaPizza;
    
        if (file_put_contents('pizzas.json', json_encode($pizzas, JSON_PRETTY_PRINT)) !== false) {
            $retorno = true;
        }
    
        return $retorno;
    }
    
    

    public static function ValidarPizzaCorrecta($sabor, $precio, $tipo, $cantidad){
        $retorno = false;
        if (Herramientas::parametroTipoPizzaCorrecto($tipo) && Herramientas::parametroNumericoValido($precio, 2000,10000) && Herramientas::parametroNumericoValido($cantidad, 1,50) && Herramientas::DatoStringCorrecto($sabor)) {           
            $retorno = true;
        }
        return $retorno;
    }
    

      
   public static function ValidarSiPizzaYaExiste($tipo, $sabor) {
        $pizzasJson = ArchivosJson::LeerListaPizzas();
        if ($pizzasJson != null && $tipo!=null && $sabor !=null) {
            foreach ($pizzasJson as $item) {
                if (($item['sabor'] == $sabor) && ($item['tipo'] == $tipo)) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function VerificarExistenciaTipoOSabor($tipo, $sabor)
    {
        $retorno = -1;
        $pizzasJson = ArchivosJson::LeerListaPizzas();
    
        if ($pizzasJson != null && $tipo != null && $sabor != null) {
            foreach ($pizzasJson as $item) {
                if ($item['sabor'] == $sabor) {
                    $retorno= 1; 
                } else if ($item['tipo'] == $tipo) {
                    $retorno= 2; 
                }
            }
        }
    
        return $retorno; 
    }
    

    
    public static function AgregarStockDePizza($tipo, $sabor, $cantidad, $precio)
    {
        $retorno = false;
        $pizzas = [];
        if (file_exists("pizzas.json")) {

            $pizzas = ArchivosJson::LeerListaPizzas();
            foreach ($pizzas as $key => $item) {
                if ($item['sabor'] == $sabor && $item['tipo'] == $tipo) {
                    $pizzas[$key]['cantidad'] = (int)$item['cantidad'] + (int)$cantidad;
                    $pizzas[$key]['precio'] = (float)$precio;
                    $retorno = true;
                    break;
                }
            }

            file_put_contents("pizzas.json", json_encode($pizzas, JSON_PRETTY_PRINT) . "\n");
        }
        return $retorno;
    }

}
?>