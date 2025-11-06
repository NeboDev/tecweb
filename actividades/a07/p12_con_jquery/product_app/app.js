$(document).ready(function () {
  let edit = false;

  $("#product-result").hide();
  listarProductos();

  function listarProductos() {
    $.ajax({
      url: "./backend/product-list.php",
      type: "GET",
      success: function (response) {
        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
        const productos = JSON.parse(response);

        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
        if (Object.keys(productos).length > 0) {
          // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
          let template = "";

          productos.forEach((producto) => {
            // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
            let descripcion = "";
            descripcion += "<li>precio: " + producto.precio + "</li>";
            descripcion += "<li>unidades: " + producto.unidades + "</li>";
            descripcion += "<li>modelo: " + producto.modelo + "</li>";
            descripcion += "<li>marca: " + producto.marca + "</li>";
            descripcion += "<li>detalles: " + producto.detalles + "</li>";

            template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
          });
          // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
          $("#products").html(template);
        }
      },
    });
  }

  $("#search").keyup(function () {
    if ($("#search").val()) {
      let search = $("#search").val();
      $.ajax({
        url: "./backend/product-search.php?search=" + $("#search").val(),
        data: { search },
        type: "GET",
        success: function (response) {
          if (!response.error) {
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            const productos = JSON.parse(response);

            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if (Object.keys(productos).length > 0) {
              // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
              let template = "";
              let template_bar = "";

              productos.forEach((producto) => {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = "";
                descripcion += "<li>precio: " + producto.precio + "</li>";
                descripcion += "<li>unidades: " + producto.unidades + "</li>";
                descripcion += "<li>modelo: " + producto.modelo + "</li>";
                descripcion += "<li>marca: " + producto.marca + "</li>";
                descripcion += "<li>detalles: " + producto.detalles + "</li>";

                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
              });
              // SE HACE VISIBLE LA BARRA DE ESTADO
              $("#product-result").show();
              // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
              $("#container").html(template_bar);
              // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
              $("#products").html(template);
            }
          }
        },
      });
    } else {
      $("#product-result").hide();
    }
  });

  $("#product-form").submit((e) => {
    e.preventDefault();

    // SE CREA EL OBJETO CON LOS DATOS DE LOS CAMPOS DEL FORMULARIO
    let postData = {
      nombre: $("#name").val(),
      id: $("#productId").val(),
      precio: parseFloat($("#price").val()),
      unidades: parseInt($("#units").val()),
      modelo: $("#model").val(),
      marca: $("#brand").val(),
      detalles: $("#details").val() || "NA",
      imagen: $("#img").val() || "img/default.png",
    };

    /**
     * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
     * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
     **/

    const url =
      edit === false
        ? "./backend/product-add.php"
        : "./backend/product-edit.php";

    $.post(url, postData, (response) => {
      //console.log(response);
      // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
      let respuesta = JSON.parse(response);
      // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
      let template_bar = "";
      template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
      // SE REINICIA EL FORMULARIO
      $("#product-form")[0].reset();
      // SE HACE VISIBLE LA BARRA DE ESTADO
      $("#product-result").show();
      // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
      $("#container").html(template_bar);
      // SE LISTAN TODOS LOS PRODUCTOS
      listarProductos();
      // SE REGRESA LA BANDERA DE EDICIÓN A false
      edit = false;
    });
  });

  $(document).on("click", ".product-delete", (e) => {
    if (confirm("¿Realmente deseas eliminar el producto?")) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr("productId");
      $.post("./backend/product-delete.php", { id }, (response) => {
        $("#product-result").hide();
        listarProductos();
      });
    }
  });

  $(document).on("click", ".product-item", (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr("productId");
    $.post("./backend/product-single.php", { id }, (response) => {
      // SE CONVIERTE A OBJETO EL JSON OBTENIDO
      let product = JSON.parse(response);
      // SE INSERTAN LOS DATOS EN LOS CAMPOS CORRESPONDIENTES
      $("#name").val(product.nombre);
      $("#price").val(product.precio);
      $("#units").val(product.unidades);
      $("#model").val(product.modelo);
      $("#brand").val(product.marca);
      $("#details").val(product.detalles);
      $("#img").val(product.imagen);

      // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO EN LA ACTUALIZACION
      $("#productId").val(product.id);

      // SE PONE LA BANDERA DE EDICIÓN EN true
      edit = true;
    });
    e.preventDefault();
  });
});
