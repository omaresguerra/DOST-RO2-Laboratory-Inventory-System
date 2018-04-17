<?php include('server.php'); 
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])){
	header('location: login.php');
}
	$lab=$_SESSION['lab'];
	$testlabid=$_GET['testinglabid'];
	$labid=$_GET['labid'];
	$userlevel = $_SESSION['userlevel'];
	$username = $_SESSION['user'];

?>

<?php
	$labid = $_GET['labid'];
	if(count($_POST) == 1) {
		require_once("config.php");
		$sql = "INSERT INTO testinglab (TestingLabName, LabID) VALUES ('" . $_POST["txtTestLabName"] . "', $labid)";
		mysqli_query($dbcon,$sql);
		$current_id = mysqli_insert_id($dbcon);
		if(!empty($current_id)) {

			$message = "<b style='font-family: Verdana; font-size:13px; color:#5cb85c;'>New Testing Lab Added Successfully!</b>";
		}
	}
?>

<?php

	$conn = new mysqli("localhost","root","","inventorysystem");
	$count=0;
	if(!empty($_POST['add'])) {
		$subject = mysqli_real_escape_string($conn,$_POST["subject"]);
		$comment = mysqli_real_escape_string($conn,$_POST["comment"]);
		$sql = "INSERT INTO comments (subject,comment,time,UserID) VALUES('" . $subject . "','" . $comment . "',now(), '".$username."')";
		mysqli_query($conn, $sql);
	}
	$sql2="SELECT * FROM comments WHERE status = 0";
	$result=mysqli_query($conn, $sql2);
	$count=mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>DOST Laboratory Profiling and Inventory System</title>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/sb-admin.css" rel="stylesheet"> -->
 	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="shortcut icon" href="img/dost-logo.png"/>
	
	<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
	<script src="js/responsive-tabs.js"></script>
	
	<script src="js/affix.js"></script>

	<link rel="stylesheet" type="text/css" href="assets/animate.css" />

	 <script type="text/javascript">
		function myFunction() {
			$.ajax({
				url: "view_notification.php",
				type: "POST",
				processData:false,
				success: function(data){
					$("#notification-count").remove();				
					$("#body").show();
					$("#body").html(data);
				},
				error: function(){}           
			});
		 }
		 
		 $(document).ready(function() {
			$('body').click(function(e){
				if ( e.target.id != 'body'){
					$("#body").hide();
				}
			});
		});	 

	</script>

	 <script>  
	 $(document).ready(function(){  
	      $(document).on('click', '.view-message', function(){  
	           var comment_id = $(this).attr("id");  
	           $.ajax({  
	                url:"fetch_record.php",  
	                method:"POST",  
	                data:{comment_id:comment_id},  
	                dataType:"json",  
	                success:function(data){  
	                     $('#txtSubjectComment').val(data.subject); 
	                     $('#txtComment').val(data.comment);  
	                     $('#txtTime').val(data.time);
	                     $('#txtUserSender').val(data.Email);
	                   
	                     $('#ViewMessage').modal('show');  
	                }  
	           });  
	      }); 

	        $(document).on('click', '.user', function(){  
	           var userid = $(this).attr("id");  
	           $.ajax({  
	                url:"fetch_record.php",  
	                method:"POST",  
	                data:{userid:userid},  
	                dataType:"json",  
	                success:function(data){  
	                     $('#txtProfileName').val(data.UserName);  
	                     $('#txtProfileEmail').val(data.Email);  
	                     $('#txtUserID').val(data.UserID); 
	                     $('#ViewUser').modal('show');  
	                }  
	           });  
	      });     
	 });  
 	</script>
	
</head>
<!-- <script>
	// Hide Header on on scroll down
	var didScroll;
	var lastScrollTop = 0;
	var delta = 50;
	var navbarHeight = $('header').outerHeight();

	$(window).scroll(function(event){
	    didScroll = true;
	});

	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);

	function hasScrolled() {
	    var st = $(this).scrollTop();
	    
	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;
	    
	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        $('header1').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            $('header1').removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    
	    lastScrollTop = st;
	}
</script> -->


			<!-- Modal for Message -->
				<div class="modal fade verdana" id="ViewMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h5 class="modal-title" id="myModalLabel">Message</h5>
				      </div>
				      <div class="modal-body">
					       <h4><input type="text" name="txtSubject" id="txtSubjectComment" class="input-message" disabled><br><small>
					        <input type="text"  name="txtUser" id="txtUserSender" class="input-message" disabled><input type="text"  name="txtTime" id="txtTime" class="input-message" disabled></small></h4>
					       <h3><textarea name="txtSubject" id="txtComment" rows="4" class="textarea-message" disabled></textarea></h3>
				
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				 
				       
				      </div>
				    </div>
				  </div>
				</div>


				<!-- Modal for AllMessage -->
				<div class="modal fade verdana" id="allmessages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h5 class="modal-title" id="myModalLabel">All Message</h5>
				      </div>
				      <div class="modal-body">
				           <div class="table-responsive">
				           	<table class="table table-hover table-striped">
				           		<thead>
				           			<tr>
				           				<th>Subject</th>
				           				<th>Comment</th>
				           				<th>DateReceived</th>
				           				<th>Sender</th>
				           			</tr>
				           		</thead>
				           		<tbody>
				           			<?php
				           				include('config.php');
										$query = "SELECT * FROM comments JOIN user ON user.UserID = comments.UserID";

										$result = mysqli_query($dbcon, $query);
										while ($row = mysqli_fetch_array($result)) {
											echo "<tr>
												<td>".$row['subject']."</td>
												<td>".$row['comment']."</td>
												<td>".$row['time']."</td>
												<td>".$row['UserName']."</td>";
											echo "</tr>";
										}
				           			?>
				           		</tbody>
				           	</table>
				           </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      
				      </div>
				    </div>
				  </div>
				</div>


				<!-- Modal for User Profile-->
				<div class="modal fade verdana" id="ViewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Profile</h4>
				      </div>
				      <form action="edit.php?name=profile-testlab&lab=<?php echo $_GET['labid']; ?>&testinglab=<?php echo $_GET['testinglabid']; ?>" method="POST">
				      <div class="modal-body">
				      	<div class="form-group">
				      		<label>UserName</label>
				           	<input name="txtName" id="txtProfileName" class="form-control" required>
				        </div>
				        <div class="form-group">
				        	<label>Email address</label>
				           	<input type="text"  name="txtEmail" id="txtProfileEmail" class="form-control" required>
				        </div>
				         <div class="form-group">
				         	<label>Password</label>
				           	<input type="password"  name="txtPassword" id="txtProfilePassword" class="form-control" required>
				        </div>
				            <input type=""  name="txtUserID" id="txtUserID" class="form-control" style="display: none;">	
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				       <button type="submit" class="btn btn-primary" name="editprofile">Edit Profile</button>
				      
				      </div>
					 </form>
				    </div>
				  </div>
				</div>




