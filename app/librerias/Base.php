<?php



class Base{

    private $enlace;

    public function __construct(){}


    public static function getConnect(){

			$dbhost='localhost'; //aqui va el nombre del host
			$dbuser='root'; //aqui el nombre del usuario si hubiera
			$dbpass='';//aqui la contraseña del usuario si hubiera
			$dbname='servimos'; //aqui el nombre de la base de datos

			//Crear conexion 

			$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

			return $conn;

    }

}