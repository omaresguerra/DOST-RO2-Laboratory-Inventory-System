<?php
	
	include('config.php');

	/*if($_POST['id']) {
	$id=$_POST['id'];

	$sql="SELECT ServiceName FROM service WHERE ServiceID='".$id."'";
	$res = mysqli_query($dbcon, $sql);
		while($row=mysqli_fetch_array($res)) {

			$name=$row['ServiceName'];
			echo "".$name."";

		}
    }*/
    if(isset($_POST["employee_id"]))  
	 {  
	      $query = "SELECT * FROM service WHERE ServiceID = '".$_POST["employee_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  
	      echo json_encode($row);  
	 }  

	 elseif(isset($_POST["chemical_id"]))  
	 {  
	      $query = "SELECT * FROM chemical  WHERE ChemID = '".$_POST["chemical_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  


	      echo json_encode($row);  
	 }  
	 
	 elseif(isset($_POST["equip_id"]))  
	 {  
	      $query = "SELECT * FROM equipment  WHERE EquipID = '".$_POST["equip_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  

	     
	      echo json_encode($row);  
	 }  
	 elseif(isset($_POST["testlab_id"]))  
	 {  
	      $query = "SELECT * FROM testinglab  WHERE TestingLabID = '".$_POST["testlab_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  

	     
	      echo json_encode($row);  
	 } 
	 elseif(isset($_POST["lab_id"]))  
	 {  
	      $query = "SELECT * FROM lab  WHERE LabID = '".$_POST["lab_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  

	     
	      echo json_encode($row);  
	 } 
	 elseif(isset($_POST["comment_id"]))  
	 {  
	      $query = "SELECT * FROM comments JOIN user ON user.UserID=comments.UserID  WHERE id = '".$_POST["comment_id"]."'";  
	      $result = mysqli_query($dbcon, $query);  
	      $row = mysqli_fetch_array($result);  

	     
	      echo json_encode($row);  
	 }
	 elseif(isset($_POST["userid"]))  
	 {  
	      $query = "SELECT * FROM user WHERE UserID = '".$_POST["userid"]."'";  
	      $result = mysqli_query($dbcon, $query); 

	      $row = mysqli_fetch_array($result);  
	    
	 	  echo json_encode($row);

	 }

?>