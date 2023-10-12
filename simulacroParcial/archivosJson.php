
<?php

class ArchivosJson{
    
    static function LeerListaPizzas(){
            $retorno = null;
            if (file_exists("pizzas.json")) {
                $pizzasEnJson = json_decode(file_get_contents("pizzas.json"));

                if ($pizzasEnJson) {
                    $pizzas = [];

                    foreach ($pizzasEnJson as $item) {
                        $pizza = new Pizza($item->sabor, $item->precio, $item->tipo, $item->cantidad, $item->id);
                        $pizzas[] = $pizza;
                    }
                    $retorno = $pizzas;
                }
            }
            return $retorno;

    }
}




?>