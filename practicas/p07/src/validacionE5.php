<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Ejercicio 5 - Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    
    <?php
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    
    if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
        echo "<p style='color: green;'>Bienvenida, usted está en el rango de edad permitido.</p>";
    } else {
        echo "<p style='color: red;'>No cumple con los requisitos.</p>";
    }
    ?>
    
    
</body>
</html>