// Cuando carga la pagina
function iniciarFormulario() {
  document.getElementById("form-name").focus(); // Se fija en el nombre
}

// Validaciones individuales
function validarNombre() {
  var nombre = document.getElementById("form-name");
  var error = document.getElementById("error-name");

  if (nombre.value.trim() === "" || nombre.value.length > 100) {
    error.textContent = "El nombre es obligatorio, debe ser ≤ 100 caracteres";
    nombre.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    nombre.style.border = "";
    return true;
  }
}

function validarMarca() {
  var marca = document.getElementById("form-brand");
  var error = document.getElementById("error-brand");

  if (marca.value === "" || marca.value === "--Selecciona una marca--") {
    error.textContent = "Selecciona una marca valida";
    marca.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    marca.style.border = "";
    return true;
  }
}

function validarModelo() {
  var modelo = document.getElementById("form-model");
  var error = document.getElementById("error-model");

  if (modelo.value.trim() === "" || modelo.value.length > 25) {
    error.textContent = "Modelo requerido, debe ser <= 25 caracteres";
    modelo.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    modelo.style.border = "";
    return true;
  }
}

function validarPrecio() {
  var precio = document.getElementById("form-price");
  var error = document.getElementById("error-price");
  var valor = parseFloat(precio.value);

  if (isNaN(valor) || valor <= 99.99) {
    error.textContent = "El precio debe ser mayor a 99.99";
    precio.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    precio.style.border = "";
    return true;
  }
}

function validarDetalles() {
  var detalles = document.getElementById("form-details");
  var error = document.getElementById("error-details");

  if (detalles.value.length > 250) {
    error.textContent = "No se permiten mas de 250 caracteres";
    detalles.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    detalles.style.border = "";
    return true;
  }
}

function validarUnidades() {
  var unidades = document.getElementById("form-units");
  var error = document.getElementById("error-units");
  var valor = parseInt(unidades.value);

  if (isNaN(valor) || valor < 0) {
    error.textContent = "Las unidades deben ser ≥ 0.";
    unidades.style.border = "2px solid red";
    return false;
  } else {
    error.textContent = "";
    unidades.style.border = "";
    return true;
  }
}

function asignarImagenPorDefecto() {
  var imagen = document.getElementById("form-img");
  if (imagen.value.trim() === "") {
    imagen.value = "img/imagen.png";
  }
}
// Validacion completa al enviar
function validarFormulario(e) {
  var nombreValido = validarNombre();
  var marcaValida = validarMarca();
  var modeloValido = validarModelo();
  var precioValido = validarPrecio();
  var detallesValidos = validarDetalles();
  var unidadesValidas = validarUnidades();

  if (
    !nombreValido ||
    !marcaValida ||
    !modeloValido ||
    !precioValido ||
    !detallesValidos ||
    !unidadesValidas
  ) {
    e.preventDefault();
    alert("Corrige los errores antes de enviar el formulario");
    return false;
  }

  return true;
}
