// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
  precio: 0.0,
  unidades: 1,
  modelo: "XX-000",
  marca: "NA",
  detalles: "NA",
  imagen: "img/default.png",
};

function init() {
  var JsonString = JSON.stringify(baseJSON, null, 2);
  document.getElementById("description").value = JsonString;
}

$(document).ready(function () {
  let edit = false;

  fetchProducts();
  $("#product-result").addClass("d-none");

  $("#search").keyup(function () {
    if ($("#search").val()) {
      let search = $("#search").val();
      $.ajax({
        url: "./backend/product-search.php",
        data: { search: search },
        type: "POST",
        success: function (response) {
          let products = JSON.parse(response);

          // Mostrar resultados en la tabla
          let template = "";
          products.forEach((product) => {
            let descripcion = "";
            descripcion += "<li>precio: " + product.precio + "</li>";
            descripcion += "<li>unidades: " + product.unidades + "</li>";
            descripcion += "<li>modelo: " + product.modelo + "</li>";
            descripcion += "<li>marca: " + product.marca + "</li>";
            descripcion += "<li>detalles: " + product.detalles + "</li>";

            template += `
              <tr productId="${product.id}">
                <td>${product.id}</td>
                <td>${product.nombre}</td>
                <td><ul>${descripcion}</ul></td>
                <td>
                  <button class="product-delete btn btn-danger">
                    Eliminar
                  </button>
                </td>
              </tr>
            `;
          });

          $("#products").html(template);

          // Mostrar nombres en la barra de estado
          let statusTemplate = "";
          products.forEach((product) => {
            statusTemplate += `<li>${product.nombre}</li>`;
          });
          $("#container").html(statusTemplate);
          $("#product-result").removeClass("d-none");
        },
      });
    } else {
      fetchProducts();
      $("#product-result").addClass("d-none");
    }
  });

  $("#product-form").submit(function (e) {
    e.preventDefault();
    let errores = [];
    // OBTENER VALORES
    let nombre = $("#name").val();
    let productoDescripcion = $("#description").val();

    let valJSON;
    try {
      valJSON = JSON.parse(productoDescripcion);
    } catch (error) {
      alert("El formato JSON de no es valido se reestablecera");
      $("#description").focus();
      var JsonString = JSON.stringify(baseJSON, null, 2);
      $("#description").val(JsonString);
      return false;
    }

    // VALIDACIONES DEL NOMBRE
    if (nombre.trim() === "") {
      errores.push("El nombre del producto es obligatorio");
    } else if (nombre.length > 100) {
      errores.push("El nombre debe ser ≤ 100 caracteres");
    }

    // Validar marca
    if (
      !valJSON.marca ||
      valJSON.marca === "NA" ||
      valJSON.marca.trim() === ""
    ) {
      errores.push("La marca es obligatoria");
    }

    // Validar modelo
    if (!valJSON.modelo || valJSON.modelo.trim() === "") {
      errores.push("El modelo es requerido");
    } else if (valJSON.modelo.length > 25) {
      errores.push("El modelo debe ser ≤ 25 caracteres");
    }

    // Validar precio
    var precio = parseFloat(valJSON.precio);
    if (isNaN(precio) || precio <= 99.99) {
      errores.push("El precio debe ser mayor a 99.99");
    }

    // Validar unidades
    var unidades = parseInt(valJSON.unidades);
    if (isNaN(unidades) || unidades < 0) {
      errores.push("Las unidades deben ser ≥ 0");
    }
    // Validar detalles
    if (valJSON.detalles && valJSON.detalles.length > 250) {
      errores.push("Los detalles no pueden tener mas de 250 caracteres");
    }

    // Asignar imagen por defecto si esta vacio el campo
    if (!valJSON.imagen || valJSON.imagen.trim() === "") {
      valJSON.imagen = "img/imagen.png";
    }

    // SI HAY ERRORES SE MUESTRAN EN EL DIV QUE ESTA EN EL HTML
    if (errores.length > 0) {
      var mensajeError =
        "Por favor, corrige los siguientes errores:\n" + errores.join("\n");
      $("#container").html(mensajeError);
      $("#product-result").removeClass("d-none");
      return false;
    }

    const postData = JSON.stringify({
      nombre: nombre.trim(),
      precio: precio,
      unidades: unidades,
      modelo: valJSON.modelo,
      marca: valJSON.marca,
      detalles: valJSON.detalles ? valJSON.detalles.trim() : "",
      imagen: valJSON.imagen,
    });

    $.post("./backend/product-add.php", postData, function (response) {
      const data = JSON.parse(response);
      let displayHTML = `
                  <p><strong>status:</strong> ${data.status} <br> ${data.message}</p>
              `;
      $("#container").html(displayHTML);
      $("#product-result").removeClass("d-none");
      fetchProducts();
    });
  });

  function fetchProducts() {
    $.ajax({
      url: "./backend/product-list.php",
      type: "GET",
      success: function (response) {
        let products = JSON.parse(response);
        let template = "";

        products.forEach((product) => {
          let descripcion = "";
          descripcion += "<li>precio: " + product.precio + "</li>";
          descripcion += "<li>unidades: " + product.unidades + "</li>";
          descripcion += "<li>modelo: " + product.modelo + "</li>";
          descripcion += "<li>marca: " + product.marca + "</li>";
          descripcion += "<li>detalles: " + product.detalles + "</li>";

          template += `
          <tr productId="${product.id}">
            <td>${product.id}</td>
            <td>${product.nombre}</td>
            <td><ul>${descripcion}</ul></td>
            <td>
              <button class="product-delete btn btn-danger">
                Eliminar
              </button>
            </td>
          </tr>
        `;
        });

        $("#products").html(template);
      },
    });
  }

  $(document).on("click", ".product-delete", function () {
    if (confirm("¿Estás seguro que deseas eliminar el producto?")) {
      let productId = $(this).closest("tr").attr("productId");

      // ENVIAR COMO OBJETO, NO COMO STRING
      $.post(
        "./backend/product-delete.php",
        { id: productId },
        function (response) {
          const data = JSON.parse(response);
          let displayHTML = `
                  <p><strong>status:</strong> ${data.status} <br> ${data.message}</p>
              `;
          $("#container").html(displayHTML);
          $("#product-result").removeClass("d-none");
          fetchProducts();
        },
      );
    }
  });
});
