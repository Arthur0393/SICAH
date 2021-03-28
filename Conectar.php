<?php
//function conectarBD()
//{
//		mysql_connect("localhost", "root", "*123");
//	mysql_select_db("siseac");
//        mysql_set_charset('utf8');
//}
//
//function desconectarBD()
//{
//	mysql_close();
//}
/* Clase encargada de gestionar las conexiones a la base de datos */
Class Db{

   private $servidor='localhost';
   private $usuario='uttlaxca_siseac';
   private $password='siseac2014';
   private $base_datos='uttlaxca_siseac';
   //private $link;
   //private $stmt;
   //private $array;
   private $conexion;

   //static $_instance;

   /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
   public function __construct(){
      $this->conectarBD();
   }

   /*Evitamos el clonaje del objeto. Patrón Singleton*/
   //private function __clone(){ }

   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
   //public static function getInstance(){
   //   if (!(self::$_instance instanceof self)){
   //      self::$_instance=new self();
   //   }
   //   return self::$_instance;
   //}

   /*Realiza la conexión a la base de datos.*/
   private function conectarBD(){
      //$this->link=mysql_connect($this->servidor, $this->usuario, $this->password);
      //mysql_select_db($this->base_datos,$this->link);
      //@mysql_query("SET NAMES 'utf8'");
      $this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);
      $this->conexion->set_charset('utf8');
   }

   public function getConexion()
   {
      return $this->conexion;
   }
   /*Método para ejecutar una sentencia sql*/
   /*public function ejecutar($sql){
      $this->stmt=mysql_query($sql,$this->link);
      return $this->stmt;
   }*/

   /*Método para obtener una fila de resultados de la sentencia sql*/
   /*public function obtener_fila($stmt,$fila){
      if ($fila==0){
         $this->array=mysql_fetch_array($stmt);
      }else{
         mysql_data_seek($stmt,$fila);
         $this->array=mysql_fetch_array($stmt);
      }
      return $this->array;
   }*/

   //Devuelve el último id del insert introducido
   //public function lastID(){
   //   return mysql_insert_id($this->link);
   //}

}


?>
