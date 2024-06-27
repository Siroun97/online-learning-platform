<?php require('localConnection.php') ;  ?><?php 
		
	$status =  $_REQUEST["status"];
	
	if ($status == "one" )
	{
		$id = $_REQUEST["id"];
		$query = "select * from portal where portalId=$id"   ;
		$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		echo json_encode($arr);
		return;
	}

	


	if ($status == "select" )
		{
			$query = "select * from portal " ;
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
				
			$arr = array();
			
			while ($row = sqlsrv_fetch_Object($result))
			{
				$arr[] = $row;
			}
			echo json_encode($arr);
			return;
		}

	if($status=="delete") 
		{
			$id = $_REQUEST["id"];
			$query = "delete from portal where portalId=$id" ;
			$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;  
			echo json_encode("Record has been deleted.");
			return ; 
		}
	
	$portalName= addslashes($_REQUEST["portalName"]);
	$isActive= addslashes($_REQUEST["isActive"]);

	if ($status == "new")
	{
		$query = "insert into portal  (portalName,isActive)  values (N'$portalName','$isActive');select SCOPE_IDENTITY()";
		$result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_next_result($result);
		sqlsrv_fetch($result);
        $id = sqlsrv_get_field($result , 0);
        $arr['portalId'] = $id;
        echo json_encode($arr);
        return;
	
	} 

	if ($status == "update")
	{ 
		$result = "";
		$id = $_REQUEST["id"];
		$query = "update portal set portalName= N'$portalName', isActive='$isActive' where portalId = $id";
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		$result = "Updated successfuly";
		echo json_encode($result);
	}
?>
				
