<?php
	include('config.php');

	$testlab = $_GET['testinglab'];
	$lab = $_GET['lab'];
	$name = $_GET['name'];

	if ($name == 'services') {
		$serviceid = $_POST['txtServiceID'];

		$query = "DELETE FROM service WHERE ServiceID= '".$serviceid."'";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'chemical') {
		$chemid = $_POST['txtChemID'];

		$query = "DELETE FROM chemical WHERE ChemID= '".$chemid."'";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'equipment') {
		$equipid = $_POST['txtEquipID'];

		$query = "DELETE FROM equipment WHERE EquipID= '".$equipid."'";
		mysqli_query($dbcon, $query);

		header('location: index-testinglab.php?labid='.$lab.'&testinglabid='.$testlab.'');
	}
	elseif ($name == 'testlab') {
		$testid = $_POST['txtTestLabID'];

		$query = "DELETE FROM testinglab WHERE TestingLabID= '".$testid."'";
		mysqli_query($dbcon, $query);

		header('location: index-lab.php?labid='.$lab.'');
	}
?>