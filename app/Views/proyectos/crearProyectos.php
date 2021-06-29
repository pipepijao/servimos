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
                    <h3><?php echo $datos["resultado"]["nombre_usuario"] ?></h3>
                    <h4><?php echo $datos["id_compania"]["nombre_compania"] ?></h4>
                </div>
            </div>


            <div class="s_menu">
                <form id="ver_proyecto_form" method="post" >
                    <input hidden value="<?php echo $datos["id_compania"]["id_compania"] ?>" name="id_compania">
                    <input hidden value="<?php echo $datos["resultado"]["nombre_usuario"] ?>" name="nombre_usuario">
                    <input hidden value="<?php echo $datos["id_compania"]["nombre_compania"] ?>" name="nombre_compania">
                    <input hidden value="<?php echo $datos["resultado"]["id_usuario"] ?>" name="id_usuario">
                    <input hidden value="ProyectosController/ProyectList" name="url2">
                    <div class="sec_menu ver_p">
                        <img src="<?php echo RUTA_URL ?>/assets/images/ojo.png">
                        <p>Ver/Modificar Proyectos</p>

                    </div>
                </form>


            </div>


        </div>
        <div class="modulos">
            <div class="crear_proyectos">
                <form method="POST">
                    <div id="proyectos">
                        <h2>Crear Proyectos</h2>

                    <p>Elige un proyecto para agregarle historias de usuario y tickets o crea un nuevo proyecto</p><br>
                        <select id="p_se_c" name="select_cp">
                         <option value="0">Seleccione un proyecto..</option>
                        <?php
                    $count = $datos["resultado3"]["row"];
                    for ($i = 0; $i < $count; $i++) {
                    ?>
                        <option value="<?php echo $datos["resultado3"]["resultado"][$i]["id_proyecto"] ?>"><?php echo $datos["resultado3"]["resultado"][$i]["nombre_proyecto"] ?></option>
                    <?php  } ?>


                        </select>
                        <br>
                        <br>
                        <br>
                        <input type="text" id="nombre_proyecto" placeholder="Nombre del proyecto" name="nombre_proyecto">
                       
                    </div>

                    <div id="historia_usuario">
                        <h2>Crear historia Usuario</h2>
                        <input type="text" id="historia" placeholder="Nombre de la Historia de Usuario" name="historia">
                    </div>


                    <div id="ticket">
                        <h2>Crear Ticket</h2>
                        <div class="ticket_add ">
                            <input type="text" id="ticket1" placeholder="Nombre del Ticket" name="ticket1">
                            <input type="text" id="coment_t1" placeholder="Comentario" name="coment_t1">
                        </div>
                        <button type="button" class="adicionar">+</button>


                    </div>

                    <button type="button" id="crear_proyecto">Crear</button>
                </form>
            </div>

        </div>

    </div>


    <script src="<?php echo RUTA_URL ?>/assets/js/bootstrap/jquery-3.5.1.min.js"></script>

    <script>
        const id_compania = <?php echo $datos["id_compania"]["id_compania"] ?>;
        const id_usuario = <?php echo $datos["resultado"]["id_usuario"] ?>;
        let ticket = 1;
        let con_ticket = 2;
        $(".adicionar").click(function() {
            $(".ticket_add").append("<br><input type='text' id='ticket" + con_ticket + "' placeholder='Nombre del Ticket' name='ticket" + con_ticket + "'> <input type='text' id='coment_t" + con_ticket + "' placeholder='Comentario' name='coment_t" + con_ticket + "'>");
            ticket++;
        });



        $("#crear_proyecto").click(function() {
            let nombre_proyecto;
            let newp = 0;
            let i_proyecto = $("#nombre_proyecto").val();
            let s_p = $("#p_se_c").val();
            if(s_p == 0){
                nombre_proyecto = i_proyecto;
            }else{
                nombre_proyecto = s_p;
                newp = 1;
            }
            let historia = $("#historia").val();
            let tick = [];
            let coment = [];
            for (let contador = 1; contador <= ticket; contador++) {

                tick[contador - 1] = $("#ticket" + contador).val();
                coment[contador - 1] = $("#coment_t" + contador).val();
            }

            $.ajax({
                type: "POST",
                url: 'ProyectosController/AddProyect',
                data: {
                    nombre_proyecto: nombre_proyecto,
                    historia: historia,
                    ticket: tick,
                    coment_t: coment,
                    n_tickets: ticket,
                    id_company: id_compania,
                    id_usuario: id_usuario,
                    newp : newp

                },

                dataType: 'text',
                success: function(respuesta) {

                    console.log(respuesta);
                    alert("Datos guardados exitosamente");
                    location.reload();

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