<body>

	<header class="col-lg-12 down-fall">
		<div class="col-lg-4 logo-container down-fall">
			<img src="img/DOST_flat1.png" class="logo">
		</div>
		<div class="col-lg-8 header-container down-fall">
			<div class="dost">
				Department of Science and Technology
			</div>
			<div class="region">
				Regional Office No. II
			</div>
		</div>
	</header>
  	<div class="wrapper">

                <header1 class="navbar navbar-inverse navbar-fixed-top verdana">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">DOST</a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="index.php">Home</a>
                                </li>
                                <li class="dropdown active">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laboratory Services <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php
											include('config.php');
											$query = "SELECT * FROM lab WHERE UserLevelID = 2 ORDER BY LabName ASC";
											$result = mysqli_query($dbcon, $query);
										 ?>
										 <?php 
											while($row = mysqli_fetch_array($result)) {
											echo "<li>
											   <a href=index-lab.php?labid=".$row['LabID'].">".$row['LabName']."</a>
											   </li>";
										 	}
										 	if ($userlevel == 1) {
										 	?>

										 		<center>
										 			<a href="#"  data-toggle="modal" data-target="#AddLab"><i class="fa fa-plus"></i> Add Laboratory</a>
										 		</center>
										 	<?php
										 	} 
										 ?>
                                    </ul>
                                </li>
                               <!--  <li><a href="#about">About</a>
                                </li>
                                <li><a href="#contact">Contact</a>
                                </li> -->
                               

								<?php  
									if (($userlevel == 1) || ($userlevel == 2)){
								?>
								<li class="dropdown" style="cursor: pointer;">
                                	 <a class="dropdown-toggle" data-toggle="dropdown" onclick="myFunction()" >
                                	
                                	 <?php 
	                                	 if($count > 0) { 
	                                	 	echo " <span id=notification-count class=badge>".$count."</span>"; 
	                                	 } 
                                	 ?>
                                	 <i class="fa fa-envelope"></i> <b class="caret"></b></a>
				 				
				 					 <ul class="dropdown-menu" style="padding-top: 0px; padding-bottom: 0px;">
				 					 	<li class="message-preview" id="body"></li>
				 					 	<li class="message-preview"> 
				 					 	<a data-toggle="modal" data-target="#allmessages"><small>View all messages</small></a></li>
				 					 </ul>	
                                </li>
                                <?php } ?>
                                <li class="dropdown">
                            		<a style="cursor: pointer;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php
                            			$userid = $_SESSION['user'];
										$query = "SELECT * FROM user WHERE UserID =".$userid."";
										$result = mysqli_query($dbcon, $query);
										while($row = mysqli_fetch_array($result)) {
											echo $row['UserName'];
										}
                            		?> <b class="caret"></b>
                            		</a>
                            		<ul class="dropdown-menu">
                            			<li>
                            				<a class="user" id="<?php echo $_SESSION['user']; ?>" style="cursor: pointer;"><i class="fa fa-user"></i>  Profile</a>
                            			</li>
                            			<li>
		                                	<a href="index.php?logout=1"><i class="fa fa-power-off"></i> Logout</a>
		                                </li>
                            		</ul>
                            	</li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </header1>

	  	<div id="page-wrapper post">
		  	<div class="container-fluid">
		  
		  	<div class="row">
			  	<div class="col-lg-2 padding-welcome down-fall">
				  	<div class="row">
					  	<div class="col-lg-12 verdana">
						  	<div class="list-group panel panel-default">
							  	<div class="panel-heading"><b>Testing Laboratories</b></div>

							  		<?php
										include('config.php');

										$LabID = $_GET['labid'];
										$TestingLabID = $_GET['testinglabid'];

										$query = "SELECT * FROM testinglab WHERE LabID =".$LabID." ORDER BY TestingLabName ASC";
										$result = mysqli_query($dbcon, $query);
									?>
									<?php 
										while($row = mysqli_fetch_array($result)) {
										echo "
											<a class='list-group-item' href=index-testinglab.php?testinglabid=".$row['TestingLabID']."&labid=".$row['LabID'].">".$row['TestingLabName']."</a>
											<a></a>
										";
										}
									?>
						  	</div>
					  	</div>
				  	</div>
				  	<div class="row">
				  	 <?php
	                    	include('config.php');

	                    	$labID = $_GET['labid'];

	                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

	                    	$result=mysqli_query($dbcon, $query);
	                    	while ($row=mysqli_fetch_array($result)) {
	                    		$labcon = $row['LabName'];
	                    	}
	                    	if ($userlevel == 2) {
	                    		if ($lab == $labcon) {
			                ?>
						  		<div class="col-lg-12  animatezoom" style="margin-top: -10px;">
						  			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddTestLab" style="margin-bottom: 40px; font-family: Verdana; font-size: 13px; width: 100%;"><i class="fa fa-plus"></i> <b>Add Testing Lab</b></button>
						  		</div>
			                <?php
			                	}
	                    	}
	                    	if ($userlevel == 1) {
	                    	?>
	                    		<div class="col-lg-12  animatezoom" style="margin-top: -10px;">
						  			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddTestLab" style="margin-bottom: 40px; font-family: Verdana; font-size: 13px; width: 100%;"><i class="fa fa-plus"></i> <b>Add Testing Lab</b></button>
						  		</div>
	                    	<?php
	                    	}
	                    ?>
				  	</div>


				  	<div class="row">
					<div class="col-lg-12 padd-topping verdana">

					 <div class="list-group panel panel-default" style="font-family: Verdana; font-size: 14px;">
					 <div class="panel-heading" style=" border-radius:0px;text-align: center;"><b>Legend</b></div>
					  <li class="list-group-item">

					  	<div class="media">
						  <div class="media-left">
						     <img src="img/2.png" alt="Mountain View" style="width: 50px;">
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">Available</h4>
						    <p>60-100%</p>
						  </div>
						</div>
					 <div class="media">
						  <div class="media-left">
						     <img src="img/1.png" alt="Mountain View" style="width: 50px;">
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">Warning</h4>
						    <p>30-60%</p>
						  </div>
						</div>
						 <div class="media">
						  <div class="media-left">
						     <img src="img/3.png" alt="Mountain View" style="width: 50px;">
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">Not Available</h4>
						    <p>1-30%</p>
						  </div>
						</div>

					 </li>
					 </div>
					 </div>
					</div>	

			  	</div>

			  	<!-- start of content -->
			  	
			  	<div class="col-lg-10 down-fall">
			  	<div class="row">
				  	<div class="col-lg-10 padd-topping verdana">
				  		<h2 class="page-header">
	                        
	                        <?php 
	                        	include('config.php');
	                        	$labID = $_GET['labid'];

	                        	$TestingLabID = $_GET['testinglabid'];
	                        	$query1 = "SELECT LabName FROM lab WHERE LabID=".$labID."";
	                        	$result1=mysqli_query($dbcon, $query1);

								$query = "SELECT * FROM testinglab JOIN lab ON testinglab.LabID = lab.LabID WHERE TestingLabID =".$TestingLabID."";
								$result = mysqli_query($dbcon, $query);
								while($row = mysqli_fetch_array($result)) {
									echo "".$row['LabName']." <small>(".$row['TestingLabName'].""; 

					                    while ($rows=mysqli_fetch_array($result1)) {
					                    $labcon = $rows['LabName'];
					                    }

					                    if ($userlevel == 2) {
					                    	if ($lab == $labcon) {

											echo " <input type=button name=edit id=".$row["TestingLabID"]." class='edit_data_testlab edit-img-lab'>

									 		    <input type=button name=delete id=".$row["TestingLabID"]." class='delete_testlab delete-img-lab'>";
									 		}
					                    }
					                    if ($userlevel == 1) {
					                    	echo " <input type=button name=edit id=".$row["TestingLabID"]." class='edit_data_testlab edit-img-lab'>

									 		    <input type=button name=delete id=".$row["TestingLabID"]." class='delete_testlab delete-img-lab'>";
					                    }

									echo ")</small>";
								}
	                        ?> 
	                        
	                    </h2>
	                </div>

                     <div class="col-lg-2 page-header button-add-print" style="text-align: left;">
                     <?php echo "<a href='print_record.php?name=testlab&lab=".$labID."&testinglab=".$TestingLabID."' target='blank'>"; ?>
						<button type="button" class="btn btn-default col-lg-12 animatezoom" data-dismiss="modal"><i class="fa fa-print"></i> <b>Print Record</b></button>
					<?php echo "</a>" ?>
					</div>	
				</div>
			  			<ul class="nav nav-tabs responsive verdana" id="myTab">
			  			  <li class="green verdana"><a href="#one" data-toggle="tab" class="deco-none"><i class="fa fa-list-alt" style="font-size: 17px;"></i> List of Service</a></li>
						  <li class="blue verdana"><a href="#two" data-toggle="tab" class="deco-none"><i class="fa fa-flask" style="font-size: 18px;"></i> Inventory of Chemical</a></li>
						  <li class="lightblue verdana"><a href="#three" data-toggle="tab" class="deco-none"><i class="fa fa-wrench" style="font-size: 18px;"></i> List of Euipment</a></li>

						  <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" style="float: right;"> +  Add Record</button> -->

						 <!-- 
						<li role="presentation" class="dropdown">
						    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						      Dropdown <span class="caret"></span>
						    </a>
						    <ul class="dropdown-menu">
						      <li role="presentation" class="active"><a href="#">Home</a></li>
							  <li role="presentation"><a href="#">Profile</a></li>
							  <li role="presentation"><a href="#">Messages</a></li>
						    </ul>
						  </li> -->
						</ul>
					
						<div class="tab-content responsive verdana">
							<div class="tab-pane fade in active table-responsive" id="one">
								<table class="table table-hover table-striped" style="font-size: 14px;">
				                <thead>
				                <tr>
				                	<th><h4>Service Name</h4></th>
				                		<?php
					                    	include('config.php');

					                    	$labID = $_GET['labid'];

					                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

					                    	$result=mysqli_query($dbcon, $query);
					                    	while ($row=mysqli_fetch_array($result)) {
					                    		$labcon = $row['LabName'];
					                    	}

					                    	if ($userlevel == 2) {
					                    		if ($lab == $labcon) {
						                    ?>
						                      	<th style="width: 60px;"><h4>Edit</h4></th>
						                      	<th style="width: 60px;"><h4>Delete</h4></th>
						                    <?php
							                    }
					                    	}

					                    	if ($userlevel == 1) {
					                    	?>
					                    		<th style="width: 60px;"><h4>Edit</h4></th>
						                      	<th style="width: 60px;"><h4>Delete</h4></th>

					                    	<?php
					                    	}
						                ?>
				                </tr>
				                </thead>
									
								<?php
									include('config.php');

									$labID = $_GET['labid'];
									$TestingLabID = $_GET['testinglabid'];

									$query = "SELECT * FROM service WHERE TestingLabID=".$TestingLabID." ORDER BY ServiceName  ASC";
									$result = mysqli_query($dbcon, $query);

									echo "<tr>";

									while($row1 = mysqli_fetch_array($result)) { 
										
										echo "<td>".$row1['ServiceName']."</td>"; 

					                    $query2="SELECT LabName FROM lab WHERE LabID=".$labID."";
					                    $result2=mysqli_query($dbcon, $query2);
					                    	
					                    while ($row2=mysqli_fetch_array($result2)) {
					                    	$labcon = $row2['LabName'];
						                    }

						                    if ($userlevel == 2) {	
						                   		if ($lab == $labcon) {
						                   	?>
						                   		<td class="centered">

						                   		<input type="button" name="edit" id="<?php echo $row1["ServiceID"]; ?>" class="edit_data edit-img">

						                   		</td>
						                   		<td class=centered>
						                   		<input type="button" name="delete" class="deleteservices delete-img" id="<?php echo $row1["ServiceID"]; ?>">
						                   		</td>
						                   	<?php
						                   	}
						                   }

						                   if ($userlevel == 1) {
						                   	?>
						                   		<td class="centered">

						                   		<input type="button" name="edit" id="<?php echo $row1["ServiceID"]; ?>" class="edit_data edit-img">

						                   		</td>
						                   		<td class=centered>
						                   		<input type="button" name="delete" class="deleteservices delete-img" id="<?php echo $row1["ServiceID"]; ?>">
						                   		</td>
						                   	<?php
						                   }
						                
						                echo "</tr>";
						            }
						        ?>
								</table>

								<?php
			                    	include('config.php');

			                    	$labID = $_GET['labid'];

			                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

			                    	$result=mysqli_query($dbcon, $query);
			                    	while ($row=mysqli_fetch_array($result)) {
			                    		$labcon = $row['LabName'];
			                    	}

			                    	if ($userlevel == 2) {
			                    		if ($lab == $labcon) {
			                    	?>
			                    		<div class="add-button" data-toggle="modal" data-target="#AddServices">
										</div>
									<?php
			                    		}
			                    	}
			                    	if ($userlevel == 1) {
			                    	?>
			                    		<div class="add-button" data-toggle="modal" data-target="#AddServices">
										</div>
			                    	<?php
			                    	}
			                    ?>	

							</div>

							<div class="tab-pane fade table-responsive" id="two">	               
			                   <table class="table table-hover table-striped" style="font-size: 14px;">
								<thead>
								<tr>
									<th><h4>Chemical</h4></th>
									<th><h4>Description</h4></th>
									<th><h4>Location
									<?php
										$labID = $_GET['labid'];

					                    $query="SELECT LabName FROM lab WHERE LabID=".$labID."";

					                    $result=mysqli_query($dbcon, $query);
					                    while ($row=mysqli_fetch_array($result)) {

					                    $labcon = $row['LabName'];
					                	}

										if ($userlevel == 2) {
					                    	if ($lab == $labcon) {
						            ?>
						                  	<input type="button" class="add-location-lab" data-toggle="modal" data-target="#AddLocation"></h4></a>

					                <?php
						                	}
						                }

										if ($userlevel == 1) {
									?>
											<input type="button" name="add" class="add_location add-location-lab" data-toggle="modal" data-target="#AddLocation"></h4>


									<?php
										}
									?>
									</th>
									<th><h4>Availability</h4></th>
										<?php
					                    	include('config.php');

					                    	$labID = $_GET['labid'];

					                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

					                    	$result=mysqli_query($dbcon, $query);
					                    	while ($row=mysqli_fetch_array($result)) {
					                    		$labcon = $row['LabName'];
					                    	}
					                    	if ($userlevel == 2) {
					                    		if ($lab == $labcon) {
						                    ?>
						                      	<th style="width: 50px;"><h4>Edit</h4></th>
						                      	<th style="width: 50px;"><h4>Delete</h4></th>
					                    	<?php
						                    	}
						                	}
						                	if ($userlevel == 1) {
						                	?>
						                		<th style="width: 50px;"><h4>Edit</h4></th>
						                      	<th style="width: 50px;"><h4>Delete</h4></th>
						                	<?php
						                	}
						                ?>	
								</tr>
								</thead>
									<?php
										include('config.php');
										$labID = $_GET['labid'];
										$TestingLabID = $_GET['testinglabid'];

								        $query = "SELECT * FROM chemical JOIN statuschemical ON statuschemical.StatusChemID = chemical.StatusChemID JOIN location ON location.LocationID = chemical.LocationID WHERE TestingLabID=".$TestingLabID." ORDER BY ChemName ASC";

								        $result1 = mysqli_query($dbcon, $query);
								    ?>
								    <?php 
								    	while($row = mysqli_fetch_array($result1)) { ?>
								            <tr>
								              <td><?php echo $row['ChemName']; ?> </td>
								              <td><?php echo $row['Description']; ?> </td>
								               <td><?php echo $row['LocationName']; ?> </td>
								                <?php
								                	if ($row['StatusChemName'] == 'Not Available') { ?>
								                	<td style="width: 40px;">		
								                	<center><img src="img/unlike.png" width="40"><br>
								                	<small class="small-status">Not Available</small>
										            </center>
										            </td>
								                <?php
								                	}
								                	elseif ($row['StatusChemName'] == 'Available') { ?>

								                	<td>
								                	<center><img src="img/like.png" width="40"><br>
								                	<small class="small-status">Available</small>
										            </center>
								                	</td>
								                <?php
								                	}
								                	elseif ($row['StatusChemName'] == 'Warning') { ?>

								                	<td>
								                	<center><img src="img/warning.png" width="40"><br>
								                	<small class="small-status">Warning</small>
										            </center>
								                	</td>
								                <?php
								                	}
								                ?>
								                <?php
										        $query2="SELECT LabName FROM lab WHERE LabID=".$labID."";
							                    $result2=mysqli_query($dbcon, $query2);
							                    	
							                    while ($row2=mysqli_fetch_array($result2)) {
							                    	$labcon = $row2['LabName'];
												}
												if ($userlevel == 2) {
													if ($lab == $labcon) {
								                ?>
								                	<td class=centered>
								                	<input type="button" name="edit" id="<?php echo $row["ChemID"]; ?>" class="edit_data1 edit-img">
								                   </td>
								                   	<td class="centered">	
								                   	<input type="button" name="delete" class="deletechemical delete-img" id="<?php echo $row["ChemID"]; ?>">
								                   </td>
												     	
								                <?php
								            		}
								                }
								                if ($userlevel == 1) {
								                ?>
								                	<td class=centered>
								                	<input type="button" name="edit" id="<?php echo $row["ChemID"]; ?>" class="edit_data1 edit-img">
								                   </td>
								                   	<td class="centered">	
								                   	<input type="button" name="delete" class="deletechemical delete-img" id="<?php echo $row["ChemID"]; ?>">
								                   </td>

								                <?php
								                }
								                
								                ?>
								            </tr>

								    <?php } ?>

										
								</table>
								<?php
			                    	include('config.php');

			                    	$labID = $_GET['labid'];

			                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

			                    	$result=mysqli_query($dbcon, $query);
			                    	while ($row=mysqli_fetch_array($result)) {
			                    		$labcon = $row['LabName'];
			                    	}
			                    	if ($userlevel == 2) {
			                    		if ($lab == $labcon) {
			                    	?>
				                    	<div class="add-button chem" data-toggle="modal" data-target="#AddChemicals"></div>

				                    	
			                    <?php
			                    		}
			                    	}
			                    	if ($userlevel == 1) {
			                    	?>
			                    		<div class="add-button chem" data-toggle="modal" data-target="#AddChemicals"></div>

			                    		
			                    <?php
			                    	}
			                    ?>	

							</div>

							
							<div class="tab-pane fade table-responsive" id="three">
								<table class="table table-hover table-striped" style="font-size: 14px;">
								<thead>	
								<tr>
									<th><h4>Equipment</h4></th>
									<th><h4>Description</h4></th>
									<th><h4>Location
									<?php
										$labID = $_GET['labid'];

					                    $query="SELECT LabName FROM lab WHERE LabID=".$labID."";

					                    $result=mysqli_query($dbcon, $query);
					                    while ($row=mysqli_fetch_array($result)) {

					                    $labcon = $row['LabName'];
					                	}

										if ($userlevel == 2) {
					                    	if ($lab == $labcon) {
						            ?>
						                  	<input type="button" class="add-location-lab" data-toggle="modal" data-target="#AddLocation"></h4></a>

					                <?php
						                	}
						                }

										if ($userlevel == 1) {
									?>
											<input type="button" name="add" class="add_location add-location-lab" data-toggle="modal" data-target="#AddLocation"></h4>


									<?php
										}
									?>
									</th>
									<th style="width:7.5%;"><h4>Status</h4></th>
										<?php
					                    	include('config.php');

					                    	$labID = $_GET['labid'];

					                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

					                    	$result=mysqli_query($dbcon, $query);
					                    	while ($row=mysqli_fetch_array($result)) {
					                    		$labcon = $row['LabName'];
					                    	}
					                    	if ($userlevel == 2) {
					                    		if ($lab == $labcon) {
						                    ?>
						                      	<th style="width: 40px;"><h4>Edit</h4></th>
						                      	<th style="width: 40px;"><h4>Delete</h4></th>	
					                   	 	<?php
						                    	}
						                	}
						                	if ($userlevel == 1) {
						                	?>
						                      	<th style="width: 40px;"><h4>Edit</h4></th>
						                      	<th style="width: 40px;"><h4>Delete</h4></th>	

					                   	 	<?php
						                	}
						                ?>	
								</td>	
								</tr>
								</thead>
									<?php
										include('config.php');


									/*////////////////////////////		
										   $limit = 10;
										   $p = $_GET['p'];
									///////////////////////////

										   $labID = $_GET['labid'];
										   $TestingLabID = $_GET['testinglabid'];

									       $query = "SELECT * FROM equipment JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID JOIN location ON location.LocationID = equipment.LocationID WHERE TestingLabID=".$TestingLabID." ORDER BY EquipName ASC";



/////////////////////////////////////////////////////////////////////

									       if(!isset($p)){
											$offset = 0;
											}else if($p == '1'){
												$offset = 0;
											}else if($p <= '0'){
												$offset = 0;
												echo '<script>window.location = "./";</script>';
											}else {
												$offset = ($p - 1) * $limit;
											}

/////////////////////////////////////////////////////////////////////
									       $result1 = mysqli_query($dbcon, $query);

/////////////////////////////////////////////////////////////////////
									       $get_total = mysqli_num_rows($result1);

										   $total = ceil($get_total/$limit);*/

										    $qry = "SELECT * FROM equipment JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID JOIN location ON location.LocationID = equipment.LocationID WHERE TestingLabID=".$TestingLabID." ORDER BY EquipName ASC";

										    $inbox = mysqli_query($dbcon, $qry);

											// $rows = mysqli_num_rows($inbox);

