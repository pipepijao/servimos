<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/assets/css/proyectos.css">
    <title>Proyectos</title>
</head>

<body>
    <div class="contenedor">
        <div class="menu">
            <div class="usuario">
                <div>
                    <h3><?php echo $datos["nombre_usuario"] ?></h3>
                    <h4><?php echo $datos["nombre_compania"] ?></h4>
                </div>
            </div>


            <div class="s_menu">
                <form id="ver_proyecto_form" method="post">
                    <input hidden value="<?php echo $datos["id_compania"] ?>" name="id_compania">
                    <input hidden value="<?php echo $datos["nombre_usuario"] ?>" name="nombre_usuario">
                    <input hidden value="<?php echo $datos["nombre_compania"] ?>" name="nombre_compania">
                    <input hidden value="<?php echo $datos["id_usuario"] ?>" name="id_usuario">
                    <input hidden value="ProyectosController/CrearP" name="url2">
                    
                    <div class="sec_menu ver_p">
                        <img src="<?php echo RUTA_URL ?>/assets/images/ojo.png">
                        <p>Crear Proyectos</p>

                    </div>
                </form>
            </div>
        </div>
        <div class="modulos">
            <h1>Proyectos</h1>
            <p>Selecciona el proyecto para que se desplegue las historias de usuario</p>
            <form>
                <select id="id_proyecto" class="id_proyecto_g" name="id_proyecto">
                    <?php
                    $count = $datos["resultado"]["row"];
                    for ($i = 0; $i < $count; $i++) {
                    ?>
                        <option value="<?php echo $datos["resultado"]["resultado"][$i]["id_proyecto"] ?>"><?php echo $datos["resultado"]["resultado"][$i]["nombre_proyecto"] ?></option>
                    <?php  } ?>

                </select>
                <button id="seleccionar_proyecto" type="button">Seleccionar</button>
            </form>
            <h2>Historias de Usuario</h2>
            <div id="historia_usuario"> </div>

            <div id="tickets_u">
                <h2>Tickets</h2>
                <table id="tickets_usuario" class="tftable" border="1">
                    <tr>
                        <th>Ticket</th>
                        <th>Comentario</th>
                        <th>Status</th>
                        <th>Nuevo Status</th>
                        <th>Actualizar/eliminar</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <script src="<?php echo RUTA_URL ?>/assets/js/bootstrap/jquery-3.5.1.min.js"></script>

    <script>
        $("#seleccionar_proyecto").click(function() {

            $("#historia_usuario").empty();

            let id_proyecto = $("#id_proyecto").val();
            $("#historia_usuario").empty();
            $.ajax({
                type: "POST",
                url: '../ModificarProyectosController/History',

                data: {
                    id_proyecto: id_proyecto,
                },
                success: function(respuesta) {

                    var data = JSON.parse(respuesta)

                    console.log(data);

                    for (let ch = 0; ch < data.row; ch++) {
                        $("#historia_usuario").append("<br><div id='historia" + ch + "' class='histories'>\
                        <p>" + data.resultado[ch].nombre_historia + "</p>\
                         <input type='text' name='id_historia' hidden value='" + data.resultado[ch].id_historia + "'></div>")
                        }
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });

        $(document).on('click', '.histories', function() {
            let id = this.id;
            let id_historia = $("#" + id).find('input').val();
            $("#tickets_usuario").empty();
            $("#tickets_usuario").append(" <tr>\
                        <th>Ticket</th>\
                        <th>Comentario</th>\
                        <th>Status</th>\
                        <th>Nuevo Status</th>\
                        <th>Actualizar/eliminar</th>\
                    </tr>");
            $.ajax({
                type: "POST",
                url: '../ModificarProyectosController/TicketList',

                data: {
                    id_historia: id_historia,
                },
                success: function(respuesta) {

                    var data = JSON.parse(respuesta)

                    console.log(data);

                    for (let ch = 0; ch < data.row; ch++) {
                        $("#tickets_usuario").append("<tr ticket_empty id='ticket" + ch + "'>\
                        <td> \
                         <input class='nombre_tickets' name='nombre_ticket' placeholder='" + data.resultado[ch].nombre_solicitud + "' value='" + data.resultado[ch].nombre_solicitud + "' > \
                         <input hidden class='id_ticket' type='text' name='id_ticket'   value='" + data.resultado[ch].id_ticket + "'>\
                         <input hidden class='id_status' name=''id_status value='" + data.resultado[ch].id_status + "'   ></td>\
                         <td> <textarea class='comentario' type='text' name='comentario' value='" + data.resultado[ch].comentario + "'>" + data.resultado[ch].comentario + "</textarea></td>\
                         <td><p>" + data.status[ch].nombre_status + "</p></td> \
                         <td><select class='new_status' name='new_status'><option value='0'></option><option value='1'>Activo</option><option value='2'>En proceso</option><option value='3'>Finalizado</option><option value='4'>Cancelado</option></select></td>\
                         <td><button value='ticket" + ch + "' class='verde'>\
                         <img src='<?php echo RUTA_URL ?>/assets/images/recargar.svg'></button>\
                         <button value='ticket" + ch + "' class='rojo'>\
                         <img src='<?php echo RUTA_URL ?>/assets/images/eliminar.png'></button></td></tr>")
                    }

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        });


        $(document).on('click', '.verde', function() {

            let id_campo = $(this).attr("value");
            let id_ticket = $("#" + id_campo + " td").find("input.id_ticket").val();
            let nombre_ticket = $("#" + id_campo + " td").find("input").val();
            let comentario = $("#" + id_campo).find("td").find("input.comentario").val();
            let status = $("#" + id_campo).find("td").find("input.id_status").val();
            let newstatus = $("#" + id_campo).find("td").find("select.new_status").val();
            let id_status = 0;
            if (newstatus == 0) {
                id_status = status;
            } else {
                id_status = newstatus;
            }
            console.log(id_ticket);
            console.log(nombre_ticket);
            console.log(comentario);
            console.log(status);
            console.log(newstatus);


            $.ajax({
                type: "POST",
                url: '../ModificarProyectosController/UpdateTicekt',

                data: {
                    id_ticket: id_ticket,
                    nombre_ticket: nombre_ticket,
                    comentario: comentario,
                    id_status,
                    id_status
                },
                success: function(respuesta) {

                    var data = JSON.parse(respuesta)

                    console.log(data);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });

        $(document).on('click', '.rojo', function() {
            let id_campo = $(this).attr("value");
            let id_ticket = $("#" + id_campo + " td").find("input.id_ticket").val();
            $.ajax({
                type: "POST",
                url: '../ModificarProyectosController/Deleteticket',

                data: {
                    id_ticket: id_ticket,
                },
                success: function(respuesta) {
                    var data = JSON.parse(respuesta)
                    console.log(data);
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });
        $("#ver_proyecto_form").click(function() {

            $("#ver_proyecto_form").submit();

        });
    </script>
</body>



</html>