<?php
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $marca  = $_POST['brand'];
    $modelo = $_POST['model'];
    $precio = $_POST['price'];
    $detalles = $_POST['details'];
    $unidades = $_POST['units'];
    $imagen   = $_POST['img'];


    /* MySQL Conexion*/
    @$link = new mysqli('localhost', 'root', '1234567890', 'marketzone');	
    // Chequea coneccion
    if($link === false){
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }
    // Ejecuta la actualizacion del registro
    $sql = "UPDATE productos SET 
    nombre = '$nombre',
    marca = '$marca',
    modelo = '$modelo',
    precio = $precio,
    unidades = $unidades,
    detalles = '$detalles',
    imagen = '$imagen'
    WHERE id = $id";
    
    if(mysqli_query($link, $sql)){
    echo "Registro actualizado.";
    } else {
    echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
    }
    // Cierra la conexion
    mysqli_close($link);
?>