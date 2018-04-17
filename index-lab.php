<?php include('server.php'); 
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])){
	header('location: login.php');
}
	$lab = $_SESSION['lab'];
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

	<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
	<link rel="stylesheet" type="text/css" href="assets/animate.css" />

	<!-- <link rel="stylesheet" type="text/css" href="linkeffects/normalize.css" />
	<link rel="stylesheet" type="text/css" href="linkeffects/demo.css" />
	<link rel="stylesheet" type="text/css" href="linkeffects/component.css" /> -->
	<!-- <script src="linkeffects/modernizr.custom.js"></script> -->

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
 	 <script>  
 $(document).ready(function(){  
      $(document).on('click', '.edit_data_lab', function(){  
           var lab_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch_record.php",  
                method:"POST",  
                data:{lab_id:lab_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name_lab').val(data.LabName); 
                     $('#fname_lab').val(data.LabFullName); 
                     $('#lab_id_edit').val(data.LabID);  
                     $('#edit_data_Modal_Lab').modal('show');  
                }  
           });  
      });  
 });  
 </script>
 <!-- Modal for Edit-Lab -->
<div id="edit_data_Modal_Lab" class="modal fade verdana">  
      <div class="modal-dialog">  
           <div class="modal-content"> 
           <?php
           		$labid = $_GET['labid'];

        		echo "<form method='post' id='insert_form' action=edit.php?name=lab&lab=".$labid."&testinglab=>";
        	?>
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit Labpratory</h4>  
                </div>  
                <div class="modal-body">  
                          <label>Lab AbbrName</label>  
                          <input type="text" name="name" id="name_lab" class="form-control" /> 
                          <label>Lab FullName</label>  
                          <input type="text" name="fname" id="fname_lab" class="form-control" />  
                          <br />  
                          <input type="hidden" name="lab_id_edit" id="lab_id_edit"/>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      <input type="submit" name="insert" id="insert" value="Edit" class="btn btn-primary" />  
                </div>  
			 <?php echo"</form>"; ?>  
           </div>  
      </div>  
 </div>
	
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
					       <h4><input type="text" name="txtSubject" id="txtSubjectComment" class="input-message" disabled><br><small><input type="text"  name="txtUser" id="txtUserSender" class="input-message" disabled><input type="text"  name="txtTime" id="txtTime" class="input-message" disabled></small></h4>
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
				      <form action="edit.php?name=profile-lab&lab=<?php echo $_GET['labid']; ?>&testinglab=" method="POST">
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
	<header class="col-lg-12 down-fall" id="#top">
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
  				<!-- Modal -->
				<div class="modal fade verdana" id="AddTestLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Testing Lab</h4>
				      </div>
				      <form action="" method="post" name="frmUser">
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
											$query = "SELECT * FROM lab WHERE UserLevelID=2 ORDER BY LabName ASC";
											$result = mysqli_query($dbcon, $query);
										 ?>
										 <?php 
											while($row = mysqli_fetch_array($result)) {
											echo "<li>
											   <a href=index-lab.php?labid=".$row['LabID'].">".$row['LabName']."</a>
											   </li>";
										 	}

										 	if ($userlevel == 1){
										 	?>
										 
										 			<center>
										 				<a href="#"  data-toggle="modal" data-target="#AddLab"><i class="fa fa-plus"></i> Add Laboratory</a>
										 			</center>
										 	
										 	<?php
										 	}

										 ?>
                                    </ul>
                                </li>
