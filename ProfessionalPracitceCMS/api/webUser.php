<?php require('localConnection.php') ;  ?><?php 
		
	$status =  $_REQUEST["status"];
	
	if ($status == "one" )
	{
		$id = $_REQUEST["id"];
		$query = "select * from TB_User where UserID=$id"   ;
			$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		echo json_encode($arr);
		return;
	}
	
	if ($status == "data" )
	{
		$query = "select * from TB_User " ;
			$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		$response["data"] = $arr ;
		echo json_encode($response);
		return;
	}

	if ($status == "select" )
		{
			$query = "select * from TB_User " ;
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
				
			$arr = array();
			
			while ($row = sqlsrv_fetch_Object($result))
			{
				$arr[] = $row;
			}
			echo json_encode($arr);
			return;
		}
	if ($status == "selectUserNames" )
		{
			$query = "select userName from TB_User" ;
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
			$query = "delete from TB_User where UserID=$id" ;
				$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;  
				
			echo json_encode("Record has been deleted.");
			return ; 
		}
	if ($status == 'rmvImg'){
		$id = $_REQUEST["id"];
		$query = "select Photo from TB_User where UserID = $id";
		$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_fetch($result);
        $fileToDelete = sqlsrv_get_field($result , 0);
		if($fileToDelete){
			$query = "update TB_User set Photo = null where UserID = $id";
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
			if (file_exists($fileToDelete)) {
				// Attempt to delete the file
				if (unlink($fileToDelete)) {
					$msg = "File deleted successfully.";
				} else {
					$msg = "Error deleting the file.";
				}
			} else {
				$msg = "File does not exist.";
			}
		}else{
			$msg = "No file to delete";
		}
		echo json_encode($msg);
		return;
	}

	if ($status == "updateCardinantials")
	{ 
		$arr = [];
		$id = $_REQUEST["id"];
		$userName = $_REQUEST["UserName"];
		$password = $_REQUEST["Password"];
		$query = "update TB_User set UserName = '$userName', password = '$password' where UserID = $id";
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		$arr['success'] = true;
		echo json_encode($arr);
		return;
	}
	
	$FName= addslashes($_REQUEST["FName"]);
	$FatName= addslashes($_REQUEST["FatName"]);
	$LName= addslashes($_REQUEST["LName"]);
	$DOB= addslashes($_REQUEST["DOB"]);
	$Phone= addslashes($_REQUEST["Phone"]);
	$Email = addslashes($_REQUEST["Email"]);
	$JoinDate= addslashes($_REQUEST["JoinDate"]);
	$IsActive= isset($_REQUEST['IsActive'])?1:0;
	$path_filename_ext = '';
	$UserType = addslashes($_REQUEST['userType']);
	if($UserType == 'tr'){
		$target_dir = "upload/trainers/";
	}elseif ($UserType == 'te') {
		$target_dir = "upload/trainees/";
	}
	
	
	if ($status == "new")
	{
		$arr = [];
		
		// if (isset($_FILES["Photo"])){
			if (($_FILES["Photo"]["name"]!="")){
				
				$file = $_FILES["Photo"]["name"];
				$path = pathinfo($file);
				$filename = $path["filename"];
				$ext = $path["extension"];
				$temp_name = $_FILES["Photo"]["tmp_name"];
				$path_filename_ext = $target_dir.$filename.".".$ext;
			
				if (file_exists($path_filename_ext)) {
						$arr['msg'] = "Sorry, file already exists.";
				}else{
						move_uploaded_file($temp_name,$path_filename_ext);
						$arr['msg'] = "File Uploaded Successfully";
				}
			}
			$query = "insert into TB_User  (FName, FatName, LName, DOB, Phone, Email, Photo,JoinDate, IsActive, UserType)  values (N'$FName', N'$FatName', N'$LName', N'$DOB', '$Phone', '$Email', '$path_filename_ext','$JoinDate','$IsActive', '$UserType');select SCOPE_IDENTITY()";
		// }else{
		// 	$query = "insert into TB_User  (FName, FatName, LName, DOB, Phone, Email, JoinDate, IsActive, UserType)  values (N'$FName', N'$FatName', N'$LName', N'$DOB' '$Phone', '$Email', '$JoinDate','$IsActive', 'tr');select SCOPE_IDENTITY()";
		// }
			
		$result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_next_result($result);
		sqlsrv_fetch($result);
        $id = sqlsrv_get_field($result , 0);
		$arr['UserID'] = $id;
		echo json_encode($arr);
		return;
	} 
				
	if ($status == "update")
	{ 
		$arr = [];
		$id = $_REQUEST["id"];
		// if (isset($_REQUEST["Photo"])){
			if (($_FILES["Photo"]["name"]!="")){
				$target_dir = "upload/trainers/";
				$file = $_FILES["Photo"]["name"];
				$path = pathinfo($file);
				$filename = $path["filename"];
				$ext = $path["extension"];
				$temp_name = $_FILES["Photo"]["tmp_name"];
				$path_filename_ext = $target_dir.$filename.".".$ext;
			
				if (file_exists($path_filename_ext)) {
						$arr['msg'] = "Sorry, file already exists.";
				}else{
						move_uploaded_file($temp_name,$path_filename_ext);
						$arr['msg'] = "File Uploaded Successfully";
				}
			}
			if ($path_filename_ext!= ""){
				$query = "update TB_User set FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', Photo='$path_filename_ext',JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
			}
			else
			{
				$query = "update TB_User set FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
			}
		// }else{
		// 	$query = "update TB_User set FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
		// }
		$arr['success'] = true;
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		echo json_encode($arr);
	}
					
?>
						
