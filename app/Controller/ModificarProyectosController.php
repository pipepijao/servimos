<?php

class ModificarProyectosController extends Controller
{

    public function __construct()
    {
    }


 

    public function History($datos)
    {
       
        $id_proyecto = $_POST["id_proyecto"];

        $this->modelo("RegistroProyectos");
        $listado_historia = new RegistroProyectos();
        $resultado = $listado_historia->ListadoHistoriaUsuario($id_proyecto);

        echo json_encode($resultado);
    }


    public function TicketList()
    {

        $id_historia = $_POST["id_historia"];

        $this->modelo("RegistroProyectos");
        $listado_ticket = new RegistroProyectos();
        $resultado = $listado_ticket->ListadoTickets($id_historia);
        echo json_encode($resultado);

     
    }

    public function UpdateTicekt(){
        $id_ticket = $_POST["id_ticket"];
        $comentario = $_POST["comentario"];
        $nombre_ticket = $_POST["nombre_ticket"];
        $id_status = $_POST["id_status"];

        $datos=[

            "id_ticket" => $id_ticket ,
            "comentario" => $comentario,
            "nombre_ticket" => $nombre_ticket,
            "id_status" => $id_status

        ];

        $this->modelo("RegistroProyectos");
        $listado_ticket = new RegistroProyectos();
        $resultado = $listado_ticket->ActualizarTicket($datos);
        echo json_encode($resultado);

    }


    public function Deleteticket(){
        $id_ticket = $_POST["id_ticket"];

        $this->modelo("RegistroProyectos");
        $listado_ticket = new RegistroProyectos();
        $resultado = $listado_ticket->EliminarTicket($id_ticket);
        echo json_encode($resultado);
    }



}
