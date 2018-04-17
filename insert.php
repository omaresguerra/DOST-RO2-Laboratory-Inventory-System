<?php
	include('config.php');

	$testlab = $_GET['testlab'];
	$lab = $_GET['lab'];
	$name = $_GET['name'];

	if ($name == 'services') {
		$servicename = $_POST['txtServiceName'];

		$query = "INSERT INTO service(ServiceName, TestingLabID) VALUES('$servicename', '$testlab')";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'location') {
		$locatename = $_POST['txtLocationName'];

		$query = "INSERT INTO location(LocationName) VALUES('$locatename')";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'chemicals') {
		$chemname = $_POST['txtChemicalName'];
		$chemdesc = $_POST['txtChemicalDescription'];
		$location = $_POST['cboxLocation'];
		$status = $_POST['cboxStatus'];

		$query = "INSERT INTO chemical(ChemName, Description, StatusChemID, TestingLabID, LocationID) VALUES('$chemname','$chemdesc','$status','$testlab','$location')";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'equipment') {
		$equipname = $_POST['txtEquipName'];
		$equipdesc = $_POST['txtEquipDescription'];
		$location = $_POST['cboxLocation'];
		$status = $_POST['cboxStatus'];

		$query = "INSERT INTO equipment(EquipName, Description, StatusEquipID, TestingLabID, LocationID) VALUES('$equipname','$equipdesc','$status','$testlab','$location')";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'laboratory') {
		$abbrname = $_POST['txtAbbrName'];
		$fullname = $_POST['txtFullName'];
		$userlevel = $_POST['cboxUserLevel'];
		
		$query = "INSERT INTO lab(LabName, LabFullName, UserLevelID) VALUES('$abbrname','$fullname','$userlevel')";
		mysqli_query($dbcon, $query);

		$query1 = "SELECT * FROM lab WHERE LabName='".$abbrname."'";
		$result1 = mysqli_query($dbcon, $query1);

		$email = $_POST['txtAbbrName']."@gmail.com";
		
		$password = $abbrname;
		$password = md5($password);

		while ($rows=mysqli_fetch_array($result1)) {
			$labid = $rows['LabID'];
			$qry = "INSERT INTO user(UserName, Email, Password, LabID) VALUES('$abbrname', '$email', '$password', '$labid')";
			$res = mysqli_query($dbcon, $qry);
			echo "$labid";
		}

		header('location: index-lab.php?labid='.$lab.'');
	}

	elseif ($name == 'laboratorytestlab') {
		$abbrname = $_POST['txtAbbrName'];
		$fullname = $_POST['txtFullName'];
		$userlevel = $_POST['cboxUserLevel'];
		
		$query = "INSERT INTO lab(LabName, LabFullName, UserLevelID) VALUES('$abbrname','$fullname','$userlevel')";
		mysqli_query($dbcon, $query);

		$query1 = "SELECT * FROM lab WHERE LabName='".$abbrname."'";
		$result1 = mysqli_query($dbcon, $query1);

		$email = $_POST['txtAbbrName']."@gmail.com";
		
		$password = $abbrname;
		$password = md5($password);

		while ($rows=mysqli_fetch_array($result1)) {
			$labid = $rows['LabID'];
			$qry = "INSERT INTO user(UserName, Email, Password, LabID) VALUES('$abbrname', '$email', '$password', '$labid')";
			$res = mysqli_query($dbcon, $qry);
			echo "$labid";
		}

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}

	elseif ($name == 'laboratoryindex') {
		$abbrname = $_POST['txtAbbrName'];
		$fullname = $_POST['txtFullName'];
		$userlevel = $_POST['cboxUserLevel'];
		
		$query = "INSERT INTO lab(LabName, LabFullName, UserLevelID) VALUES('$abbrname','$fullname','$userlevel')";
		mysqli_query($dbcon, $query);

		$query1 = "SELECT * FROM lab WHERE LabName='".$abbrname."'";
		$result1 = mysqli_query($dbcon, $query1);

		$email = $_POST['txtAbbrName']."@gmail.com";
		
		$password = $abbrname;
		$password = md5($password);

		while ($rows=mysqli_fetch_array($result1)) {
			$labid = $rows['LabID'];
			$qry = "INSERT INTO user(UserName, Email, Password, LabID) VALUES('$abbrname', '$email', '$password', '$labid')";
			$res = mysqli_query($dbcon, $qry);
			echo "$labid";
		}
		
		header('location: index.php');
	}

?>