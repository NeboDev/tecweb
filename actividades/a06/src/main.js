function getDatos() {
  var nombre = prompt("Nombre: ", "");

  var edad = prompt("Edad: ", 0);

  var div1 = document.getElementById("nombre");
  div1.innerHTML = "<h3> Nombre: " + nombre + "</h3>";

  var div2 = document.getElementById("edad");
  div2.innerHTML = "<h3> Edad: " + edad + "</h3>";
}

function ejemplo1() {
  //El document write hacer que despues de renderizada la pagina por eso lo cambio a como se hace en la funcion de ejemplo getDatos()
  let div = document.getElementById("mensaje");
  div.innerHTML = "<p>Hola Mundo</p>";
}
