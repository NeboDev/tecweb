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

function ejemplo4() {
  var valor1 = prompt("Introducir primer numero", "");
  var valor2 = prompt("Introducir segundo numero", "");
  var suma = parseInt(valor1) + parseInt(valor2);
  var producto = parseInt(valor1) * parseInt(valor2);
  var div1 = document.getElementById("suma");
  div1.innerHTML = "<p>La suma es " + suma + "</p>";
  var div2 = document.getElementById("producto");
  div2.innerHTML = "<p>El producto es " + producto + "</p>";
}

function ejemplo5() {
  var nombre = prompt("Ingresa tu nombre", "");
  var nota = prompt("Ingresa tu nota", "");
  if (nota >= 4) {
    var div1 = document.getElementById("mensaje2");
    div2.innerHTML = "<p>" + nombre + " esta aprobado con un " + nota + "</p>";
  }
}

function ejemplo6() {
  var num1 = prompt("Ingresa el primer numero", "");
  var num2 = prompt("Ingresa el segundo numero", "");
  num1 = parseInt(num1);
  num2 = parseInt(num2);
  var div1 = document.getElementById("comparacion");
  if (num1 > num2) {
    div1.innerHTML = "<p>El mayor es " + num1 + "</p>";
  } else {
    div1.innerHTML = "<p>El mayor es " + num2 + "</p>";
  }
}

function ejemplo7() {
  var nota1 = prompt("Ingresa 1ra. nota:", "");
  var nota2 = prompt("Ingresa 2da. nota:", "");
  var nota3 = prompt("Ingresa 3ra. nota:", "");
  nota1 = parseInt(nota1);
  nota2 = parseInt(nota2);
  nota3 = parseInt(nota3);
  var pro = (nota1 + nota2 + nota3) / 3;
  var div1 = document.getElementById("promedio");
  if (pro >= 7) {
    div1.innerHTML = "<p>Aprobado</p>";
  } else {
    if (pro >= 4) {
      div1.innerHTML = "<p>Regular</p>";
    } else {
      div1.innerHTML = "<p>Reprobado</p>";
    }
  }
}

function ejemplo8() {
  var valor = prompt("Ingresar un valor comprendido entre 1 y 5:", "");
  valor = parseInt(valor);
  var div = document.getElementById("casos");
  switch (valor) {
    case 1:
      div.innerHTML = "<p>uno</p>";
      break;
    case 2:
      div.innerHTML = "<p>dos</p>";
      break;
    case 3:
      div.innerHTML = "<p>tres</p>";
      break;
    case 4:
      div.innerHTML = "<p>cuatro</p>";
      break;
    case 5:
      div.innerHTML = "<p>cinco</p>";
      break;
    default:
      div.innerHTML = "<p>Debe ingresar un valor comprendido entre 1 y 5.</p>";
  }
}

function ejemplo9() {
  var col = prompt(
    "Ingresa el color con que quieres pintar el fondo de la ventana (rojo, verde, azul):",
    ""
  );
  var div = document.getElementById("mensaje3");
  switch (col) {
    case "rojo":
      document.body.style.backgroundColor = "#ff0000";
      div.innerHTML = "<p>Fondo cambiado a rojo</p>";
      break;
    case "verde":
      document.body.style.backgroundColor = "#00ff00";
      div.innerHTML = "<p>Fondo cambiado a verde</p>";
      break;
    case "azul":
      document.body.style.backgroundColor = "#0000ff";
      div.innerHTML = "<p>Fondo cambiado a azul</p>";
      break;
    default:
      div.innerHTML = "<p>Color no reconocido. Usa rojo, verde o azul.</p>";
  }
}

function ejemplo10() {
  var x = 1;
  var resultado = "";
  var div = document.getElementById("resultado");
  while (x <= 100) {
    resultado += x + "<br>";
    x = x + 1;
  }
  div.innerHTML = resultado;
}

function ejemplo11() {
  var x = 1;
  var suma = 0;
  var valor;
  var div = document.getElementById("sumaRepeticion");
  while (x <= 5) {
    valor = prompt("Ingresa el valor:", "");
    valor = parseInt(valor);
    suma = suma + valor;
    x = x + 1;
  }
  div.innerHTML = "<p>La suma de los valores es " + suma + "</p>";
}
function ejemplo12() {
  var resultado = "";
  var valor;
  var div = document.getElementById("resultadoDoWhile");
  do {
    valor = prompt("Ingresa un valor entre 0 y 999:", "");
    valor = parseInt(valor);

    resultado += "El valor " + valor + " tiene ";

    if (valor < 10) {
      resultado += "1 dígito";
    } else if (valor < 100) {
      resultado += "2 dígitos";
    } else if (valor < 1000) {
      resultado += "3 dígitos";
    } else {
      resultado += "más de 3 dígitos";
    }
    resultado += "<br>";
  } while (valor !== 0);

  div.innerHTML = resultado;
}

function ejemplo13() {
  var f;
  var resultado = "";
  var div = document.getElementById("resultadoFor");
  for (f = 1; f <= 10; f++) {
    resultado += f + " ";
  }
  div.innerHTML = "<p>" + resultado + "</p>";
}