//////////////////////////////////////////////////////////////////



									?>
									<?php 
									   	while($row = mysqli_fetch_assoc($inbox)) { ?>
									       	<tr>
									            <td><?php echo $row['EquipName']; ?> </td>
									            <td><?php echo $row['Description'];?> </td>
									            <td><?php echo $row['LocationName'];?> </td>
									            <?php
								                	if ($row['StatusEquipName'] == 'Not Functional') { ?>
								                	<td style="width: 40px;">		
								                	<center><img src="img/wrong.png" width="40"><br>
								                	<small class="small-status">Not Functional</small>
										            </center>
										            </td>
								                <?php
								                	}
								                	elseif ($row['StatusEquipName'] == 'Functional') { ?>

								                	<td>
								                	<center><img src="img/check.png" width="40"><br>
								                	<small class="small-status">Functional</small>
										            </center>
								                	</td>
								                <?php
								                	}
								             	elseif ($row['StatusEquipName'] == 'Defective') { ?>

								                	<td>
								                	<center><img src="img/warning.png" width="40"><br>
								                	<small class="small-status">Defective</small>
										            </center>
								                	</td>
								                <?php
								                	}
								                ?>
								        		 <?php
										        $query2="SELECT LabName FROM lab WHERE LabID=".$labID."";
							                    $result2=mysqli_query($dbcon, $query2);
							                    	
							                    while ($row2=mysqli_fetch_array($result2)) {	
							                    	$labcon = $row2['LabName'];
                                                }
                                                if ($userlevel == 2) {
                                                	if ($lab == $labcon) {
								                ?>
									                <td class="centered">
									                <input type="button" name="edit" id="<?php echo $row["EquipID"]; ?>" class="edit_data2 edit-img">
									               </td>
									                <td class="centered">
									               <input type="button" name="delete" class="deleteequip delete-img" id="<?php echo $row["EquipID"]; ?>">
									                </td>
								                <?php
								                   	}
								                }
								                if ($userlevel == 1) {
								                ?>
									                <td class="centered">
									                <input type="button" name="edit" id="<?php echo $row["EquipID"]; ?>" class="edit_data2 edit-img">
									               </td>
									                <td class="centered">
									               <input type="button" name="delete" class="deleteequip delete-img" id="<?php echo $row["EquipID"]; ?>">
									                </td>
								                <?php
								                }
								                ?>

									        </tr>
							
									<?php } ?>
													<!-- <td colspan="6"> -->
										        		<?php 
										    			/*if($get_total > $limit){
										    				for($i=1; $i<$total; $i++){
															echo ($i == $p) ? '<a>'.$i.'</a>' : '<a class=pagination href="?labid='.$labID.'&testinglabid='.$TestingLabID.'&p='.$i.'">'.$i.'</a>';
															}
										    			}*/
										    			?>
										        	<!-- </td> -->
								</table>
								<?php
			                    	include('config.php');

			                    	$labID = $_GET['labid'];

			                    	$query="SELECT LabName FROM lab WHERE LabID=".$labID."";

			                    	$result=mysqli_query($dbcon, $query);
			                    	while ($row=mysqli_fetch_array($result)) {
			                    		$labcon = $row['LabName'];
			                    	}
			                    	if ($userlevel == 2) {
			                    		if ($lab == $labcon) {
			                    	?>
				                    	<div class="add-button equip" data-toggle="modal" data-target="#AddEquipment">
				        				
										</div>
			                   	    <?php
			                    		}
			                    	}
			                    	if ($userlevel == 1) {
			                    	?>
				                    	<div class="add-button equip" data-toggle="modal" data-target="#AddEquipment">
				        				
										</div>
			                   	    <?php
			                    	}
			                    ?>	

							</div>
							
						</div>
						<script type="text/javascript">
						  (function($) {
						      fakewaffle.responsiveTabs(['xs', 'sm']);
						  })(jQuery);
						</script>
			    </div>
		    </div>

		   <!--  <div class="row verdana thumbnails" id="about" style="background-color: #f8f8f8;">
		    	<div class="col-lg-12 post" style="padding-bottom: 40px;">
		  			<center><h1 class="service-header">ABOUT</h1></center>
		  		</div>
		    	<div class="col-md-1" >
		    		
		    	</div>
		    	<div class="col-sm-6 col-md-3 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/nucleus.png" alt="Agency Services" class="thumbnail-img">
				      <div class="caption">
				        <h3 class="service-mini-header">Agency Services</h3>
				        <p class="segoe">A facility provided for customers to have an initial idea on the pricing for the desired tests and/or calibration in a specific agency.</p>
				      
				      </div>
				    </div>
				  </div>
				  <div class="col-sm-6 col-md-4 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/flask1.png" alt="Quotation Request" class="thumbnail-img">
				      <div class="caption">
				        <h3  class="service-mini-header">Quotation Request</h3>
				        <p class="segoe">Serves as an online information center that provides detailed instructions to customers for their test and calibration requirements.</p>
				   
				      </div>
				    </div>
				  </div>
				  <div class="col-sm-6 col-md-3 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/bulb.png" alt="Result Tracking" class="thumbnail-img">
				      <div class="caption">
				        <h3  class="service-mini-header">Result Tracking</h3>
				        <p class="segoe">A facility provided for customers to determine a real-time tracking of status for tests and/or calibration requested.</p>
				 
				      </div>
				    </div>
				  </div>
				  <div class="col-md-1">
				  	
				  </div>				 
		    </div> -->

		    <div class="row footer verdana" id="contact">
		    	<div class="col-lg-1"></div>
		    	<div class="col-lg-6 post">
		    		<!-- <div class="row" style="text-align: center;">
		    		<div class="col-lg-12">
		    			<img src="img/phil_seal.png" class="footer-img">
		    		</div>
		    		</div> -->
		    		<div class="row" style="text-align: left;">
		    		<div class="col-lg-4">
			    		<h4 class="page-header black-bordered">NAVIGATION</h4>
			    		<h5><a href="index.php" class="deco-none1">Home</a></h5>
			    		<h5>Laboratory Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$query = "SELECT * FROM lab WHERE UserLevelID = 2 ORDER BY LabName ASC";
									$result = mysqli_query($dbcon, $query);
								?>
								<?php 
									while($row = mysqli_fetch_array($result)) {
									echo "<li>
									<a class=deco-none1 href=index-lab.php?labid=".$row['LabID'].">".$row['LabName']."</a>
									</li>";
										 		} 
								?>
                            </ul>
                      
                        <h5><a href="index.php?logout=1" class="deco-none1 verdana">Logout</a></h5>
		    		</div>

		    		<div class="col-lg-4">
		    			<h4 class="page-header black-bordered">SERVICES</h4>
		    			<h5>Testing Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$LabID = $_GET['labid'];
									$TestingLabID=$_GET['testinglabid'];
									$query = "SELECT * FROM testinglab WHERE LabID=".$LabID." ORDER BY TestingLabName ASC";
									$result = mysqli_query($dbcon, $query);
								?>
								<?php 
									while($row = mysqli_fetch_array($result)) {
									echo "<li>
									<a href=index-testinglab.php?testinglabid=".$row['TestingLabID']."&labid=".$row['LabID']." class=deco-none1>".$row['TestingLabName']."</a>
									</li>";
										 		} 
								?>
                            </ul>
		    		</div>
		    		<div class="col-lg-4 verdana">
		    			<h4 class="page-header black-bordered verdana fadeInUp">CONTACTS</h4>
			    		<h5><i class="fa fa-phone"></i> (078) 396-0763  </h5>
			    		<h5><i class="fa fa-fax"></i> (078) 304-8654</h5>
                        <h5><a href="http://facebook.com/dostcagayanvalley/" class="deco-none1" target="blank"><i class="fa fa-facebook"></i>  @dostcagayanvalley</a></h5>
                        <h5><a href="http://www.google.com" class="deco-none1" target="blank"><i class="fa fa-google"></i>  dost02rstl@gmail.com</a></h5>
                        <h5><a href="http://region2.dost.gov.ph" class="deco-none1" target="blank"><i class="fa fa-globe"></i>  region2.dost.gov.ph</a></h5>
		    		</div>
		    		</div>
		    	</div>
		    	
		    	<div class="col-lg-4 post">
		    		<h4 class="page-header black-bordered verdana">MESSAGE US</h4>
					<form action="" method="post" name="frmNotification" id="frmNotification">
					<div class="form-group">
					  <input type="text" class="form-control" placeholder="Subject" required="" name="subject" id="subject">
					</div>
					<div class="form-group">
					  <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Message here"></textarea>
					</div>
					<div class="row">
					<div class="col-lg-12">
						<input type="submit" name="add" id="btn-send" class="btn btn-primary btn-block" value="SEND">
						<p>&nbsp;</p>
					</div>
					</div>
					</form>
		    	</div>
		    	<div class="col-lg-1"></div>
		    </div>
		    <div class="row footer1 verdana">
		    <div class="col-lg-12 post">
		    	<div class="col-lg-12">
		    		<center><div class="social-con-fb">
		    			<center><a href="http://facebook.com/dostcagayanvalley/" target="blank"><div class="button-link-fb"><img src="img/social-facebook.png" class="social-img"></div></a></center>
		    		</div>
		    		<div class="social-con-tw">
		    			<center><a href="http://twitter.com/" target="blank"><div class="button-link-tw"><img src="img/social-twitter.png" class="social-img"></div></a></center>
		    		</div>
		    		<div class="social-con-lk">
		    			<center><a href="http://google.com" target="blank"><div class="button-link-lk"><div class="button-link-lk"><img src="img/social-linkedin.png" class="social-img"></div></a></center>
		    		</div></center>

		    	</div>
		    	<center>
		    	<h5 style="color: #b6b6b6;">Department of Science and Technology<br>Laboratory Inventory System<br>&copy; 2017 All rights reserved.</h5></center>
		    </div>
		    </div>
		    </div>
	                      
		</div>

	</div>

	<style type="text/css">
		.show{
		     opacity:0;
		}
		.visible{
		     opacity:1;
		}
	</style>

	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.post').addClass("show").viewportChecker({
		    classToAdd: 'visible animated fadeInUp', // Class to add to the elements when they are visible
		    offset: 100    
		   });   
	});            
	</script>



