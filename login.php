<?php 
  session_start();
  // connect  server 
  //include ('config/config.php');
  //  connect database .
  $hostname = "localhost";
  $username = "uttlaxca_siseac";  // local Username
  $password = "siseac2014"; // local Password
  $dbname = "uttlaxca_siseac"; // DB name
  $prefix_table="01_";

  $con = new mysqli($hostname, $username, $password, $dbname);
  $con->set_charset('utf8');

  if(isset($_POST["username"]) and isset($_POST["password"])){
    sleep(1);
    $pass_login=$_POST["password"];
    // $pass_login=md5($_POST["password"]);  if use md5 encode 
    $sql = "SELECT * FROM " .$prefix_table."user  where  username='".$_POST["username"]."' and password='".$pass_login."' ";
    $result = $con->query($sql);

    if($result->num_rows == 0){ 
      $return_arr["status"] = 0;	
      echo json_encode($return_arr); // return value 
    }else{
      $row = $result->fetch_assoc();
       
      $_SESSION["account_name"]=$row["username"];	// create SESSION  
      $_SESSION["tipo_usuario"]=$row["tipo_usuario"];	// create SESSION  
      $_SESSION["email"]=$row["email"]; // create SESSION  
      $_SESSION["estatus"]=$row["estatus"]; // create SESSION  
      $_SESSION["foto"]=$row["fotos"]; // create SESSION  		
      
      $return_arr["status"] = 1;		 
      echo json_encode($return_arr); // return value 
    }  //end else
    exit();
  }
?>