<?php
require_once('../app/librerias/Base.php');


class RegistroProyectos{
  
    

    public function __construct(){

      
    }

  


    public function IngresarProyecto($datos){
        $conn = Base::getConnect();

       

        $nombre_p =   $datos["nombre_p"] ;
        $historia_u = $datos["historia"] ;
        $tickets = $datos["ticket"] ;
        $coment_t = $datos["coment"] ;
        $id_compania = $datos["id_compania"];
        $id_usuario =  $datos["id_usuario"] ;
        $numero_tickets = $datos["numero_t"];
        $newp = $datos["newp"];

        $id_proyecto ='';
        if($newp == 0){
            $newproyect = $conn->query("INSERT INTO `proyectos`(`id_proyecto`, `nombre_proyecto`) VALUES ('','$nombre_p');");
            $id_proyecto =$conn->query("SELECT MAX(id_proyecto) AS id_proyecto FROM `proyectos`");
            $fila1 = mysqli_fetch_assoc($id_proyecto);
            $id_proyecto = $fila1["id_proyecto"];
        }else{

            $id_proyecto = $nombre_p;
            
        }

      

      
        $newhistoria = $conn->query( "INSERT INTO `historia`(`id_historia`, `nombre_historia`) VALUES ('','$historia_u')" ) ;
        $id_historia =$conn->query("SELECT MAX(id_historia) AS id_historia FROM `historia`");
       $fila2 = mysqli_fetch_assoc($id_historia);

       $id_historia =$fila2["id_historia"];
      
       for($count = 0; $count < $numero_tickets ;$count++){
        $tickete = $tickets[$count];
        $comentario = $coment_t[$count];
        $newhistoria = $conn->query( "INSERT INTO `tickets`(`id_ticket`, `nombre_solicitud`, `comentario`, `id_status`, `id_historia`, `id_proyecto`, `id_compania`, `id_usuario`) 
        VALUES ('','$tickete','$comentario',1,$id_historia,$id_proyecto,$id_compania,$id_usuario)"); 
    }   


    


   
    }

    public function ListadoProyecto($datos){

        $conn = Base::getConnect();

   

        $id_compania = $datos;

        
        $proyectos =$conn->query("SELECT proyectos.* FROM `proyectos` INNER JOIN tickets on proyectos.id_proyecto = tickets.id_proyecto WHERE tickets.id_compania = $id_compania GROUP BY proyectos.id_proyecto;");
        $numero_rows1 = $proyectos->num_rows;
    
        $proyects = [] ;
        $i = 0;
        while($fila = mysqli_fetch_assoc($proyectos)){
            
            $proyects[$i] = $fila;
            $i++;
        }

            $resultados =[
                "resultado" => $proyects,
                "row" => $numero_rows1
    
            ];
             return($resultados);

    }


    public function ListadoHistoriaUsuario($datos){

        $conn = Base::getConnect();

        $id_proyecto = $datos;

        
        $proyectos =$conn->query("SELECT historia.* FROM `historia` INNER JOIN tickets on historia.id_historia = tickets.id_historia WHERE tickets.id_proyecto = $id_proyecto GROUP BY historia.id_historia;");
        $numero_rows1 = $proyectos->num_rows;
    
        $histories = [] ;
        $i = 0;
        while($fila = mysqli_fetch_assoc($proyectos)){
            
            $histories[$i] = $fila;
            $i++;
        }

            $resultados =[
                "resultado" => $histories,
                "row" => $numero_rows1
    
            ];

            
             return($resultados);

    }





    public function ListadoTickets($datos){

        $conn = Base::getConnect();

        $id_historia = $datos;

        
        $tiquete =$conn->query("SELECT * FROM `tickets`  WHERE id_historia = $id_historia ;");
        $numero_rows1 = $tiquete->num_rows;
    
        $tickets = [] ;
        $i = 0;
        $status_id =[];
        
        while($fila = mysqli_fetch_assoc($tiquete)){
            
            $tickets[$i] = $fila;
            
            $id_ticket = $tickets[0]["id_status"];
            $status =$conn->query("SELECT * FROM `status_ticket`  WHERE id_status = $id_ticket;");
            $f = mysqli_fetch_assoc($status);
            $status_id[$i] = $f ;
            $i++;
        }

            $resultados =[
                "resultado" => $tickets,
                "row" => $numero_rows1,
                "status" => $status_id
    
            ];
             return($resultados);

    }


    public function ActualizarTicket($datos){

        $id_ticket = $datos["id_ticket"];
        $nombre_ticket =$datos["nombre_ticket"];
        $comentario =$datos["comentario"];
        $id_status = $datos["id_status"];

        $conn = Base::getConnect();

        $tiquete =$conn->query("UPDATE `tickets` SET `nombre_solicitud`='$nombre_ticket',`comentario`='$comentario',`id_status`=$id_status WHERE id_ticket = $id_ticket");

        
    }


    public function EliminarTicket($datos){

        $id_ticket = $datos;

        $conn = Base::getConnect();

        $tiquete =$conn->query("DELETE FROM `tickets` WHERE id_ticket = $id_ticket;");


    }



    }
?>