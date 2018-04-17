<?php
	include('config.php');
	$name=$_GET['name'];
	$lab=$_GET['lab'];
	$testlab=$_GET['testinglab'];

	if ($name == 'service') {

		$id = $_POST['employee_id'];
		$name= $_POST['name'];

		$query="UPDATE service SET ServiceName='".$name."' WHERE ServiceID=".$id."";

		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
		
	}

	elseif ($name == 'chemical') {

		$id = $_POST['chemical_id'];
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$location = $_POST['cboxLocation'];
		$status = $_POST['cboxStat'];

		$query="UPDATE chemical SET ChemName='".$name."', Description='".$desc."', StatusChemID='".$status."', LocationID='".$location."' WHERE ChemID=".$id."";

		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
		
	}

	elseif ($name == 'equipment') {

		$id = $_POST['equip_id'];
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$location = $_POST['cboxLocation'];
		$status = $_POST['cboxStat'];

		$query="UPDATE equipment SET EquipName='".$name."', Description='".$desc."', StatusEquipID='".$status."', LocationID='".$location."' WHERE EquipID=".$id."";

		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');

	}
	elseif ($name == 'testlab') {

		$id = $_POST['testlab_id_edit'];
		$name = $_POST['name'];
	
		$query="UPDATE testinglab SET TestingLabName='".$name."' WHERE TestingLabID=".$id."";

		mysqli_query($dbcon, $query);


		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');

	}

	elseif ($name == 'lab') {

		$id = $_POST['lab_id_edit'];
		$name = $_POST['name'];
		$fname = $_POST['fname'];

		// echo "$name $fname $id";
	
		$query="UPDATE lab SET LabName='".$name."', LabFullName='".$fname."'  WHERE LabID=".$id."";

		mysqli_query($dbcon, $query);


		header('location: index-lab.php?labid='.$lab.'');

	}
	elseif ($name == 'profile') {

		$id = $_POST['txtUserID'];
		$name = $_POST['txtName'];
		$email = $_POST['txtEmail'];
		$password = md5($_POST['txtPassword']);

		$query = "UPDATE user SET UserName = '".$name."', Email = '".$email."', Password = '".$password."' WHERE UserID = ".$id."";
		mysqli_query($dbcon, $query);

		header('location: index.php');
		echo "$lab";

	}
	elseif ($name == 'profile-lab') {

		$id = $_POST['txtUserID'];
		$name = $_POST['txtName'];
		$email = $_POST['txtEmail'];
		$password = md5($_POST['txtPassword']);

		$query = "UPDATE user SET UserName = '".$name."', Email = '".$email."', Password = '".$password."' WHERE UserID = ".$id."";
		mysqli_query($dbcon, $query);

		header('location: index-lab.php?labid='.$lab.'');
		

	}
	elseif ($name == 'profile-testlab') {

		$id = $_POST['txtUserID'];
		$name = $_POST['txtName'];
		$email = $_POST['txtEmail'];
		$password = md5($_POST['txtPassword']);

		$query = "UPDATE user SET UserName = '".$name."', Email = '".$email."', Password = '".$password."' WHERE UserID = ".$id."";
		mysqli_query($dbcon, $query);

		header('location: index-lab.php?labid='.$lab.'&testinglabid='.$testlab.'');

		

	}
?>