<script src="assets/viewportchecker.js"></script>

<script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>

</body>
</html>
























  				<!-- Modal -->
				<div class="modal fade verdana" id="AddServices" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Service</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&testlab=".$testlabid."&name=services method=post>" ?>
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Service Name:</label>
				            <input type="text"  name="txtServiceName" class="form-control" placeholder="Enter ServiceName" required="">
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      <?php echo "</form>"; ?>
				    </div>
				  </div>
				</div>

				<!-- Modal for Add Location -->
				<div class="modal fade verdana" id="AddLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Location</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&testlab=".$testlabid."&name=location method=post>" ?>
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Location Name:</label>
				            <input type="text"  name="txtLocationName" class="form-control" placeholder="Enter LocationName" required="">
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      <?php echo "</form>"; ?>
				    </div>
				  </div>
				</div>

				<!-- Modal -->
				<div class="modal fade verdana" id="AddEquipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Equipment</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&testlab=".$testlabid."&name=equipment method=post>" ?>
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Equipment Name:</label>
				            <input type="text"  name="txtEquipName" class="form-control" placeholder="Enter Equipment Name" required="">
				          </div>
				           <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Brief Description:</label>
				           	<textarea type="text" name="txtEquipDescription" class="form-control textarea" placeholder="Equipment uses" rows="4"></textarea>
				          </div>
				          <div class="form-group">
				          <label for="recipient-name" class="control-label lg">Location:</label>
				          <?php
				          	include('config.php');
				          	$query="SELECT * FROM location GROUP BY LocationName DESC";
				          	$result=mysqli_query($dbcon, $query);

				          	echo "<select class='form-control' name='cboxLocation'>";

				          	while ($row=mysqli_fetch_array($result)) {
				          		echo "<option value=".$row['LocationID'].">".$row['LocationName']."</option>";
				          	}
				          	echo "</select>";
				          ?>
				          </div>
				          <div class="form-group">
				          <label for="recipient-name" class="control-label lg">Status:</label>
				          <?php
				          	include('config.php');
				          	$query="SELECT * FROM statusequipment";
				          	$result=mysqli_query($dbcon, $query);

				          	echo "<select class='form-control' name='cboxStatus'>";

				          	while ($row=mysqli_fetch_array($result)) {
				          		echo "<option value=".$row['StatusEquipID'].">".$row['StatusEquipName']."</option>";
				          	}
				          	echo "</select>";
				          ?>
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      <?php echo "</form>"; ?>
				    </div>
				  </div>
				</div>


				<!-- Modal -->
				<div class="modal fade verdana" id="AddChemicals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Chemical</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&testlab=".$testlabid."&name=chemicals method=post>" ?>
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Chemical Name:</label>
				            <input type="text"  name="txtChemicalName" class="form-control" placeholder="Enter Chemical Name" required="">
				          </div>
				           <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Brief Description:</label>
				           	<textarea type="text" name="txtChemicalDescription" class="form-control textarea" placeholder="Chemical uses" rows="4"></textarea>
				          </div>
				          <div class="form-group">
				          <label for="recipient-name" class="control-label lg">Location:</label>
				          <?php
				          	include('config.php');
				          	$query="SELECT * FROM location ORDER BY LocationName DESC";
				          	$result=mysqli_query($dbcon, $query);

				          	echo "<select class='form-control' name='cboxLocation'>";

				          	while ($row=mysqli_fetch_array($result)) {
				          		echo "<option value=".$row['LocationID'].">".$row['LocationName']."</option>";
				          	}
				          	echo "</select>";
				          ?>
				          </div>
				          <div class="form-group">
				          <label for="recipient-name" class="control-label lg">Status:</label>
				          <?php
				          	include('config.php');
				          	$query="SELECT * FROM statuschemical";
				          	$result=mysqli_query($dbcon, $query);

				          	echo "<select class='form-control' name='cboxStatus'>";

				          	while ($row=mysqli_fetch_array($result)) {
				          		echo "<option value=".$row['StatusChemID'].">".$row['StatusChemName']."</option>";
				          	}
				          	echo "</select>";
				          ?>
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      <?php echo "</form>"; ?>
				    </div>
				  </div>
				</div>


				<!-- Modal -->
				<div class="modal fade verdana" id="AddTestLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Testing Lab</h4>
				      </div>
				      <form action="#name=testlab" method="post">
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Testing Lab Name:</label>
				            <input type="text" name="txtTestLabName" class="form-control" placeholder="Enter TestingLabName" required="">
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

