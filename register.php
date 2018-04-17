<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - DOST Laboratory Inventory System</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="shortcut icon" href="img/dost-logo.png"/>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
	<script src="js/responsive-tabs.js"></script>
</head>
<body class="header-login-reg">
	<!-- <div class="header-login-header">
		<div class="logo-container">
			<img src="img/DOST.png" class="logo">
		</div>
		<div class="header-container">
			<div class="dost">
				Department of Science and Technology
			</div>
			<div class="region">
				Regional Office No. II
			</div>
		</div>
	</div> -->
	<div class="page-wrapper container-fluid">
		<div class="row">
		<div class="col-lg-1">
		</div>
		<div class="col-lg-6 gradient" style="padding-top: 20px; -webkit-animation:down-falling 0.7s; animation:down-falling 0.7s;">
			<div class="col-lg-12" style="text-align: center;">
				<img src="img/DOST_flat.png" class="logo-login">
			</div>
			<div class="col-lg-12 dost-login" style="text-align: center;">
				DOST RO2
			</div>
			<div class="col-lg-12">
				<h2 class="laboratory-inventory" style="border:none;">
		        LABORATORY INVENTORY SYSTEM
		    	</h2>
			</div>
			
			<div class="col-lg-12 laboratory-about" style="padding: 10px; color: #357f8c; text-align: center;">
				<p>This system is used to view profile and inventory of chemicals and equipment of the different Laboratory Services of Department of Science and Technology Regional Office II</p>
			</div>
		</div>
		<div class="col-lg-4 bg-white-border">	
			<h2 class="page-header laboratory-inventory-log">
		        Register
		    </h2>
		<form action="register.php" method="POST">

		<!--display validation errors-->
		<?php include('errors.php'); ?>

			<div class="form-group">
				<!-- <label class="label-log">Username:</label> -->
				<input type="text" class="form-control" name="username"  placeholder="Username" style="height: 40px; font-size: 15px;" required="">
			</div>
			<div class="form-group">
				<!-- <label class="label-log">Email:</label> -->
				<input type="text" class="form-control" name="email"  placeholder="Email" style="height: 40px; font-size: 15px;" required="">
			</div>
			<div class="form-group">
				<!-- <label class="label-log">Password:</label> -->
				<input type="password" class="form-control " name="password_1" placeholder="Password" style="height: 40px; font-size: 15px;" required="">
			</div>
			<div class="form-group">
				<!-- <label class="label-log">Confirm Password:</label> -->
				<input type="password" class="form-control" name="password_2" placeholder="Confirm Password" style="height: 40px; font-size: 15px;" required="">
			</div>
			<div class="form-group" style="display: none">
			<label class="label-log">Laboratory Assigned:</label>
				<?php 
					$sql = "SELECT * FROM lab WHERE UserLevelID = 3";
					$result = mysqli_query($db,$sql);
					echo "<select name='cboxLab' class='form-control login-text' style='height: 40px; font-size: 15px;'>";
					while ($row = mysqli_fetch_array($result)) {

					echo "<option value=".$row['LabID'].">".$row['LabName']."</option>";
					}
					echo "</select>";
			    ?>
			</div>

		        <font style="font-family: Verdana; color: #0e899f;">Already a member? <a href="login.php" style="text-decoration: underline;"><font style="color: #0e899f;">Log in</font><b class="caret"></b>
				</a></font>
			<div class="modal-footer" style="margin-bottom: 10px; margin-top: 10px;">
				<button type="submit" class="btn btn-primary" name="register" style="font-family:Verdana;">&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;</button>
			</div>
		</form>		  			
		</div>
		<div class="col-lg-1 footer-login">
			
		</div>
		</div>
	</div>
</body>
</html>