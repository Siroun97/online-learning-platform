<?php require('localConnection.php'); ?>

<?php 
    $status = $_REQUEST['status'];
    if ($status == 'coursesByTRainer') {
        $trainerId = $_REQUEST['trainerId']; // Corrected variable name

        $query = "SELECT * FROM course WHERE trainerId=$trainerId";
        $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
            
        $arr = array();
        
        while ($row = sqlsrv_fetch_Object($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
        return;
    }


    if ($status == 'allCourses') {
        $query = "SELECT * FROM course";
        $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
            
        $arr = array();
        
        while ($row = sqlsrv_fetch_Object($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
        return;
    }
    if ($status == 'one') {
        $courseId= $_REQUEST['courseId'];
        $query = "SELECT courseName,description,price,portalId FROM course WHERE courseId =$courseId";
        $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
            
        $arr = array();
        
        while ($row = sqlsrv_fetch_Object($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
        return;
    }


    if($status=="delete")
  {
  $id = $_REQUEST["id"];
  $query = "delete from course where courseId=$id" ;
  $result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  echo json_encode("Record has been deleted.");
  return ;
  }
  
   
  if ($status == "new")

  { $courseName = $_REQUEST['courseName'];
    $description= $_REQUEST["description"];
    $price = $_REQUEST["price"];
    $portalId=$_REQUEST["portalId"];
    $trainerId = $_REQUEST['trainerId'];
   
    $query = "INSERT INTO course (courseName,description,price,portalId,trainerId) VALUES (N'$courseName','$description','$price','$portalId','$trainerId'); SELECT SCOPE_IDENTITY()";

  // $query = "insert into department (Title,CourseDescr,StartDate,StopDate,CoursePortalID,TrainerID,IsActive, CoursePrice) values('$Title','$CourseDescr','$StartDate','$StopDate','$CoursePortalID','$TrainerID','$IsActive', $CoursePrice);select SCOPE_IDENTITY()";
  $result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  sqlsrv_next_result($result);
  sqlsrv_fetch($result);
  $id = sqlsrv_get_field($result , 0);
  $arr['courseId'] = $id;
  echo json_encode($arr);
  sqlsrv_close($conn);
  return;
 
  }
  if ($status == "update")
  {
  $result = "";
  $courseId = $_REQUEST["courseId"];
  $courseName = $_REQUEST["courseName"];
  $description= $_REQUEST["description"];
  $price = $_REQUEST["price"];
  $portalId=$_REQUEST["portalId"];
  
  $query = "UPDATE course SET courseName = N'$courseName', description = '$description', price = '$price', portalId='$portalId' WHERE courseId = $courseId";


  // $query = "update department setTitle='$Title',CourseDescr='$CourseDescr',StartDate='$StartDate',StopDate='$StopDate',CoursePortalID='$CoursePortalID',TrainerID='$TrainerID',isActive='$IsACoursePrice = $CoursePrice where DepID = $id";
  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or die( print_r( sqlsrv_errors(), true)) ;
  echo json_encode($result);
  sqlsrv_close($conn);
  }
  ?>
  

