<?php 
     $serverName ="WIN-CEARVOQ7M2N\SQLEXPRESS"; 
     $password = ""; 
     $userId ="";
     $database = "dbonlinelearning";
     $connectionInfo = array( "Database"=>$database, "UID"=> $userId,  "PWD"=>$password,"CharacterSet" => "UTF-8"); 
     $conn = sqlsrv_connect( $serverName, $connectionInfo);
     if( ! $conn ) { 
          die( print_r( sqlsrv_errors(), true)); 
     } 
     // else {
     //      echo "Connected successfully."; 
     // }

 

?> 

