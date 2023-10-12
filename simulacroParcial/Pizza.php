<?php
/*B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
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
        $this->id = rand(1, 10000);
    }


    public function Equals($pizza)
    {
        $retorno = false;
        if($this->sabor == $pizza->sabor && $this->tipo == $pizza->tipo){
            $retorno = true;
        }
        return $retorno;
    }
    

    static function AltaDePizzaJson($pizza) {
        $retorno = false;
        $archivo = 'pizzas.json';
    
        if ($pizza instanceof Pizza && $pizza != null) {
            $pizzas = []; //array donde voy a guardar en .json
    
            if (file_exists($archivo)) {
                //$pizzas = json_decode(file_get_contents($archivo), true);
                $pizzas = ArchivosJson::LeerListaPizzas();
            }
            
    
            $pizzas[] = [
                'sabor' => $pizza->sabor,
                'precio' => $pizza->precio,
                'tipo' => $pizza->tipo,
                'cantidad' => $pizza->cantidad,
                'id' => $pizza->id
            ];
    
            file_put_contents($archivo, json_encode($pizzas, JSON_PRETTY_PRINT));
    
            $retorno = true;
        }
    
        return $retorno;
    }
    
    

    public static function ValidarPizzaCorrecta($sabor, $precio, $tipo, $cantidad){
        $retorno = false;
        if (Herramientas::parametroCorrecto($tipo) && Herramientas::EsNumerico($precio) && Herramientas::EsNumerico($cantidad) && Herramientas::DatoStringCorrecto($sabor)) {           
            $retorno = true;
        }
        return $retorno;
    }

 
    public static function ValidarSiPizzaYaExiste($pizza, $pizzasJson) {
        
        if($pizzasJson!=null){

            foreach($pizzasJson as $item){
                if($pizza->Equals($item)){
                    return $item;
                    break;
                }
            }
        }
        
        return null;
    }
    


    static function AgregarStockDePizza($pizza){
        $retorno=false;
        $pizzasAux = ArchivosJson::LeerListaPizzas();
        if($pizzasAux!=null){
            foreach($pizzasAux as $item){
                if($pizza->Equals($item)){
                    $item->precio = $pizza->precio;
                    $item->cantidad += $pizza->cantidad;
                }
            }
            if(file_put_contents("pizzas.json", json_encode($pizzasAux, JSON_PRETTY_PRINT))!= false){
                $retorno = true;
            }
        }
        
        return $retorno;

    }


    
    
    


}
?>