<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$a = “ManejadorSQL”;<br>$b = 'MySQL’;<br>$c = &$a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = "MySQL";
        $c = &$a;
        echo '<h4>Respuestas:</h4>';
        echo '<h5>a. Ahora muestra el contenido de cada variable:</h5>';
        echo "<p>\$a = $a <br>\$b = $b<br>\$c = $c</p>";
        echo '<h5>b. Agrega al código actual las siguientes asignaciones:</h5>';
        echo '<p>$a = “PHP server” $b = &$a;</p>';
        $a = "PHP server";
        $b = &$a;
        echo '<h5>c. Vuelve a mostrar el contenido de cada uno</h5>';
        echo "<p>\$a = $a<br>\$b = $b<br>\$c = $c</p>";
        echo '<h5>d. Describe y muestra en la pagina obtenida que ocurrio en el segundo bloque de asignaciones</h5>';
        echo '<ul>';
            echo '<li>Se cambio el valor de $a a "PHP server"</li>';
            echo '<li>Se creo una referencia de $b a $a usando &$a por lo que $b ahora apunta al mismo valor que $a</li>';
            echo '<li>Como $c era una referencia a $a  tambien cambio su valor a "PHP server"</li>';
            echo '<li>Todas las variables ahora tienen el valor "PHP server"</li>';
        echo '</ul>';
        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los
        arreglo):</p>
    <ul>
        <li>$a = "PHP5";</li>
        <li>$z[] = &$a;</li>
        <li>$b = “5a version de PHP”;</li>
        <li>$c = $b*10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = “MySQL”;</li>
    </ul>
    <?php
        echo '<h4>Respuestas</h4>';
        $a = "PHP5";
        echo '$a = '.$a."<br>";
        @$z[] = &$a;
        echo '$z[] = ';
            print_r($z);
        echo "<br>";
        $b = "5a version de PHP";
        echo '$b = '.$b."<br>";
        @$c = $b * 10;
        echo '$c = '.$c."<br>";
        @$a .= $b;
        echo '$a = '.$a."<br>";
        @$b *= $c;
        echo '$b = '.$b."<br>";
        $z[0] = "MySQL";
        echo '$z[0] = '. $z[0]."<br>";
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
        la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        echo '<h4>Respuestas</h4>';
        echo '$a = '.$GLOBALS['a']."<br>";
        echo '$b = '.$GLOBALS['b']."<br>";
        echo '$c = '.$GLOBALS['c']."<br>";
        echo '$z = ';
        print_r($GLOBALS['z']);
        echo "<br>";
        unset($a, $b, $c, $z);
    ?>
    
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:<br>
        $a = “7 personas”;<br>
        $b = (integer) $a;<br>
        $a = “9E3”;<br>
        $c = (double) $a;<br>        
    </p>
    <?php
        echo '<h4>Respuestas</h4>';
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
        echo "<p>\$a = $a <br>\$b = $b<br>\$c = $c</p>";
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(<datos>).</p>
    <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
    en uno que se pueda mostrar con un echo:</p>
    <ul>
        <li>$a = “0”;</li>
        <li>$b = “TRUE”;</li>
        <li>$c = FALSE;</li>
        <li>$d = ($a OR $b);</li>
        <li>$e = ($a AND $c);</li>
        <li>$f = ($a XOR $b);</li>
    </ul>
    <?php
        echo '<h4>Respuestas</h4>';
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        echo '<p>Usando var_dump():<br>';
        echo '$a: '; var_dump((bool)$a); echo '<br>';
        echo '$b: '; var_dump((bool)$b); echo '<br>';
        echo '$c: '; var_dump($c); echo '<br>';
        echo '$d: '; var_dump($d); echo '<br>';
        echo '$e: '; var_dump($e); echo '<br>';
        echo '$f: '; var_dump($f); echo '<br>';
        echo '</p>';

        echo '<p>Valores de $c y $e con echo usando var_export():<br>';
        echo '$c: ' . var_export($c, true) . "<br>";
        echo '$e: ' . var_export($e, true) . "<br>";
        echo '</p>';

    ?>

</body>
</html>