<script>  
 $(document).ready(function(){  
      $(document).on('click', '.deleteequip', function(){  
           var equip_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{equip_id:equip_id},  
                dataType:"json",  
                success:function(data){  
                	 $('#equip_id1').val(data.EquipID); 
                     $('#delete_equip_data_Modal').modal('show');  
                }  
           });  
      });  
 });  
 </script>


<!-- Modal for Delete Equipment  -->
<div id="delete_equip_data_Modal" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=delete.php?name=equipment&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Equipment</h4>  
                </div>  
                <div class="modal-body"> 
                		<div class="form-group">
                			Are you sure you want to delete data?
                		</div> 
                		
                          <input type="text" name="txtEquipID" id="equip_id1" class="form-control" style="display: none;"> 

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Delete" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>

 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.deletechemical', function(){  
           var chemical_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{chemical_id:chemical_id},  
                dataType:"json",  
                success:function(data){  
                	 $('#chem_id').val(data.ChemID); 
                     $('#delete_chem_data_Modal').modal('show');  
                }  
           });  
      });  
 });  
 </script>

<!-- Modal for Delete Chemical  -->
<div id="delete_chem_data_Modal" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=delete.php?name=chemical&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Chemicals</h4>  
                </div>  
                <div class="modal-body"> 
                		<div class="form-group">
                			Are you sure you want to delete data?
                		</div> 
                		
                          <input type="text" name="txtChemID" id="chem_id" class="form-control" style="display: none;"> 

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Delete" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>


 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.deleteservices', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                	 $('#service_id').val(data.ServiceID); 
                     $('#service_name').val(data.ServiceName); 
                     $('#delete_data_Modal').modal('show');  
                }  
           });  
      });  
 });  
 </script>


