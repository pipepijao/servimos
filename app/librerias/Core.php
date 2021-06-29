<?php


class Core  {

    protected $controladorActual = 'HistorialController';
    protected $MetodoActual = 'index';
    protected $ParametroActual = [];
  

    public function __construct(){

      
        $enlace='';
       
        $url = $this->getUrl();
        $url2 = $this->getUrl2();


 if($url2){
     
     $url = NULL;
 }else{
    if($url){
        if($url[0] == 'informe'){
            $url[0] = 'DescargarExcelController';
            $url[1] = 'index';
        }
    
    }
 }       
        
    
     
        if($url !== NULL ){
           
            $enlace = $url;
           
            unset($url2);
        }elseif(isset($url2) || $url2 !== NULL){
         
            $enlace = $url2;
            unset($url);
           
        }
       
        if($enlace == ''){
            $enlace = [];
            $enlace_1 = 'cualquiera';
            $enlace[0] = $enlace_1;
          
         
        }else{
            $enlace_1 = ucwords($enlace[0]);
          
        }
      
        if(file_exists('../app/Controller/'.$enlace_1.'.php')){
            $this->controladorActual = $enlace_1;
          
            unset($enlace_1);
         

        }

        
      
        require_once '../app/Controller/'.$this->controladorActual.'.php';
        $this->controladorActual = new $this->controladorActual;
       
        if(isset($enlace[1])){
            
            if(method_exists($this->controladorActual, $enlace[1])){
                $this->MetodoActual = $enlace[1];
                unset($enlace[1]);
    
            }

        }

         
        $this->ParametroActual = $enlace ? array_values($enlace) : [];
        call_user_func_array([$this->controladorActual,$this->MetodoActual],$this->ParametroActual);
        
       
        unset($enlace);
       
    }


    public function getUrl(){
       
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);

            return $url;
        }

    }

    public function getUrl2(){
        
        if (isset($_POST['url2'])){
         
            $url2 = rtrim($_POST['url2'],'/');
            $url2 = filter_var($url2,FILTER_SANITIZE_URL);
            $url2 = explode('/',$url2);
    
            return $url2 ;
        }

    }


   
  

}

?>