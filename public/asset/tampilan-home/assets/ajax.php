 <?php
	error_reporting(0);
  	include "config/conn.php";


$sql = "SELECT nama, no_rekening  FROM nasabah
   WHERE no_rekening LIKE '%".$_GET['query']."%'
   LIMIT 10"; 
 $result    = mysqli_query($conn,$sql);
  
 $json = [];
 while($row = $result->fetch_assoc()){
      $json[] = $row['no_rekening'] ; 

     
 }

 echo json_encode($json);




?>