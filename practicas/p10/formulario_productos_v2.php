<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Actualizacion de Productos</title>
    <style>
      ol,
      ul {
        list-style-type: none;
      }
      .error {
        color: red;
        font-size: 0.9em;
      }
      input:focus,
      select:focus,
      textarea:focus {
        background-color: #e6f7ff;
      }
    </style>
    <script src="./src/main.js"></script>
  </head>

  <body onload="iniciarFormulario()">
    <h1>Actualiza tu producto</h1>

    <form
      id="formularioActualizacion"
      action="http://localhost/tecweb/practicas/p10/set_producto_v2.php"
      method="post"
    >
      <fieldset>
        <legend>Datos del producto</legend>
        <ul>
          <li>
            <label for="form-name">Nombre:</label>
            <input
              type="text"
              name="name"
              id="form-name"
              maxlength="100"
              value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>"
              required
              onblur="validarNombre()"
            />
            <span id="error-name" class="error"></span>
          </li>

          <li>
              <label for="form-brand">Marca:</label>
              <select name="brand" id="form-brand" required onchange="validarMarca()">
              <option value="">--Selecciona una marca--</option>
              <option value="Arduino">Arduino</option>
              <option value="Espressif">Espressif</option>
              <option value="Microchip">Microchip</option>
              <option value="Yageo">Yageo</option>
              <option value="UNI-T">UNI-T</option>
              <option value="Pololu">Pololu</option>
              <option value="Keyes">Keyes</option>
            </select>
            <span id="error-brand" class="error"></span>
          </li>

          <li>
            <label for="form-model">Modelo:</label>
            <input
              type="text"
              name="model"
              id="form-model"
              maxlength="25"
              value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>"
              required
              onblur="validarModelo()"
            />
            <span id="error-model" class="error"></span>
          </li>

          <li>
            <label for="form-price">Precio:</label>
            <input
              type="number"
              name="price"
              id="form-price"
              min="100"
              step="0.01"
              value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>"
              required
              onchange="validarPrecio()"
            />
            <span id="error-price" class="error"></span>
          </li>

          <li>
            <label for="form-details">Detalles (opcional):</label><br />
            <textarea name="details" rows="4" cols="60" id="form-details"
                placeholder="Máximo 250 caracteres"
                onblur="validarDetalles()"><?= !empty($_POST['detalles']) ? $_POST['detalles'] : (!empty($_GET['detalles']) ? $_GET['detalles'] : '') ?></textarea>
            <span id="error-details" class="error"></span>
        </li>

          <li>
            <label for="form-units">Unidades:</label>
            <input
              type="number"
              name="units"
              id="form-units"
              min="0"
              value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>"
              required
              onblur="validarUnidades()"
            />
            <span id="error-units" class="error"></span>
          </li>

          <li>
            <label for="form-img">Imagen (opcional):</label>
            <input
              type="text"
              name="img"
              id="form-img"
              value="<?= !empty($_POST['imagen'])?$_POST['imagen']:$_GET['imagen'] ?>"
              placeholder="ruta/imagen.jpg"
              onblur="asignarImagenPorDefecto()"
            />
          </li>
        </ul>
      </fieldset>

      <p>
        <input
          type="submit"
          id="submit"
          value="Registrar producto"
          onclick="validarFormulario(event)"
        />
      </p>
    </form>

    <?php if (!empty($_GET['marca'])): ?>
      <script>
        window.addEventListener("DOMContentLoaded", () => {
          const marca = "<?= trim($_GET['marca']) ?>";

          const select = document.getElementById("form-brand");
          if (select) {
            // Forzar seleccin
            let found = false;

            // Recorremos opciones y buscamos coincidencia (sin case/sensitive)
            for (let option of select.options) {
              if (option.value.trim().toLowerCase() === marca.trim().toLowerCase()) {
                option.selected = true;
                found = true;
                break;
              }
            }
          }
        });
      </script>
      <?php endif; ?>

  </body>
</html>
