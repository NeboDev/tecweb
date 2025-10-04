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

function ejemplo2() {
  var nombre = "Juan";
  var edad = 10;
  var altura = 1.92;
  var casado = false;

  var div1 = document.getElementById("nombre");
  var div2 = document.getElementById("edad");
  var div3 = document.getElementById("altura");
  var div4 = document.getElementById("casado");
  div1.innerHTML = "<p>" + nombre + "</p>";
  div2.innerHTML = "<p>" + edad + "</p>";
  div3.innerHTML = "<p>" + altura + "</p>";
  div4.innerHTML = "<p>" + casado + "</p>";
}

function ejemplo3() {
  var nombre;
  var edad;
  nombre = prompt("Ingresa tu nombre:", "");
  edad = prompt("Ingresa tu edad:", "");
  var div1 = document.getElementById("mensaje1");
  div1.innerHTML =
    "<p>Hola " + nombre + " asi que tienes " + edad + " años" + "</p>";
}
