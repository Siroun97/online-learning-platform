
<?php require('localConnection.php');
 
 $status = $_REQUEST["status"];
 if ($status == "one" )
 {
 $id = $_REQUEST["id"];
 $query = "select * from tbluser where userId=$id";

 $result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
 $arr = array();
 while ($row = sqlsrv_fetch_Object($result))
 {
 $arr[] = $row;
 }
 echo json_encode($arr);
 sqlsrv_close($conn);
 return;
 }
 
  if ($status == "select" )
  {
	$query = "SELECT * FROM tbluser WHERE userType='tr'";

  $result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  $arr = array();
  while ($row = sqlsrv_fetch_Object($result))
  {
  $arr[] = $row;
  }
  echo json_encode($arr);
  sqlsrv_close($conn);
  return;
  }
  if($status=="delete")
  {
  $id = $_REQUEST["id"];
  $query = "delete from tbluser where userId=$id" ;
  $result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  echo json_encode("Record has been deleted.");
  return ;
  }
 $firstName = $_REQUEST["firstName"];
  $lastName= $_REQUEST["lastName"];
  $email = $_REQUEST["email"];
  //$IsActive= isset($_REQUEST['IsActive'])?1:0;
  if ($status == "new")
  {
    
    $query = "INSERT INTO tbluser (firstName, lastName, email,userType) VALUES (N'$firstName', '$lastName', '$email', 'tr'); SELECT SCOPE_IDENTITY()";

  // $query = "insert into department (Title,CourseDescr,StartDate,StopDate,CoursePortalID,TrainerID,IsActive, CoursePrice) values('$Title','$CourseDescr','$StartDate','$StopDate','$CoursePortalID','$TrainerID','$IsActive', $CoursePrice);select SCOPE_IDENTITY()";
  $result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  sqlsrv_next_result($result);
  sqlsrv_fetch($result);
  $id = sqlsrv_get_field($result , 0);
  //$arr['DepID'] = $id;
  //echo json_encode($arr);
  sqlsrv_close($conn);
  return;
 
  }
  if ($status == "update")
  {
  $result = "";
  $id = $_REQUEST["id"];
  $imageUrl = $_REQUEST["imageUrl"];
 
  
  $query = "UPDATE tbluser SET firstName = N'$firstName', lastName = '$lastName', email = '$email' ,imageUrl='$imageUrl' WHERE userId = $id";

  // $query = "update department setTitle='$Title',CourseDescr='$CourseDescr',StartDate='$StartDate',StopDate='$StopDate',CoursePortalID='$CoursePortalID',TrainerID='$TrainerID',isActive='$IsACoursePrice = $CoursePrice where DepID = $id";
  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  echo json_encode($result);
  sqlsrv_close($conn);
  }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["trainerImage"]) && $_FILES["trainerImage"]["error"] == UPLOAD_ERR_OK) {
        // Define directory where images will be saved
        $uploadDirectory = "C:\\xampp\\htdocs\\ProfessionalPracitceCMS\\images";

        // Generate a unique filename for the uploaded image
        $filename = uniqid() . "_" . $_FILES["trainerImage"]["name"];

        // Move the uploaded file to the upload directory
        // Move the uploaded file to the upload directory
if (move_uploaded_file($_FILES["trainerImage"]["tmp_name"], $uploadDirectory . DIRECTORY_SEPARATOR . $filename)) {
  echo "Image uploaded successfully.";
} else {
  echo "Error uploading image.";
}

    } else {
        echo "No file uploaded or error occurred.";
    }
} else {
    echo "Invalid request.";
}

  ?>
 
 
 
 
 
 
 
 