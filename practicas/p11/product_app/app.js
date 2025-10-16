// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO A BUSCAR
    var patronBusqueda = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL ARRAY DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);
            
            // SE VERIFICA SI EL ARRAY JSON TIENE DATOS
            if(Object.keys(productos).length) {
                let template = '';
                
                // SE ITERA SOBRE CADA PRODUCTO ENCONTRADO
                productos.forEach(function(producto) {
                    // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                    // SE CREA UNA FILA POR CADA PRODUCTO
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("patronBusqueda=" + patronBusqueda);
}

function agregarProducto(e) {
    e.preventDefault();

    // ARRAY PARA ALMACENAR TODOS LOS ERRORES
    var errores = [];

    // OBTENER VALORES
    var nombre = document.getElementById('name').value;
    var productoJsonString = document.getElementById('description').value;


    // Validar que el JSON sea un formato valido por si se equivoca el usuario
    try {
        var finalJSON = JSON.parse(productoJsonString);
    } catch (error) {
        alert("El formato JSON de la descripcion no es valido, se reestablecera");
        document.getElementById('description').focus();
        var JsonString = JSON.stringify(baseJSON,null,2);
        document.getElementById("description").value = JsonString;
        return false;
    }

    // VALIDACIONES DEL NOMBRE
    if (nombre.trim() === "") {
        errores.push("- El nombre del producto es obligatorio");
    } else if (nombre.length > 100) {
        errores.push("- El nombre debe ser ≤ 100 caracteres");
    }
    
    // Validar marca
    if (!finalJSON.marca || finalJSON.marca === "NA"|| finalJSON.marca.trim() === "") {
        errores.push("- La marca es obligatoria");
    }

    // Validar modelo
    if (!finalJSON.modelo || finalJSON.modelo === "XX-000" || finalJSON.modelo.trim() === "") {
        errores.push("- El modelo es requerido");
    } else if (finalJSON.modelo.length > 25) {
        errores.push("- El modelo debe ser ≤ 25 caracteres");
    }

    // Validar precio
    var precio = parseFloat(finalJSON.precio);
    if (isNaN(precio) || precio <= 99.99) {
        errores.push("- El precio debe ser mayor a 99.99");
    }

    // Validar unidades
    var unidades = parseInt(finalJSON.unidades);
    if (isNaN(unidades) || unidades < 0) {
        errores.push("- Las unidades deben ser ≥ 0");
    }

    // Validar detalles
    if (finalJSON.detalles && finalJSON.detalles.length > 250) {
        errores.push("- Los detalles no pueden tener mas de 250 caracteres");
    }

    // Asignar imagen por defecto si esta vacio el campo
    if (!finalJSON.imagen || finalJSON.imagen.trim() === "") {
        finalJSON.imagen = "img/imagen.png";
    }

    // SI HAY ERRORES SE MUESTRAN EN EL ALERT
    if (errores.length > 0) {
        var mensajeError = "Por favor, corrige los siguientes errores:\n\n" + errores.join('\n');
        alert(mensajeError);
        return false;
    }


    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = nombre;
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            var respuesta = JSON.parse(client.responseText);
             if (respuesta.status === 'success') { //SI SE PUDO AGREGAR
                alert(respuesta.message);
                // Limpiar el formulario despues de agregar
                document.getElementById('name').value = '';
                document.getElementById('description').value = JSON.stringify(baseJSON, null, 2);
            } else {
                //NO SE PUEDO AGREGAR
                alert('Error\n'+respuesta.message);
            }
        }
    };
    client.send(productoJsonString);
    
    return true;
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}