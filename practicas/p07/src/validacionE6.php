<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Ejercicio 6  - Resultado</title>
</head>
<body>
  <h1>Resultado de la Consulta de coches</h1>

  <?php
    $tipoConsulta = $_POST['tipoConsulta'];
    $matricula = $_POST['matricula'];
    $coches = array(
        "ABC1234" => array(
            "Auto" => array(
                "marca" => "Toyota",
                "modelo" => 2022,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Juan Pérez García",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Av. Juárez 123, Centro"
            )
        ),
        "XYZ5678" => array(
            "Auto" => array(
                "marca" => "Honda",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "María González López",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "C.U., Jardines de San Manuel"
            )
        ),
        "DEF9012" => array(
            "Auto" => array(
                "marca" => "Nissan",
                "modelo" => 2023,
                "tipo" => "hachback"
            ),
            "Propietario" => array(
                "nombre" => "Carlos Rodríguez Martínez",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Blvd. 5 de Mayo 456"
            )
        ),
        "GHI3456" => array(
            "Auto" => array(
                "marca" => "Ford",
                "modelo" => 2021,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Ana Sánchez Hernández",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Calz. Zavaleta 789"
            )
        ),
        "JKL7890" => array(
            "Auto" => array(
                "marca" => "Chevrolet",
                "modelo" => 2019,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Roberto Mendoza Castro",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Privada de la Luz 234"
            )
        ),
        "MNO1234" => array(
            "Auto" => array(
                "marca" => "Volkswagen",
                "modelo" => 2022,
                "tipo" => "hachback"
            ),
            "Propietario" => array(
                "nombre" => "Laura Díaz Romero",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Vía Atlixcáyotl 567"
            )
        ),
        "PQR5678" => array(
            "Auto" => array(
                "marca" => "Hyundai",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Miguel Ángel Flores",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Reserva Territorial 890"
            )
        ),
        "STU9012" => array(
            "Auto" => array(
                "marca" => "Kia",
                "modelo" => 2023,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Sofía Ramírez Torres",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Angelópolis 123"
            )
        ),
        "VWX3456" => array(
            "Auto" => array(
                "marca" => "Mazda",
                "modelo" => 2021,
                "tipo" => "hachback"
            ),
            "Propietario" => array(
                "nombre" => "Diego Cruz Mendoza",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "San Baltazar 456"
            )
        ),
        "YZA7890" => array(
            "Auto" => array(
                "marca" => "Subaru",
                "modelo" => 2019,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Elena Vargas Soto",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Cholula 789"
            )
        ),
        "BCD1234" => array(
            "Auto" => array(
                "marca" => "BMW",
                "modelo" => 2022,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Javier Morales Ruiz",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "San Pedro 234"
            )
        ),
        "EFG5678" => array(
            "Auto" => array(
                "marca" => "Mercedes-Benz",
                "modelo" => 2023,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Patricia Ortega Silva",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "San Andrés 567"
            )
        ),
        "HIJ9012" => array(
            "Auto" => array(
                "marca" => "Audi",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Fernando Reyes Castro",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "San Francisco 890"
            )
        ),
        "KLM3456" => array(
            "Auto" => array(
                "marca" => "Lexus",
                "modelo" => 2021,
                "tipo" => "hachback"
            ),
            "Propietario" => array(
                "nombre" => "Gabriela Ponce López",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "La Paz 123"
            )
        ),
        "NOP7890" => array(
            "Auto" => array(
                "marca" => "Jeep",
                "modelo" => 2022,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Ricardo Guzmán Navarro",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "Amalucan 456"
            )
        )
    );

    if ($tipoConsulta == "matricula") {
        if (isset($coches[$matricula])) {
            echo "<p'>Coche encontrado:</p>";
            print_r($coches[$matricula]);
        }
    } else {
        echo "<p'>Todos los coches:</p>";
        print_r($coches);
    }
  ?>

  <br />
</body>
</html>

