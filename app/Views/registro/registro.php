<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro de usuario</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/assets/css/registro.css">
    <script src='main.js'></script>
</head>

<body>
    <div id="contenedor">
        <div class="registro_usuario">
            <form method="POST" action="ProyectosController/RegistroUsuario">

            <h1>Registro de Usuarios</h1>
            <h3>Ingresa los datos y quedaras registrado para acceder al sistema de gestion de proyectos</h3>
               <input id="nombre_usuario" type="text" placeholder="Nombre completo" name="nombre">
                <select id="compania" name="id_compania">
                    <?php
                    $count = $datos["row"];
                    $listado = $datos["resultado"];
                    for ($i = 0; $i < $count; $i++) {
                    ?>
                        <option value="<?php echo $listado[$i]['id_compania']; ?>"><?php echo $listado[$i]['nombre_compania']; ?></option>
                    <?php  } ?>
                </select>
                <input id="user" type="text" placeholder="Usuario" name="usuario">
                <input id="password" type="password" placeholder="Cotraseña" name="contrasena">
                <button type="submit">Registrarse</button>
            </form>

        </div>

        <div class="servimos_bienvenida">
            <div class="fondo"></div>
        </div>
    </div>
</body>

</html>