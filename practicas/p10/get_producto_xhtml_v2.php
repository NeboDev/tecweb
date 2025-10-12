<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    //header("Content-Type: application/json; charset=utf-8"); 
    $data = array();

	if(isset($_GET['tope']))
    {
		$tope = $_GET['tope'];
    }
    else
    {
        die('Parámetro "tope" no detectado...');
    }

	if (!empty($tope))
	{
		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', '1234567890', 'marketzone');
        /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			//exit();
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			$row = $result->fetch_all(MYSQLI_ASSOC);

            /** Se crea un arreglo con la estructura deseada */
            foreach($row as $num => $registro) {            // Se recorren tuplas
                foreach($registro as $key => $value) {      // Se recorren campos
                    $data[$num][$key] = utf8_encode($value);
                }
            }

			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();

        /** Se devuelven los datos en formato JSON */
        //echo json_encode($data, JSON_PRETTY_PRINT);
	}
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script>
			function show() {
				var rowId = event.target.parentNode.parentNode.id;
				var data = document.getElementById(rowId).querySelectorAll(".row-data");

				var nombre = data[0].innerHTML;
				var marca = data[1].innerHTML;
				var modelo = data[2].innerHTML;
				var precio = data[3].innerHTML;
				var unidades = data[4].innerHTML;
				var detalles = data[5].innerHTML;
				var imagenHTML = data[6].innerHTML;
				var imagen = imagenHTML.match(/src="([^"]*)"/)[1]; // Extraer solo la URL

				alert(
					"Nombre: " + nombre + "\n" +
					"Marca: " + marca + "\n" +
					"Modelo: " + modelo + "\n" +
					"Precio: $" + precio + "\n" +
					"Unidades: " + unidades + "\n" +
					"Detalles: " + detalles + "\n" +
					"Imagen: " + imagen
				);

				// Enviar los datos al formulario
				send2form(nombre, marca, modelo, precio, unidades, detalles, imagen);
			}
		</script>

	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>
		
		<?php if( isset($row) ) : ?>
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $value) : ?>
					<tr id="row-<?= $value['id'] ?>">
						<th scope="row"><?= $value['id'] ?></th>
						<td class="row-data"><?= $value['nombre'] ?></td>
						<td class="row-data"><?= $value['marca'] ?></td>
						<td class="row-data"><?= $value['modelo'] ?></td>
						<td class="row-data"><?= $value['precio'] ?></td>
						<td class="row-data"><?= $value['unidades'] ?></td>
						<td class="row-data"><?= $value['detalles'] ?></td>
						<td class="row-data"><img src="<?= $value['imagen'] ?>" style="width:100px; height:100px;"></td>
						<td><input type="button" value="Modificar" onclick="show()" /></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php elseif(!empty($id)) : ?>

			 <script>
                alert('El ID del producto no existe');
             </script>

		<?php endif; ?>

		<script>
		function send2form(nombre, marca, modelo, precio, unidades, detalles, imagen) {
			var urlForm = "http://localhost/tecweb/practicas/p10/formulario_productos_v2.php";
			
			// Limpiar espacios extra
			nombre = nombre.trim();
			marca = marca.trim();
			modelo = modelo.trim();
			precio = precio.trim();
			unidades = unidades.trim();
			detalles = detalles.trim();
			imagen = imagen.trim();

			var params = 
				"nombre=" + encodeURIComponent(nombre) +
				"&marca=" + encodeURIComponent(marca) +
				"&modelo=" + encodeURIComponent(modelo) +
				"&precio=" + encodeURIComponent(precio) +
				"&unidades=" + encodeURIComponent(unidades) +
				"&detalles=" + encodeURIComponent(detalles) +
				"&imagen=" + encodeURIComponent(imagen);
			
			// Abrir el formulario con los datos
			window.open(urlForm + "?" + params);
		}
		</script>

	</body>
</html>