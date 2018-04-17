<?php
	include('config.php');
	$labID = $_GET['lab'];
	$name = $_GET['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="shortcut icon" href="img/dost-logo.png"/>
	<title>Print Record</title>
</head>
<body class="bg-print">
	<div class="body-print">
		<table class="print-table">
			<tr>
				<td class="logo-container-print">
					<img src="img/DOST_flat1.png"  class="print-logo">	
				</td>
				<td width="700">
					Republic of the Philippines<br>
					<b class="dost-print">Department of Science and Technology RO II</b><br>
					Dalan na Paccorofun, Carig Sur, Tuguegarao City, Cagayan<br>
					<small>http://region2.dost.gov.ph</small>
					<br>
					

						<?php
							$query="SELECT * FROM lab WHERE LabID = ".$labID."";
							$result=mysqli_query($dbcon, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo "<b class='rstl-print'>".$row['LabFullName']." (".$row['LabName'].")</b>";
							}
						?>

				</td>
				<td class="logo-container-print-iso">
					<img src="img/iso-logo.jpg" class="print-logo">
				</td>
			</tr>
			<tr><td colspan="3"><hr></td></tr>
			<tr>
				<td colspan="3">
					<table class="table-print" cellspacing="0" cellpadding="3" class="border-table">
					<?php
						if ($name == 'allrecords') {
					?>
							<tr>
								<td>
									<b class="rstl-testlab">All Records</b>
								</td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td class="gray-print">
									<b class="rstl-testlab">Testing Laboratories</b>
								</td>
							</tr>
							<?php
								$query="SELECT * FROM testinglab WHERE LabID = ".$labID." ORDER BY TestingLabName ASC";
								$result=mysqli_query($dbcon, $query);
								while ($row = mysqli_fetch_array($result)) {
									echo "<tr><td class='bordered-print'>".$row['TestingLabName']."</td></tr>";
								}
							?>
					<?php 
						} 
						elseif ($name == 'testlab') {
					 ?>
							<?php
								$testLabID = $_GET['testinglab'];
								$query="SELECT * FROM testinglab WHERE TestingLabID = ".$testLabID." ORDER BY TestingLabName ASC";
								$result=mysqli_query($dbcon, $query);
								while ($row = mysqli_fetch_array($result)) {
									echo "<tr><td><b class='rstl-testlab'>".$row['TestingLabName']."</b></td></tr>";
								}
							?>
					<?php
						}
					?>
							
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<table class="table-print" cellspacing="0" cellpadding="3" class="border-table">
							<tr>
								<td class="gray-print">
									<b class="rstl-testlab">List of Services</b>
								</td>
							</tr>
							<?php
								if ($name == 'allrecords') {
									$query="SELECT * FROM service JOIN testinglab ON service.TestingLabID= testinglab.TestingLabID WHERE LabID = ".$labID." ORDER BY ServiceName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['ServiceName']."</td></tr>";
									}
								}
								elseif ($name == 'testlab') {

									$testLabID = $_GET['testinglab'];

									$query="SELECT * FROM service WHERE TestingLabID = ".$testLabID." ORDER BY ServiceName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['ServiceName']."</td></tr>";
									}
								}
								
							?>
					
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<table class="table-print" cellspacing="0" cellpadding="3" class="border-table">
							<tr>
								<td class="gray-print" colspan="4">
									<b class="rstl-testlab">Inventory of Chemicals</b>
								</td>
							</tr>
							<tr>
								<td class="bordered-print-bold"><b>Chemical Name</b></td>
								<td  class="bordered-print-bold"><b>Description</b></td>
								<td  class="bordered-print-bold"><b>Location</b></td>
								<td  class="bordered-print-bold"><b>Availability</b></td>
							</tr>
							<?php
								if ($name == 'allrecords') {
									$query="SELECT * FROM chemical JOIN location ON location.LocationID = chemical.LocationID JOIN testinglab ON chemical.TestingLabID =  testinglab.TestingLabID JOIN statuschemical ON statuschemical.StatusChemID = chemical.StatusChemID WHERE LabID = ".$labID." ORDER BY ChemName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['ChemName']."</td>
										<td class='bordered-print'>".$row['Description']."</td>
										<td class='bordered-print'>".$row['LocationName']."</td>
										<td class='bordered-print'>".$row['StatusChemName']."</td></tr>";
									}
								}
								elseif ($name == 'testlab') {
									$testLabID = $_GET['testinglab'];

									$query="SELECT * FROM chemical JOIN location ON location.LocationID = chemical.LocationID JOIN statuschemical ON statuschemical.StatusChemID = chemical.StatusChemID WHERE TestingLabID = ".$testLabID." GROUP BY ChemName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['ChemName']."</td>
										<td class='bordered-print'>".$row['Description']."</td>
										<td class='bordered-print'>".$row['LocationName']."</td>
										<td class='bordered-print'>".$row['StatusChemName']."</td></tr>";
									}
								}
								
							?>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<table class="table-print" cellspacing="0" cellpadding="3" class="border-table">
							<tr>
								<td class="gray-print" colspan="4">
									<b class="rstl-testlab">List of Equipments</b>
								</td>
							</tr>
							<tr>
								<td class="bordered-print-bold"><b>Equipment Name</b></td>
								<td  class="bordered-print-bold"><b>Description</b></td>
								<td  class="bordered-print-bold"><b>Location</b></td>
								<td  class="bordered-print-bold"><b>Status</b></td>
							</tr>
							<?php

								if ($name == 'allrecords') {
									$query="SELECT * FROM equipment JOIN testinglab ON equipment.TestingLabID= testinglab.TestingLabID JOIN location ON location.LocationID = equipment.LocationID JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID WHERE LabID = ".$labID." ORDER BY EquipName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['EquipName']."</td>
										<td class='bordered-print'>".$row['Description']."</td>
										<td class='bordered-print'>".$row['LocationName']."</td>
										<td class='bordered-print'>".$row['StatusEquipName']."</td></tr>";
									}
								}
								elseif ($name == 'testlab') {
									$testLabID = $_GET['testinglab'];
									$query="SELECT * FROM equipment JOIN location ON location.LocationID = equipment.LocationID JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID WHERE TestingLabID = ".$testLabID." ORDER BY EquipName ASC";
									$result=mysqli_query($dbcon, $query);
									while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td class='bordered-print'>".$row['EquipName']."</td>
										<td class='bordered-print'>".$row['Description']."</td>
										<td class='bordered-print'>".$row['LocationName']."</td>
										<td class='bordered-print'>".$row['StatusEquipName']."</td></tr>";
									}
								}
								
							?>
					
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<p>&nbsp;</p>
					
				</td>
			</tr>

		</table>
	</div>
</body>
</html>