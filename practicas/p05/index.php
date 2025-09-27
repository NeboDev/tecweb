<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
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
    <p>$a = "ManejadorSQL";<br />$b = 'MySQL';<br />$c = &amp;$a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = "MySQL";
        $c = &$a;

        echo '<h4>Respuestas:</h4>';
        echo '<h5>a. Ahora muestra el contenido de cada variable:</h5>';
        echo "<p>\$a = $a<br />\$b = $b<br />\$c = $c</p>";

        echo '<h5>b. Agrega al código actual las siguientes asignaciones:</h5>';
        echo '<p>$a = "PHP server" $b = &amp;$a;</p>';

        $a = "PHP server";
        $b = &$a;

        echo '<h5>c. Vuelve a mostrar el contenido de cada uno</h5>';
        echo "<p>\$a = $a<br />\$b = $b<br />\$c = $c</p>";

        echo '<h5>d. Describe y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</h5>';
        echo '<ul>';
            echo '<li>Se cambió el valor de $a a "PHP server"</li>';
            echo '<li>Se creó una referencia de $b a $a usando <code>&amp;$a</code>, por lo que $b ahora apunta al mismo valor que $a</li>';
            echo '<li>Como $c era una referencia a $a, también cambió su valor a "PHP server"</li>';
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
        <li>$z[] = &amp;$a;</li>
        <li>$b = “5a version de PHP”;</li>
        <li>$c = $b*10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = “MySQL”;</li>
    </ul>
    <?php
        echo '<h4>Respuestas</h4>';
        $a = "PHP5";
        echo '<p>$a = ' . $a . '</p>';
        @$z[] = &$a;
        echo '<p>$z[] = </p>';
        echo '<pre>';
        print_r($z);
        echo '</pre>';
        $b = "5a version de PHP";
        echo '<p>$b = ' . $b .'</p>';
        @$c = $b * 10;
        echo '<p>$c = ' . $c . '</p>';
        @$a .= $b;
        echo '<p>$a = ' . $a .'</p>';
    ?>


    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
        la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        echo '<h4>Respuestas</h4>';

        echo '<p>$a = ' . $GLOBALS['a'] . '</p>';
        echo '<p>$b = ' . $GLOBALS['b'] . '</p>';
        echo '<p>$c = ' . $GLOBALS['c'] . '</p>';

        echo '<p>$z = </p>';
        echo '<pre>';
        print_r($GLOBALS['z']);
        echo '</pre>';

    ?>

    
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:<br />
        $a = “7 personas”;<br />
        $b = (integer) $a;<br />
        $a = “9E3”;<br />
        $c = (double) $a;<br />        
    </p>
    <?php
        echo '<h4>Respuestas</h4>';

        echo '<p>$a = ' . $GLOBALS['a'] . '</p>';
        echo '<p>$b = ' . $GLOBALS['b'] . '</p>';
        echo '<p>$c = ' . $GLOBALS['c'] . '</p>';

        echo '<p>$z = </p>';
        echo '<pre>';
        print_r($GLOBALS['z']);
        echo '</pre>';

    ?>


    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(&lt;datos&gt;).</p>
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
        echo '<pre>';
        echo 'Usando var_dump():' . "\n";
        var_dump((bool)$a);
        var_dump((bool)$b);
        var_dump($c);
        var_dump($d);
        var_dump($e);
        var_dump($f);
        echo '</pre>';

        echo '<p>Valores de $c y $e con echo usando var_export():<br />';
        echo '$c: ' . var_export($c, true) . "<br />";
        echo '$e: ' . var_export($e, true) . "<br />";
        echo '</p>';
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    <ol>
        <li>La versión de Apache y PHP,</li>
        <li>El nombre del sistema operativo (servidor)</li>
        <li>El idioma del navegador (cliente)</li>
    </ol>
    <?php
        echo '<h4>Respuestas</h4>';
        echo '<p>'.'a. Version de Apache y PHP: ' . $_SERVER['SERVER_SOFTWARE'].'</p>';
        //No existe un indice concreto que nos de el nombre del SO pero con SERVER SIGNATURE se infiere PHP_OS si lo da.
        echo '<p>'.'b. OS del servidor: ' . PHP_OS .'</p>';
        echo '<p>'.'c. Idioma del navegador: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'].'</p>';
    ?>

    <p>
    <a href="https://validator.w3.org/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>

</body>
</html>