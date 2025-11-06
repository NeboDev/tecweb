$(document).ready(function () {
  let edit = false;

  let validationState = {
    name: { isValid: false, message: "", touched: false },
    price: { isValid: false, message: "", touched: false },
    units: { isValid: false, message: "", touched: false },
    model: { isValid: false, message: "", touched: false },
    brand: { isValid: false, message: "", touched: false },
    details: { isValid: true, message: "", touched: false },
    img: { isValid: true, message: "", touched: false },
  };

  $("#product-result").hide();
  listarProductos();

  //EVENTOS DE VALIDACION CADA QUE CAMBIA EL FOCO
  $("#name").on("blur", validarName);
  $("#price").on("blur", validarPrice);
  $("#units").on("blur", validarUnits);
  $("#model").on("blur", validarModel);
  $("#brand").on("blur", validarBrand);
  $("#details").on("blur", validarDetails);

  //FUNCION PARA MOSTRAR LAS VALIDACIONES EN LA BARRA DE STATUS
  function mostrarValidacionesStatus() {
    let template = "";
    let campoEditado = false;
    for (const field in validationState) {
      const status = validationState[field];
      if (status.touched && status.message) {
        campoEditado = true;
        template += `
         <li style="list-style: none;">${status.message}</li>
       `;
      }
    }

    if (campoEditado) {
      $("#container").html(template);
      $("#product-result").show();
    } else {
      $("#product-result").hide();
    }
  }

  //FUNCION PARA VALIDAR EL NOMBRE
  function validarName() {
    const nombre = $("#name").val().trim();
    validationState.name.isValid = false;
    validationState.name.touched = true;
    if (!nombre) {
      validationState.name.message = "El nombre es requerido";
    } else if (nombre.length > 100) {
      validationState.name.message =
        "El nombre debe tener máximo 100 caracteres";
    } else {
      validationState.name.isValid = true;
      validationState.name.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.name.isValid;
  }

  //FUNCION PARA VALIDAR EL PRECIO
  function validarPrice() {
    const precio = parseFloat($("#price").val());
    validationState.price.isValid = false;
    validationState.price.touched = true;
    if (isNaN(precio)) {
      validationState.price.message = "El precio es requerido";
    } else if (precio <= 99.99) {
      validationState.price.message = "El precio debe ser mayor a 99.99";
    } else {
      validationState.price.isValid = true;
      validationState.price.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.price.isValid;
  }

  //FUNCION PARA VALIDAR LAS UNIDADES
  function validarUnits() {
    const unidades = parseInt($("#units").val());
    validationState.units.isValid = false;
    validationState.units.touched = true;

    if (isNaN(unidades)) {
      validationState.units.message = "Las unidades son requeridas";
    } else if (unidades < 0) {
      validationState.units.message =
        "Las unidades deben ser mayor o igual a 0";
    } else {
      validationState.units.isValid = true;
      validationState.units.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.units.isValid;
  }

  //FUNCION PARA VALIDAR EL MODELO
  function validarModel() {
    const modelo = $("#model").val().trim();
    validationState.model.isValid = false;
    validationState.model.touched = true;

    if (!modelo) {
      validationState.model.message = "El modelo es requerido";
    } else if (modelo.length > 25) {
      validationState.model.message =
        "El modelo debe tener maximo 25 caracteres";
    } else {
      validationState.model.isValid = true;
      validationState.model.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.model.isValid;
  }

  //FUNCION PARA VALIDAR LA MARCA
  function validarBrand() {
    const marca = $("#brand").val().trim();
    validationState.brand.isValid = false;
    validationState.brand.touched = true;

    if (!marca) {
      validationState.brand.message = "La marca es requerida";
    } else {
      validationState.brand.isValid = true;
      validationState.brand.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.brand.isValid;
  }

  //FUNCION PARA VALIDAR LOS DETALLES
  function validarDetails() {
    const detalles = $("#details").val().trim();
    validationState.details.isValid = true;
    validationState.details.touched = true;

    if (detalles.length > 250) {
      validationState.details.isValid = false;
      validationState.details.message =
        "Los detalles deben tener maximo 250 caracteres";
    } else {
      validationState.details.message = "";
    }

    mostrarValidacionesStatus();
    return validationState.details.isValid;
  }

  function validarFormulario() {
    // SE MARCAN LOS CAMPTOS COMO EDITADOS PARA MOSTRAR TODOS LOS ERRORES CUANDO ENVIE EL FORMULARIO
    for (const field in validationState) {
      validationState[field].touched = true;
    }

    const validaciones = [
      validarName(),
      validarPrice(),
      validarUnits(),
      validarModel(),
      validarBrand(),
      validarDetails(),
    ];
    //FAT ARROW FUNCTION PARA VERIFICAR QUE TODAS LAS VALIDACIONES SEAN VALIDAS :/
    return validaciones.every((valid) => valid === true);
  }

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

    if (!validarFormulario()) {
      let template_bar = `
          <li style="list-style: none;">Error: Por favor corrige los campos invalidos</li>
        `;
      $("#container").append(template_bar);
      $("#product-result").show();
      return; // NO SE ENVIA SI HAY ERRORES
    }

    const url =
      edit === false
        ? "./backend/product-add.php"
        : "./backend/product-edit.php";

    $.post(url, postData, (response) => {
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

      // SE REINICIA EL ESTADO DE EDITADO PARA QUE SOLO MUESTE LOS CAMPOS QUE SE EDITEN
      for (const field in validationState) {
        validationState[field].touched = false;
      }

      // SE PONE LA BANDERA DE EDICIÓN EN true
      edit = true;
    });
    e.preventDefault();
  });
});
