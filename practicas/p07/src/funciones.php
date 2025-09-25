<?php
function verificarMultiploDe5y7() {
    if (isset($_GET['numero'])) {
        $num = $_GET['numero'];
        if ($num % 5 == 0 && $num % 7 == 0) {
            echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
        } else {
            echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
        }
    }
}

function secuenciaImparParImpar(){
    $numeros = [];
    $encontrado = false;

    while(!$encontrado){
        //PHP deja agregar filas sin especificar los indices
        $numeros[] = [
            $num1 = rand(100, 999),
            $num2 = rand(100, 999),
            $num3 = rand(100, 999)
        ];

        if ($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0) {
            $encontrado = true;
        }
    }
    //Count retorna el numero de elementos en un arreglo
    $totalNumeros = count($numeros) * 3;
    echo '<h3> R= '.$totalNumeros.' números obtenidos en '.count($numeros).' iteraciones</h3>';
}

?>