<!--                                 <li><a href= "#about">About</a>
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
	  	<div id="page-wrapper">
		  	<div class="container-fluid">
		  	<div class="row">
			  	<div class="col-lg-2 padding-welcome post">
			  	<div class="row">
			  	<div class="col-lg-12">
			  		<?php if(isset($message)) { echo $message; } ?>
			  	</div>
			  		
			  	</div>
			  	<div class="row">
			  		<div class="col-lg-12 post">
			  			<div class="list-group panel panel-default" style="font-family: Verdana; font-size: 14px;">
					  	<div class="panel-heading" style=" border-radius:0px;"><b>Testing Laboratories</b></div>

				  		<?php
							include('config.php');

							$LabID = $_GET['labid'];
							$query = "SELECT * FROM testinglab WHERE LabID =".$LabID." ORDER BY TestingLabName ASC";
							$result = mysqli_query($dbcon, $query);
						?>
						<?php 
							while($row = mysqli_fetch_array($result)) {
							echo "
								<a class=list-group-item  href=index-testinglab.php?labid=".$row['LabID']."&testinglabid=".$row['TestingLabID'].">".$row['TestingLabName']."</a>
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

                    	if ($userlevel == 2){
	                    	if ($lab == $labcon) {
	                    		
		                ?>
					  		<div class="col-lg-12  animatezoom" style="margin-top: -10px;">
					  			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#AddTestLab" style="margin-bottom: 40px; font-family: Verdana; font-size: 13px; width: 100%;"><i class="fa fa-plus"></i> <b>Add Testing Lab</b></button>
					  		</div>
					  		<?php
		                    	}	
                    	}

                    	elseif ($userlevel == 1) {
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
					 
					 </div >
					 </div>
					</div>	
			 <!--  	<div class="row">
			  		<div class="col-lg-12">
			  			<img src="img/onelab.png" style="width: 100%;">
			  		</div>
			  	</div>
			  	<div class="row">
				  	<div class="col-lg-12">
				  		<img src="img/DOST-Science and Technology Information Institute.png"  style="width: 100%;">
				  	</div>
			  	</div> -->
			  	</div>
			  	
			  	<div class="col-lg-10 post">
			  		<div class="row">
					<div class="col-lg-10 padd-topping">
				  		<h2 class="page-header verdana">
	                        <?php 
	                        	include('config.php');
	                        	$LabID = $_GET['labid'];
								$query = "SELECT * FROM lab WHERE LabID =".$LabID."";
								$result = mysqli_query($dbcon, $query);
								while($row = mysqli_fetch_array($result)) {
									echo "".$row['LabName']." <small>(".$row['LabFullName']."";
										if ($userlevel == 1) {
											echo " <input type=button name=edit id=".$row["LabID"]." class='edit_data_lab edit-img-lab'>";
										}

									echo ") <b>All Records</b></small>";
									
								}
	                        ?> 
	                    </h2>
                    </div>
                    <div class="col-lg-2 page-header button-add-print" style="text-align: left;">
                  		
                  		<?php echo "<a href='print_record.php?name=allrecords&lab=".$labID."' target='blank'>"; ?>
						<button type="button" class="btn btn-default col-lg-12 animatezoom" data-dismiss="modal"><i class="fa fa-print"></i> <b>Print Record</b></button>
						<?php echo "</a>" ?>

					</div>
                    </div>
			  			<ul class="nav nav-tabs responsive verdana" id="myTab">
			  			  <li class="active green verdana"><a href="#one" data-toggle="tab" class="deco-none"><i class="fa fa-list-alt" style="font-size: 17px;"></i> List of Service</a></li>
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
								<table class="table table-hover table-striped">
				                <thead>
				                <tr>
				                	<th><h4>Service Name</h4></th>
				               
				                </tr>
				                </thead>
									
								<?php
									include('config.php');

									$LabID = $_GET['labid'];

									$query = "SELECT * FROM service JOIN testinglab ON testinglab.TestingLabID=service.TestingLabID WHERE LabID=".$LabID." ORDER BY ServiceName  ASC";

									$result = mysqli_query($dbcon, $query);
								 ?>
									<?php 
									 while($row = mysqli_fetch_array($result)) { ?>
									    <tr>
									      <td><?php echo $row['ServiceName']; ?></td>
									     
									    </tr>
									    
									<?php } ?>

								</table>
			 					
							</div>

							<div class="tab-pane fade table-responsive" id="two">	               
			                   <table class="table table-hover table-striped ">
								<thead>
								<tr>
									<th><h4>Chemical</h4></th>
									<th><h4>Description</h4></th>
									<th><h4>Location</h4></th>
									<th><h4>Availability</h4></th>	
								</tr>
								</thead>
									<?php
										include('config.php');

										$LabID = $_GET['labid'];

								        $query = "SELECT * FROM chemical JOIN statuschemical ON statuschemical.StatusChemID = chemical.StatusChemID JOIN location ON location.LocationID = chemical.LocationID JOIN testinglab ON testinglab.TestingLabID = chemical.TestingLabID WHERE LabID=".$LabID." ORDER BY ChemName ASC";

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
								            </tr>

								    <?php } ?>

										
								</table>
							</div>
							<div class="tab-pane fade table-responsive" id="three">
								<table class="table table-hover table-striped">
								<thead>	
								<tr>
									<td><h4>Equipment</h4></td>
									<td><h4>Description</h4></td>
									<td><h4>Location</h4></td>
									<td style="width: 90px;"><h4>Status</h4>
								</td>	
								</tr>
								</thead>
									<?php
										include('config.php');

										   $LabID = $_GET['labid'];

									       $query = "SELECT * FROM equipment JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID JOIN location ON location.LocationID = equipment.LocationID JOIN testinglab ON testinglab.TestingLabID = equipment.TestingLabID WHERE LabID=".$LabID." ORDER BY EquipName ASC";

									       $result1 = mysqli_query($dbcon, $query);
									?>
									<?php 
									   	while($row = mysqli_fetch_array($result1)) { ?>
									       	<tr>
									            <td><?php echo $row['EquipName']; ?> </td>
									            <td class="desc"><?php echo $row['Description'];?> </td>
									            <td><?php echo $row['LocationName'];?> </td>
									            <?php
								                	if ($row['StatusEquipName'] == 'Not Functional') { ?>
								                	<td>		
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
									        </tr>
									<?php } ?>

								</table>
							</div>
							
						</div>
						<script type="text/javascript">
						  (function($) {
						      fakewaffle.responsiveTabs(['xs', 'sm']);
						  })(jQuery);
						</script>

					<!-- 
			  		<div class="row">
	                    <div class="col-lg-12">
	                        <h1 class="page-header">
	                            Tables
	                        </h1>
	                        <ol class="breadcrumb">
	                            <li>
	                               <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
	                            </li>
	                            <li class="active">
	                               <i class="fa fa-table"></i> Tables
	                            </li>
	                        </ol>
	                    </div>
	                </div>
	                -->
			    </div>
		    </div>

		  <!--   <div class="row verdana thumbnails" id="about" style="background-color: #f8f8f8;">
		    	<div class="col-lg-12 post" style="padding-bottom: 20px;">
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
		    	<div class="col-lg-6">
		    		<!-- <div class="row" style="text-align: center;">
		    		<div class="col-lg-12">
		    			<img src="img/phil_seal.png" class="footer-img">
		    		</div>
		    		</div> -->
		    		<div class="row" style="text-align: left;">
		    		<div class="col-lg-4 post">
			    		<h4 class="page-header black-bordered">NAVIGATION</h4>
			    		<h5><a href="index.php" class="deco-none1">Home</a></h5>
			    		<h5>Laboratory Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$query = "SELECT * FROM lab WHERE UserLevelID=2 ORDER BY LabName ASC";
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

		    		<div class="col-lg-4 verdana post">
		    			<h4 class="page-header black-bordered">SERVICES</h4>
		    			<h5>Testing Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$LabID=$_GET['labid'];
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
		    		<div class="col-lg-4 verdana post">
		    			<h4 class="page-header black-bordered verdana fadeInUp">CONTACTS</h4>
			    		<h5><i class="fa fa-phone"></i> (078) 396-0763  </h5>
			    		<h5><i class="fa fa-fax"></i> (078) 304-8654</h5>
                        <h5><a href="http://facebook.com/dostcagayanvalley/" class="deco-none1" target="blank"><i class="fa fa-facebook"></i>  @dostcagayanvalley</a></h5>
                        <h5><a href="http://www.google.com" class="deco-none1" target="blank"><i class="fa fa-google"></i>  dost02rstl@gmail.com</a></h5>
                        <h5><a href="http://region2.dost.gov.ph" class="deco-none1" target="blank"><i class="fa fa-globe"></i>  region2.dost.gov.ph</a></h5>
		    		</div>
		    		</div>
		    	</div>
		    	
		    	<div class="col-lg-4 verdana post">
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
		    <div class="col-lg-12  post">
		    	<div class="col-lg-12">
		    		<center><div class="social-con-fb">
		    			<center><a href="http://facebook.com/dostcagayanvalley/" target="blank"><div class="button-link-fb"><img src="img/social-facebook.png" class="social-img"></div></a></center>
		    		</div>
		    		<div class="social-con-tw">
		    			<center><a href="http://twitter.com/" target="blank"><div class="button-link-tw"><img src="img/social-twitter.png" class="social-img"></div></a></center>
		    		</div>
		    		<div class="social-con-lk">
		    			<center><a href="http://google.com" target="blank"><div class="button-link-lk"><img src="img/social-linkedin.png" class="social-img"></div></a></center>
		    		</div></center>

		    	</div>
		    	<center>
		    	<h5 style="color: #b6b6b6;">Department of Science and Technology<br>Laboratory Inventory System<br>&copy; 2017 All rights reserved.</h5></center>
		    </div>
		    </div>
		    </div>
	                      
		</div>

	</div>
	<a href="#top" class="back-to-top">
	<div class="top-con"><img src="img/top.png" class="top" title="Back to top"></div></a>
	<script> 
			jQuery(document).ready(function() {
				var offset = 220;
				var duration = 500;
				jQuery(window).scroll(function() {
					if (jQuery(this).scrollTop() > offset) {
						jQuery('.back-to-top').fadeIn(duration);
					} else {
						jQuery('.back-to-top').fadeOut(duration);
					}
				});
				
				jQuery('.back-to-top').click(function(event) {
					event.preventDefault();
					jQuery('html, body').animate({scrollTop: 0}, duration);
					return false;
				})
			});
		</script>

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

			<!-- Modal for Lab -->
				<div class="modal fade verdana" id="AddLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Laboratory</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=".$labid."&name=laboratory&testlab= method=post>" ?>
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