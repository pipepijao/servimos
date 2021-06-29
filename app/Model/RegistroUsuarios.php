<?php
require_once('../app/librerias/Base.php');


class RegistroUsuarios{
  
    

    public function __construct(){

      
    }

  


    public function IngresarUsuario($datos){
        $conn = Base::getConnect();

        $nombre  =$datos['nombre'];
        $usuario  =$datos['usuario'];
        $contraseña  =$datos['contrasena'];
        $id_compania  =$datos['id_compania'];
        
       $usuario_existente = $conn->query("SELECT * FROM `usuarios` WHERE `usuario`= '$usuario';");
       $numero_rows = $usuario_existente->num_rows;

       if($numero_rows > 0){

        $IngresarUsuario = $conn->query( "INSERT INTO `usuarios`(`id_usuario`, `nombre_usuario`, `id_compania`, `usuario`, `contrasena`)
         VALUES ('','$nombre',$id_compania,'$usuario','$contraseña')" ) || die("Los datos no fuero insertados, hubo un error, intenta registrarte de nuevo");

    return true;
       }else{

        return false;

       }
    } 


    public function LoginUsuario($datos){
        $conn = Base::getConnect();

        $usuario  =$datos['usuario'];
        $contraseña  =$datos['contrasena'];
        
        $validacion_usuario = $conn->query("SELECT * FROM `usuarios` WHERE `usuario`= '$usuario';");
        $numero_rows1 = $validacion_usuario->num_rows;
        $fila = mysqli_fetch_assoc($validacion_usuario);

        $id_c = $fila["id_compania"];

        $compania_id =  $conn->query("SELECT * FROM `compania` WHERE `id_compania`= $id_c;");
        $sel_compania =  mysqli_fetch_assoc($compania_id);

        $validacion_contrasena = $conn->query("SELECT * FROM `usuarios` WHERE `contrasena` = '$contraseña'");
        $numero_rows2 = $validacion_contrasena->num_rows;

        
        $resultado = [];
        if($numero_rows1 > 0 && $numero_rows2 > 0){
            $resultado = [
                "validacion"=> "si",
                "resultado"=> $fila,
                "id_compania" => $sel_compania
        
        ];

        }if($numero_rows1 > 0 && $numero_rows2 == 0){
            $resultado = [
                "validacion"=> "error"
        
        ];
        }if($numero_rows1 == 0 && $numero_rows2 > 0){
            $resultado = [
                "validacion"=> "no"
        
        ];
        }

        return $resultado;
 
    }



    }
?>