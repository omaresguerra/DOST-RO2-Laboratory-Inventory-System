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

<body>
	<header>
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
	</header>
  	<div class="wrapper">
                <header1 class="navbar navbar-inverse navbar-fixed-top">
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
                                <li class="active"><a href="index.php">Home</a>
                                </li>
                                <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laboratory Services <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<?php
											include('config.php');
											$query = "SELECT * FROM lab";
											$result = mysqli_query($dbcon, $query);
										 ?>
										 <?php 
											while($row = mysqli_fetch_array($result)) {
											echo "<li>
											   <a href=index-lab.php?labid=".$row['LabID'].">".$row['LabName']."</a>
											   </li>";
										 		} 
										 ?>
                                    </ul>
                                </li>
                                <li><a href="#contact">About</a>
                                </li>
                                <li><a href="#about">Contact</a>
                                </li>
                                <!-- <li>
                                	<a data-toggle="modal" data-target="#myModal" style="cursor: pointer;">
								  	Login
									</a>
								</li> -->
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </header1>

		        <!-- Modal -->
				<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Login</h4>
				      </div>
				      <div class="modal-body">
				        <form action="#" method="post">
				          <div class="form-group">
				            <label for="recipient-name" class="control-label lg">Username:</label>
				            <input type="text" class="form-control" placeholder="Enter Username">
				          </div>
				          <div class="form-group">
				            <label for="message-text" class="control-label">Password:</label>
				            <input type="password" class="form-control" placeholder="Enter Password">
				          </div>
                            <font style="color: #337ab7;">Not a member yet? <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
							  Sign up<b class="caret"></b>
							</a></font>
                          
							<div class="collapse" id="collapseExample"><br>
							  
							   <div class="modal-body well">
							   	<h4 class="modal-title" id="myModalLabel">Register</h4><br>
							    <div class="form-group">
					            	<label for="message-text" class="control-label">Username:</label>
					            	<input type="text" class="form-control" placeholder="Enter Register Name">
					          	</div>
					          	<div class="form-group">
					            	<label for="message-text" class="control-label">Email:</label>
					            	<input type="password" class="form-control" placeholder="Enter Register Email">
					          	</div>
					          	<div class="form-group">
					            	<label for="message-text" class="control-label">Password:</label>
					            	<input type="password" class="form-control" placeholder="Enter Password">
					          	</div>
					          	<button type="button" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;</button>
							  </div>
							</div>
				        </form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;</button>
				      </div>
				    </div>
				  </div>
				</div>
 -->
	  	<div id="page-wrapper">
		  	<div class="container-fluid">
		  
		  	<div class="row">
			  	<div class="col-lg-2">
			  	<!-- <div class="list-group panel panel-default">
				  	<div class="panel-heading">Testing Laboratories</div> -->

				  		<!-- <?php
							/*include('config.php');

							$LabID = $_GET['labid'];
							$query = "SELECT * FROM testinglab WHERE LabID =".$LabID."";
							$result = mysqli_query($dbcon, $query);
						?>
						<?php 
							while($row = mysqli_fetch_array($result)) {
							echo "
								<a class=list-group-item href=index.php?labid=".$row['TestingLabID'].">".$row['TestingLabName']."</a>
							";
							} */
						?>-->
			  	<!-- </div> -->
			  	</div>
			  	
			  	<div class="col-lg-10">
			  		<h2 class="page-header">
                        All Records 

                    </h2>
			  			<ul class="nav nav-tabs responsive" id="myTab">
			  			  <li class="active"><a href="#one" data-toggle="tab" class="deco-none">Services</a></li>
						  <li><a href="#two" data-toggle="tab" class="deco-none">Inventory of Chemicals</a></li>
						  <li><a href="#three" data-toggle="tab" class="deco-none">List of Euipments</a></li>

						  <!--  <button type="button" class="btn btn-primary" data-dismiss="modal" style="float: right;"> +  Add Record</button> -->

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
						<div class="tab-content responsive">
							<div class="tab-pane fade in active table-responsive" id="one">
								<table class="table table-hover table-striped">
				                <thead>
				                <tr>
				                	<th><h4>Service Name</h4></th>
				                </tr>
				                </thead>
									
								<?php
									include('config.php');
									$query = "SELECT * FROM service GROUP BY ServiceName  ASC";
									$result = mysqli_query($dbcon, $query);
								 ?>
									<?php 
									 while($row = mysqli_fetch_array($result)) { ?>
									    <tr>
									      <td><?php echo $row['ServiceName']; ?> </td>
									    </tr>
									<?php } ?>
								</table>
							</div>

							<div class="tab-pane fade table-responsive" id="two">	               
			                   <table class="table table-hover table-striped ">
								<thead>
								<tr>
									<th><h4>Chemicals</h4></th>
									<th><h4>Description</h4></th>
									<th><h4>Location</h4></th>
									<th><h4>Status</h4></th>	
								</tr>
								</thead>
									<?php
										include('config.php');

								        $query = "SELECT * FROM chemical JOIN statuschemical ON statuschemical.StatusChemID = chemical.StatusChemID JOIN location ON location.LocationID = chemical.LocationID GROUP BY ChemName ASC";

								        $result1 = mysqli_query($dbcon, $query);
								    ?>
								    <?php 
								    	while($row = mysqli_fetch_array($result1)) { ?>
								            <tr>
								              <td><?php echo $row['ChemName']; ?> </td>
								              <td><?php echo $row['Description']; ?> </td>
								               <td><?php echo $row['LocationName']; ?> </td>
								                <?php
								                	if ($row['StatusChemName'] == 'Critical') { ?>
								                	<td class=red>		
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #d9534f;">
							                    		
							    							Not Available
							                    		</div>
										            </div>
										            </td>
								                <?php
								                	}
								                	elseif ($row['StatusChemName'] == 'Safe') { ?>

								                	<td>
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width: 100%; background-color: #5cb85c;">Available
							                    		</div>
										            </div>
								                	</td>
								                <?php
								                	}
								                	elseif ($row['StatusChemName'] == 'Moderate') { ?>

								                	<td>
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width: 100%; background-color: #f0ad4e; "> Warning
							                    		</div>
										            </div>
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
									<td><h4>Equipments</h4></td>
									<td><h4>Description</h4></td>
									<td><h4>Location</h4></td>
									<td style="width: 160px;"><h4>Status</h4>
								</td>	
								</tr>
								</thead>
									<?php
										include('config.php');

									       $query = "SELECT * FROM equipment JOIN statusequipment ON statusequipment.StatusEquipID = equipment.StatusEquipID JOIN location ON location.LocationID = equipment.LocationID";

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
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #d9534f;">
							                    		Not Functioning
							                    		</div>
										            </div>
										            </td>
								                <?php
								                	}
								                	elseif ($row['StatusEquipName'] == 'Functional') { ?>

								                	<td>
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width: 100%; background-color: #5cb85c;">Functioning
							                    		</div>
										            </div>
								                	</td>
								                <?php
								                	}
								             	elseif ($row['StatusEquipName'] == 'Under Construction') { ?>

								                	<td>
								                	<div class="progress">
							                    		<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width: 100%; background-color: #f0ad4e; ">Under Construction
							                    		</div>
										            </div>
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
		    <div class="row footer">
		    	<div class="col-lg-1"></div>
		    	<div class="col-lg-6">
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
									$query = "SELECT * FROM lab";
									$result = mysqli_query($dbcon, $query);
								?>
								<?php 
									while($row = mysqli_fetch_array($result)) {
									echo "<li>
									<a href=index-lab.php?labid=".$row['LabID']." class=deco-none1>".$row['LabName']."</a>
									</li>";
										 		} 
								?>
                            </ul>
                        <h5><a href="about.php" class="deco-none1">About</a></h5>
                        <h5><a href="about.php" class="deco-none1">Contact</a></h5>
                        <!-- <h5><a data-toggle="modal" data-target="#myModal" style="cursor: pointer;" class="deco-none1">Login</a></h5> -->
		    		</div>

		    		<div class="col-lg-4">
		    			<h4 class="page-header black-bordered">SERVICES</h4>
		    			<h5>Testing Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$query = "SELECT * FROM testinglab GROUP BY TestingLabName";
									$result = mysqli_query($dbcon, $query);
								?>
								<?php 
									while($row = mysqli_fetch_array($result)) {
									echo "<li>
									".$row['TestingLabName']."
									</li>";
										 		} 
								?>
                            </ul>
		    		</div>
		    		<div class="col-lg-4 footer-phil-seal">
		    			<img src="img/phil_seal.png" class="footer-philseal-img"><br>All content is public domain unless otherwise stated.
		    		</div>
		    		</div>
		    	</div>
		    	
		    	<div class="col-lg-4 footer">
		    		<form action="" method="POST">
		    		<div class="form-group">
					  <input type="text" class="form-control" id="usr" placeholder="Name">
					</div>
					<div class="form-group">
					  <input type="password" class="form-control" id="pwd" placeholder="Email address">
					</div>
					<div class="form-group">
					  <textarea class="form-control" rows="5" id="comment" placeholder="Message here"></textarea>
					</div>
					<div class="row">
					<div class="col-lg-12">
						<button type="button" class="btn btn-primary btn-block">SEND</button>
					</div>
					</div>
					</form>
		    	</div>
		    	<div class="col-lg-1"></div>
		    </div>
		    <div class="row footer1">
		    	<div class="col-lg-12">
		    		<center><div class="social-con-fb">
		    			<center><div class="button-link-fb"><img src="img/social-facebook.png" class="social-img"></div></center>
		    		</div>
		    		<div class="social-con-tw">
		    			<center><div class="button-link-tw"><img src="img/social-twitter.png" class="social-img"></div></center>
		    		</div>
		    		<div class="social-con-lk">
		    			<center><div class="button-link-lk"><img src="img/social-linkedin.png" class="social-img"></div></center>
		    		</div></center>

		    	</div>
		    	<center>
		    	<h5 style="color: #b6b6b6;">Department of Science and Technology<br>Laboratory Inventory System<br>&copy; 2017 All rights reserved.</h5></center>
		    </div>
		    </div>
	                      
		</div>

	</div>
<script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>
</body>
</html>
