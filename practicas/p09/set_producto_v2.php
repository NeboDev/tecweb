<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
		<title>Productos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
	</head>

    <body>
        <div class="container mt-5">
            <h1>Registro de productos</h1>
            <?php
                // Recibir datos del formulario
                $nombre = $_POST['name'];
                $marca  = $_POST['brand'];
                $modelo = $_POST['model'];
                $precio = $_POST['price'];
                $detalles = $_POST['details'];
                $unidades = $_POST['units'];
                $imagen   = $_POST['img'];

                /** SE CREA EL OBJETO DE CONEXION */
                @$link = new mysqli('localhost', 'root', '1234567890', 'marketzone');

                /** comprobar la conexión */
                if ($link->connect_errno) {
                    die('Falló la conexión: ' . $link->connect_error . '<br/>');
                }
                
                /** VALIDAR SI YA EXISTE EL PRODUCTO */
                $sql_check = "SELECT id FROM productos 
                            WHERE nombre = '{$nombre}' 
                            AND marca = '{$marca}' 
                            AND modelo = '{$modelo}'";

                $resultado = $link->query($sql_check);

                if ($resultado->num_rows > 0) {

                    echo '<h4 class="alert-heading">Producto duplicado</h4>';
                    echo '<p>El producto ya existe en la base de datos</p>';
                    echo '<p>No se ha podido agregar el producto</p>';
                    
                } else {
                    /** Insertar el producto si no existe */
                    $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
                    
                    if ($link->query($sql)) {
                        $id_insertado = $link->insert_id;
                        //Uso lo de bootstrap porque ya lo hemos estado usando en estas practicas
                        echo '<div class="alert alert-success" role="alert">';
                            echo '<h4 class="alert-heading">Producto registrado con éxito</h4>';
                            echo '<p>Producto insertado con ID: ' . $id_insertado . '</p>';
                        echo '</div>';

                        echo '<div class="card mt-3">';
                        echo '<table class="table table-bordered table-sm">';
                            echo '<thead class="thead-light">';
                                echo '<tr>';
                                echo '<th>Campo</th>';
                                echo '<th>Valor</th>';
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                echo '<tr><td><strong>ID</strong></td><td>' . $id_insertado . '</td></tr>';
                                echo '<tr><td><strong>Nombre</strong></td><td>' . $nombre . '</td></tr>';
                                echo '<tr><td><strong>Marca</strong></td><td>' . $marca . '</td></tr>';
                                echo '<tr><td><strong>Modelo</strong></td><td>' . $modelo . '</td></tr>';
                                echo '<tr><td><strong>Precio</strong></td><td>$' . $precio . '</td></tr>';
                                echo '<tr><td><strong>Detalles</strong></td><td>' . $detalles . '</td></tr>';
                                echo '<tr><td><strong>Unidades</strong></td><td>' . $unidades . '</td></tr>';
                                echo '<tr><td><strong>Imagen</strong></td><td>' . $imagen . '</td></tr>';
                            echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                        
                    } else {
                        echo '<div class="alert alert-danger" role="alert">';
                            echo 'El Producto no pudo ser insertado =(';
                        echo '</div>';
                    }
                }

                $link->close();
            ?>
            
        </div>
    </body>
</html>