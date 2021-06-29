<?php
require_once('../app/librerias/Base.php');


class ConsultaCompania{
  
    

    public function __construct(){

      
    }

    public function ListaCompania(){

        $conn = Base::getConnect();
        $lis_company = $conn->query( "SELECT * FROM `compania`" );
        $max = $lis_company->num_rows;
        $nombres = [] ;
    $i = 0;
    while($fila = mysqli_fetch_assoc($lis_company)){
        
        $nombres[$i] = $fila;
        $i++;
    }
        $resultados =[
            "resultado" => $nombres,
            "row" => $max

        ];
         return($resultados);
   
    }


 
    }
?>