<!-- Modal for Delete Services  -->
<div id="delete_data_Modal" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=delete.php?name=services&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Services</h4>  
                </div>  
                <div class="modal-body"> 
                		<div class="form-group">
                			Are you sure you want to delete data?
                		</div> 
                		
                          <input type="text" name="txtServiceID" id="service_id" class="form-control" style="display: none;"> 

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Delete" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>



 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.delete_testlab', function(){  
           var testlab_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{testlab_id:testlab_id},  
                dataType:"json",  
                success:function(data){  
                	 $('#testlab_id').val(data.TestingLabID); 
                     $('#delete_data_Modal_TestLab').modal('show');  
                }  
           });  
      });  
 });  
 </script>


<!-- Modal for Delete Testing Lab  -->
<div id="delete_data_Modal_TestLab" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=delete.php?name=testlab&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Delete Testing Lab</h4>  
                </div>  
                <div class="modal-body"> 
                		<div class="form-group">
                			Are you sure you want to delete data?
                		</div> 
                		
                          <input type="text" name="txtTestLabID" id="testlab_id" class="form-control" style="display: none;"> 

                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Delete" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>

<!-- Modal for Edit-Service -->
<div id="add_data_Modal" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=edit.php?name=service&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Services</h4>  
                </div>  
                <div class="modal-body">  
                          <label>Service Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <input type="hidden" name="employee_id" id="employee_id" />  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Edit" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>

