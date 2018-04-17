<?php 
session_start();
$username ="";
$email = "";
$errors = array();
//connect to the database
$db=mysqli_connect('localhost', 'root','','inventorysystem');
// if the register button is clicked
if(isset($_POST['register'])){
	$username =mysqli_real_escape_string($db,$_POST['username']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$lab = mysqli_real_escape_string($db, $_POST['cboxLab']);
	$password_1 =mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 =mysqli_real_escape_string($db, $_POST['password_2']);	
	
	// ensure that form fields are filled properly
	if (empty($username)){
		array_push($errors, "Username is required!");
	}
	if (empty($email)){
		array_push($errors, "Email is required!");
	}
	if (empty($password_1)){
		array_push($errors, "Password is required!");
	}
 	if($password_1 != $password_2){
	array_push($errors, "The two Passwords do not match!");
}
//if there are no errors, save user to data base
if (count($errors) == 0){
	
	$password =  md5($password_1); //encrypt password before storing

	$sql= "INSERT INTO user (UserName, Email, Password, LabID) VALUES ('$username','$email','$password', '$lab')";
	mysqli_query($db,$sql);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "You are now logged in.";
	header('location: login.php'); //redirect to home page 
}
}
//log user in from login page
if (isset($_POST['login'])){
	$username= mysqli_real_escape_string ($db,$_POST['username']);
	$password= mysqli_real_escape_string ($db,$_POST['password']);

	//ensure that form fields are filled properly
	if (empty($username)){
		array_push($errors, "Username is required!");
	}
	if (empty($password)){
		array_push($errors, "Password is required!");
	}
	if (count($errors) == 0){
	$password = md5($password); //encrypt password before comparing 

	$qry = "SELECT * FROM lab JOIN user ON user.LabID = lab.LabID WHERE Username='$username' AND Password='$password'";
	$res = mysqli_query($db, $qry);
		while ($row = mysqli_fetch_array($res)) {
			$lab = $row['LabName'];
			$userlevel = $row['UserLevelID'];
			$user = $row['UserID'];
		}

	$query= "SELECT * FROM  user where UserName='$username' AND Password ='$password'";

	$result = mysqli_query($db, $query);

		if (mysqli_num_rows($result) == 1){
			$_SESSION['user'] = $user;
			$_SESSION['username'] = $username;
			$_SESSION['lab'] = $lab;
			$_SESSION['userlevel'] = $userlevel;
			$_SESSION['success'] = "You are now logged in.";
			header('location: index.php');
		}else{
			array_push($errors, "Wrong Username/password combination!");

		}
	}
}
//logout
if (isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['username']);
	header('location:login.php');
	} 
	?>
