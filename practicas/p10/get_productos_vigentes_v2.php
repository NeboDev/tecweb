<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <?php
            /** SE CREA EL OBJETO DE CONEXION */
            @$link = new mysqli('localhost', 'root', '1234567890', 'marketzone');	

            /** comprobar la conexión */
            if ($link->connect_errno) 
            {
                die('Falló la conexión: '.$link->connect_error.'<br/>');
                    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
            }

            /** Crear una tabla que no devuelve un conjunto de resultados */
            if ( $result = $link->query("SELECT * FROM productos WHERE eliminado != 1") ) 
            {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                /** útil para liberar memoria asociada a un resultado con demasiada información */
                $result->free();
            }

            $link->close();
        
	?>

    <head>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
		<title>Productos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script>
            function show(button) {
            var row = button.closest('tr');
            var id = row.getAttribute('data-id');
            var data = row.querySelectorAll(".row-data");

            var nombre = data[0].innerHTML;
            var marca = data[1].innerHTML;
            var modelo = data[2].innerHTML;
            var precio = data[3].innerHTML;
            var unidades = data[4].innerHTML;
            var detalles = data[5].innerHTML;
            var imagenHTML = data[6].innerHTML;
            var imagen = imagenHTML.match(/src="([^"]*)"/)[1];

            alert(
                "Nombre: " + nombre + "\n" +
                "Marca: " + marca + "\n" +
                "Modelo: " + modelo + "\n" +
                "Precio: $" + precio + "\n" +
                "Unidades: " + unidades + "\n" +
                "Detalles: " + detalles + "\n" +
                "Imagen: " + imagen
            );

            send2form(id, nombre, marca, modelo, precio, unidades, detalles, imagen);
        }
        </script>

	</head>
    <body>
            <h3>PRODUCTOS</h3>

            
                <?php if (!empty($rows)): ?>
                <table class="table table-striped">
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
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $row): ?>
                           <tr id="row-<?= $row['id'] ?>" data-id="<?= $row['id'] ?>">
                                <th scope="row"><?= $row['id'] ?></th>
                                <td class="row-data"><?= $row['nombre'] ?></td>
                                <td class="row-data"><?= $row['marca'] ?></td>
                                <td class="row-data"><?= $row['modelo'] ?></td>
                                <td class="row-data"><?= $row['precio'] ?></td>
                                <td class="row-data"><?= $row['unidades'] ?></td>
                                <td class="row-data"><?= $row['detalles'] ?></td>
                                <td class="row-data"><img src="<?= $row['imagen'] ?>" alt="Imagen producto" style="width:100px; height:100px;" /></td>
                                <td><input type="button" value="Modificar" onclick="show(this)" /></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <script>
                    alert('No se encontraron productos');
                </script>
            <?php endif; ?>
            
        <p>
            <a href="https://validator.w3.org/check?uri=referer"><img
            src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
        </p>

        <script>
            function send2form(id, nombre, marca, modelo, precio, unidades, detalles, imagen) {
                var urlForm = "http://localhost/tecweb/practicas/p10/formulario_productos_v2.php";
                
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = urlForm;
                form.style.display = 'none';
                
                var fields = {
                    'id': id,
                    'nombre': nombre.trim(),
                    'marca': marca.trim(),
                    'modelo': modelo.trim(),
                    'precio': precio.trim(),
                    'unidades': unidades.trim(),
                    'detalles': detalles.trim(),
                    'imagen': imagen.trim()
                };
                
                // El id se envia como  oculto para identificar el producto sin permitir que se edite
                for (var key in fields) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = fields[key];
                    form.appendChild(input);
                }
                
                document.body.appendChild(form);
                form.submit();
            }
		</script>
    </body>
</html>