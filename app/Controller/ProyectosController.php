<?php

class ProyectosController extends Controller
{

    public function __construct()
    {
    }


    public function ConsultarCompania()
    {

        $this->modelo('ConsultaCompania');
        $search_compania = new ConsultaCompania();
        $resul = $search_compania->ListaCompania();


        $this->vista('registro/registro', $resul);
    }




    public function CrearP()
    {

        $resultado = ["nombre_usuario" => $_POST["nombre_usuario"], "id_usuario" => $_POST["id_usuario"]];
        $resultado2 = ["nombre_compania" => $_POST["nombre_compania"], "id_compania" => $_POST["id_compania"]];




        $this->modelo("RegistroProyectos");
        $listado_proyecto = new RegistroProyectos();
        $resultado3 = $listado_proyecto->ListadoProyecto($resultado2["id_compania"]);
        $datos = [

            "resultado" => $resultado,
            "id_compania" => $resultado2,
            "resultado3" => $resultado3
        ];


        $this->vista('proyectos/crearProyectos', $datos);
    }


    public function RegistroUsuario($datos)
    {


        $datos = [
            "nombre" => $_POST['nombre'],
            "id_compania" => $_POST['id_compania'],
            "usuario" => $_POST['usuario'],
            "contrasena" => $_POST['contrasena'],
        ];



        $this->modelo('RegistroUsuarios');
        $ingresar_usuario = new RegistroUsuarios();
        $resultado_ingreso_user = $ingresar_usuario->IngresarUsuario($datos);



        if ($resultado_ingreso_user == true) {


            echo "<script>
        alert('Los datos se insertaron correctamente');
        </script>";

            $this->vista('index/index');
        } else {


            echo "<script>
        alert('El Nombre de Usuario ya existe en el Sistema, por favor intenta con otro');
        </script>";

            $this->vista('registro/registro');
        }
    }


    public function LoginUser($datos)
    {
        $datos_usuario = [
            "usuario" => $_POST["usuario"],
            "contrasena" => $_POST["contrasena"]
        ];


        $this->modelo("RegistroUsuarios");
        $login_usuario = new RegistroUsuarios();
        $resultado_login = $login_usuario->LoginUsuario($datos_usuario);


        if ($resultado_login["validacion"] == "si") {

            $this->vista('proyectos/crearProyectos', $resultado_login);
        }
        if ($resultado_login["validacion"] == "no") {
            echo "<script>
        alert('Esta cuenta no existe, por favor registrate y vuelve a loguearte');
        </script>";
            $this->vista('index/index');
        }
        if ($resultado_login["validacion"] == "error") {
            echo "<script>
        alert('La contraseña no coincide con el Usuario proporcionado');
        </script>";

            $this->vista('index/index');
        }
    }


    public function AddProyect()
    {
        $nombre_p = $_POST["nombre_proyecto"];
        $historia_u = $_POST["historia"];
        $numero_tickets = $_POST["n_tickets"];
        $id_compania = $_POST["id_company"];
        $id_usuario = $_POST["id_usuario"];
        $newp = $_POST["newp"];
        $tickets = [];
        $coment_t = [];
        for ($i = 1; $i <= $numero_tickets; $i++) {
            $tickets[$i - 1] = $_POST["ticket"][$i - 1];
            $coment_t[$i - 1] = $_POST["coment_t"][$i - 1];
        }
        $datos = [
            "ticket" => $tickets,
            "coment" => $coment_t,
            "historia" => $historia_u,
            "nombre_p" => $nombre_p,
            "id_compania" => $id_compania,
            "id_usuario" => $id_usuario,
            "numero_t" => $numero_tickets,
            "newp" => $newp
        ];

        $this->modelo("RegistroProyectos");
        $nuevo_proyecto = new RegistroProyectos();
        $resultado_login = $nuevo_proyecto->IngresarProyecto($datos);
    }


    public function ProyectList($datos)
    {

        $id_compania = $_POST["id_compania"];
        $nombre_compania = $_POST["nombre_compania"];
        $nombre_usuario = $_POST["nombre_usuario"];
        $id_usuario = $_POST["id_usuario"];


        $this->modelo("RegistroProyectos");
        $listado_proyecto = new RegistroProyectos();
        $resultado = $listado_proyecto->ListadoProyecto($id_compania);

        $resul = [

            "resultado" => $resultado,
            "nombre_compania" => $nombre_compania,
            "nombre_usuario" => $nombre_usuario,
            "id_compania" => $id_compania,
            "id_usuario" => $id_usuario
        ];


        $this->vista('proyectos/verProyectos', $resul);
    }


    public function History()
    {
        var_dump($_POST);
        $id_proyecto = $_POST["id_proyecto"];

        $this->modelo("RegistroProyectos");
        $listado_historia = new RegistroProyectos();
        $resultado = $listado_historia->ListadoHistoriaUsuario($id_proyecto);
    }


    public function TicketList()
    {

        $id_historia = $_POST["id_historia"];

        $this->modelo("RegistroProyectos");
        $listado_ticket = new RegistroProyectos();
        $resultado = $listado_ticket->ListadoTickets($id_historia);

        return $resultado;
    }
}
