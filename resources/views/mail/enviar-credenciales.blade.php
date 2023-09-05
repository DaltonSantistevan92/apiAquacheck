<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <style>
        h1{
            color: black;
        }
    </style>
</head>
<body>
    <!-- <h1>enviado correctamente</h1> -->

    <h1>Hola, {{ $name }}</h1>
    <p>Aquí tienes tus credenciales de acceso para la Aplicación Móvil - Aquacheck</p>

    <!-- <p><strong>Correo electrónico:</strong> {{ $email }}</p> -->
    <p><strong>Usuario : </strong> {{ $usuario }}</p>
    <p><strong>Contraseña : </strong> {{ $password }}</p>
    <p>Por favor, cambia tu contraseña después de iniciar sesión.</p>
</body>
</html>
