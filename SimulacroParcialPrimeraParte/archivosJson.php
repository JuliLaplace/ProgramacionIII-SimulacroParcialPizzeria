
<?php

class ArchivosJson{

    static function LeerListaPizzas() {
        $retorno = null;
        if (file_exists("pizzas.json")) {
            $pizzasEnJson = json_decode(file_get_contents("pizzas.json"), true); // el true lo pongo para indicar que es un array asociativo

            if ($pizzasEnJson) {
                $pizzas = [];

                foreach ($pizzasEnJson as $item) {
                    $nuevaPizza = [
                        'sabor' => $item['sabor'], 
                        'precio' => $item['precio'],
                        'tipo' => $item['tipo'],
                        'cantidad' => $item['cantidad'],
                        'id' => $item['id']
                    ];
                    $pizzas[] = $nuevaPizza;
                }
                $retorno = $pizzas;
            }
        }
        return $retorno;
    }
}




?>