<!-- Modal for Edit-Testing-Lab -->
<div id="edit_data_Modal_TestLab" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$lab = $_GET['labid'];
           		$testlab = $_GET['testinglabid'];

        		echo "<form method='post' id='insert_form' action=edit.php?name=testlab&lab=".$lab."&testinglab=".$testlab.">";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Testing Lab</h4>  
                </div>  
                <div class="modal-body">  
                          <label>Testing Lab Name</label>  
                          <input type="text" name="name" id="name_testlab" class="form-control" />  
                          <br />  
                          <input type="hidden" name="testlab_id_edit" id="testlab_id_edit"/>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Edit" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>

 <!-- Modal for Edit_Chemical -->
 <div id="add_data_Modal1" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
        	<?php 
        	$lab = $_GET['labid'];

           	$testlab = $_GET['testinglabid'];

        	echo "<form method='post' id='insert_form' action=edit.php?name=chemical&lab=".$lab."&testinglab=".$testlab.">";
        	 ?>  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Chemical</h4>  
                </div>  
                <div class="modal-body">  
                		<div class="form-group">
                          <label>Chemical Name</label>  
                          <input type="text" name="name" id="name_chem" class="form-control" />
                        </div> 

                        <div class="form-group">
                          <label>Description</label>  
                          <textarea name="desc" id="name_desc" class="form-control" rows="4"></textarea>
                        </div>

                         <div class="form-group">
                          <label>Location</label>  
                         <!--  <input type="text" name="name" id="name_desc" class="form-control" />  -->
                         <?php
                          include('config.php');
                          $query="SELECT * FROM location ORDER BY LocationName DESC";
                          $result = mysqli_query($dbcon, $query);
                          echo "<select name='cboxLocation' class='form-control'>";
                          	while ($row=mysqli_fetch_array($result)) {
                          		echo "<option value=".$row['LocationID'].">".$row['LocationName']."</option>";
                          	}
                          echo "</select>";
                         ?>
   						</div>

                        <div class="form-group">
                          <label>Status</label>  
                         <!--  <input type="text" name="name" id="name_desc" class="form-control" />  -->
                         <?php
                          include('config.php');
                          $query="SELECT * FROM statuschemical";
                          $result = mysqli_query($dbcon, $query);
                          echo "<select name='cboxStat' class='form-control'>";
                          	while ($row=mysqli_fetch_array($result)) {
                          		echo "<option value=".$row['StatusChemID'].">".$row['StatusChemName']."</option>";
                          	}
                          echo "</select>";
                         ?>
   						</div>
                          <br />  
                          <input type="hidden" name="chemical_id" id="chemical_id" />  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert_chem" value="Update" class="btn btn-primary" />  
                </div>  
			  <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>  

 <!-- Modal for Edit_Equipment -->
 <div id="add_data_Modal2" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
        	<?php 
        	$lab = $_GET['labid'];
           	$testlab = $_GET['testinglabid'];

        	echo "<form method='post' id='insert_form' action=edit.php?name=equipment&lab=".$lab."&testinglab=".$testlab.">";
        	 ?> 
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Equipment</h4>  
                </div>  
                <div class="modal-body">  
                		<div class="form-group">
                          <label>Equipment Name</label>  
                          <input type="text" name="name" id="name_equip" class="form-control" />
                        </div> 

                        <div class="form-group">
                          <label>Description</label>  
                          <textarea name="desc" id="name_desc_equip" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                        <label>Location</label>  
                         <!--  <input type="text" name="name" id="name_desc" class="form-control" />  -->
                         <?php
                          include('config.php');
                          $query="SELECT * FROM location ORDER BY LocationName DESC";
                          $result = mysqli_query($dbcon, $query);
                          echo "<select name='cboxLocation' class='form-control'>";
                          	while ($row=mysqli_fetch_array($result)) {
                          		echo "<option value=".$row['LocationID'].">".$row['LocationName']."</option>";
                          	}
                          echo "</select>";
                         ?>
   						</div>

                        <div class="form-group">
                          <label>Status</label>  
                         <!--  <input type="text" name="name" id="name_desc" class="form-control" />  -->
                         <?php
                          include('config.php');
                          $query="SELECT * FROM statusequipment";
                          $result = mysqli_query($dbcon, $query);
                          echo "<select name='cboxStat' class='form-control'>";
                          	while ($row=mysqli_fetch_array($result)) {
                          		echo "<option value=".$row['StatusEquipID'].">".$row['StatusEquipName']."</option>";
                          	}
                          echo "</select>";
                         ?>
   						</div>
                          <br />  
                          <input type="hidden" name="equip_id" id="equip_id" />  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert_equip" value="Update" class="btn btn-primary" />  
                </div>  
			  <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>    
  

 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.ServiceName);   
                     $('#employee_id').val(data.ServiceID);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data1', function(){  
           var chemical_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{chemical_id:chemical_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name_chem').val(data.ChemName); 
                     $('#name_desc').val(data.Description);    
                     $('#chemical_id').val(data.ChemID);  
                     $('#insert_chem').val("Update");  
                     $('#add_data_Modal1').modal('show');  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data2', function(){  
           var equip_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{equip_id:equip_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name_equip').val(data.EquipName); 
                     $('#name_desc_equip').val(data.Description);    
                     $('#equip_id').val(data.EquipID);  
                     $('#insert_equip').val("Update");  
                     $('#add_data_Modal2').modal('show');  
                }  
           });  
      });  
 });  
 </script>
  <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data_testlab', function(){  
           var testlab_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{testlab_id:testlab_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name_testlab').val(data.TestingLabName); 
                     $('#testlab_id_edit').val(data.TestingLabID);  
                     $('#edit_data_Modal_TestLab').modal('show');  
                }  
           });  
      });  
 });  
 </script>

<!--  <script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script> -->

		<!-- Modal for Lab -->
				<div class="modal fade verdana" id="AddLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Laboratory</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&name=laboratorytestlab&testlab=".$testlab." method=post>" ?>
				      <div class="modal-body">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Laboratory Abbr. Name:</label>
				            <input type="text"  name="txtAbbrName" class="form-control" placeholder="Enter AbbreviationName" required="">
				          </div>
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Laboratory Full Name:</label>
				            <input type="text"  name="txtFullName" class="form-control" placeholder="Enter FullName" required="">
				          </div>
				           <div class="form-group">
				            <label for="recipient-name" class="control-label lg">User-Level Name:</label>
				           <?php
				           		include('config.php');

				           		$query = "SELECT * FROM userlevel WHERE UserLevelID = 2";
				           		$result = mysqli_query($dbcon, $query);
				           		echo "<select name='cboxUserLevel' class='form-control'>";
				           		while ($row = mysqli_fetch_array($result)) {
				           			echo "<option value=".$row['UserLevelID'].">".$row['UserLevelName']."</option>";
				           		}
				           		echo "</select>";
				           ?>
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
				      </div>
				      <?php echo "</form>"; ?>
				    </div>
				  </div>
				</div>
