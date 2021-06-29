<?php

class Controller  {
   
     public function modelo($modelo){
      
        require_once '../app/Model/'.$modelo.'.php';
        return new $modelo();

     }

     public function vista ($vista,$datos =[]){
     
        if(file_exists('../app/Views/'.$vista.'.php')|| file_exists('../app/Views/'.$vista.'.html')){

            if(file_exists('../app/Views/'.$vista.'.php')){
                
            require_once '../app/Views/'.$vista.'.php';
            }else{
                
            require_once '../app/Views/'.$vista.'.html';
            }
            
           
        }else{
            ?>
            <script>
            alert('Hubo un error de vista');
            </script>
                
                <?php

        }
     }
}