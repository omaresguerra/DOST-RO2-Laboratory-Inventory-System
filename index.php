<?php include('server.php'); 
// if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])){
	header('location: login.php');
}

$userlevel = $_SESSION['userlevel']; 
$lab = $_SESSION['lab'];
$user = $_SESSION['user'];

$conn = new mysqli("localhost","root","","inventorysystem");
$count=0;

if(!empty($_POST['add'])) {
	$subject = mysqli_real_escape_string($conn,$_POST["subject"]);
	$comment = mysqli_real_escape_string($conn,$_POST["comment"]);
	$sql = "INSERT INTO comments (subject,comment,time,UserID) VALUES('" . $subject . "','" . $comment . "',now(), '".$user."')";
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

 	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="shortcut icon" href="img/dost-logo.png"/>
	
	<link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
	<!--<script src="js/responsive-tabs.js"></script>-->
	<link rel="stylesheet" type="text/css" href="assets/animate.css" />
	 <!--<link rel="stylesheet" type="text/css" href="assets/demo.css"/>-->

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

				            <input type="text" name="txtTestLabName" class="form-control" placeholder="Enter TestingLabName" required="" value="data">
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

				<!-- Modal for Message -->
				<div class="modal fade verdana" id="ViewMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h5 class="modal-title" id="myModalLabel">Message</h5>
				      </div>
				      <div class="modal-body">
				           	<h4><input name="txtSubject" id="txtSubjectComment" class="input-message" disabled><br><small><input type="text"  name="txtUser" id="txtUserSender" class="input-message" disabled><input type="text"  name="txtTime" id="txtTime" class="input-message" disabled></small></h4>
				           	 <h3><textarea name="txtSubject" id="txtComment" class="textarea-message" rows="4" disabled></textarea></h3>
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
				      <form action="edit.php?name=profile&lab=&testinglab=" method="POST">
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
				           	<input type="Password"  name="txtPassword" id="txtProfilePassword" class="form-control" required>
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




<body data-spy="scroll" data-target=".navbar" data-offset="30" id="top">
	<header class="col-lg-12 down-fall" id="home">
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

                            	
                                <li class="active"><a href="#home">Home</a>
                                </li>
                                <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Laboratory Services <b class="caret"></b></a>
									<ul class="dropdown-menu">
									<li>
										 <?php 
										 	include('config.php');
											$qry = "SELECT * FROM lab WHERE UserLevelID = 2 ORDER BY LabName ASC";
											$res = mysqli_query($dbcon, $qry);
											while ($rows=mysqli_fetch_array($res)) {
												
												echo "<li><a href=index-lab.php?labid=".$rows['LabID'].">
														".$rows['LabName']."</a></li>";
												
											}

											if ($userlevel == 1) {
											?>
										 		<center>
										 			<a href="#" data-toggle="modal" data-target="#AddLab"><i class="fa fa-plus"></i> Add Laboratory</a>
										 		</center>
										 	
										 	<?php
											}

										 ?>

                                    </ul>
                                </li>
                                <li class="dropdwon">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">About <b class="caret"></b></a>
									<ul class="dropdown-menu"  style="width: 200px;">
										<li><a href="#about"><i class="fa fa-globe"></i> Website</a></li>
										<li><a href="#developer"><i class="fa fa-user"></i> Developer</a></li>
									</ul>

                               
                                </li>
                                <li><a href="#contact">Contact</a>
                                </li>
                               
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
                                <?php
                            	} ?>
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


	  	<div id="page-wrapper down-fall">
		  	<div class="container-fluid">
		  	<div class="row">
		  		<div class="col-lg-12 slideleft">
		  			<div class="col-lg-6 verdana quote">
			  			<h3 class="line-height"><span><img src="img/quote.png" width="100" style="margin-top: -50px;"></span> If I may advice to the young laboratory workers, it would be this: Never to neglect an extraordinary appearance or happening." <br><small> - Alexander Fleming</small></h3>
			  		</div>
			  		<div class="col-lg-6 quote1">
			  			<img src="img/element.png" class="chem-elem">
			  		</div>
		  		</div>
		  	</div>

		    <div class="row verdana thumbnails" id="about" style="background-color: #f8f8f8;">
		    	<div class="col-lg-12 post about-index">
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
		    </div>

		    <div class="row verdana thumbnails" id="developer" style="background: #fff;">
		    	<div class="col-lg-12 post about-index">
		  			<center><h1 class="service-header">DEVELOPER</h1></center>
		  		</div>
		    	<div class="col-md-1" >
		    		
		    	</div>
		    	<div class="col-sm-6 col-md-3 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/omar.png" alt="Agency Services" class="thumbnail-img">
				      <div class="caption">
				        <h3 class="service-mini-header">omar_esguerra</h3>
				        <p class="segoe1">John Omar D. Esguerra<br>Antagan 1, Tumauini, Isabela<br>0910-440-0435<br>esguerrajohnomar@gmail.com</p>
				      
				      </div>
				    </div>
				</div>
				<div class="col-sm-6 col-md-4 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/nicole.png" alt="Agency Services" class="thumbnail-img">
				      <div class="caption">
				        <h3 class="service-mini-header">nicole_naval</h3>
				        <p class="segoe1">Nicole-Anne V. Naval<br>Pengue-Ruyu, Tuguegarao City, Cagayan<br>0997-238-8429<br>nicoledyosa110596@yahoo.com</p>
				      
				      </div>
				    </div>
				</div>
				<div class="col-sm-6 col-md-3 post">
				    <div class="thumbnail none-bordered">
				      <img src="img/angelica.png" alt="Agency Services" class="thumbnail-img">
				      <div class="caption">
				        <h3 class="service-mini-header">angel_taaca</h3>
				        <p class="segoe1">Angelica R. Taaca<br>Labben, Allacapan, Cagayan<br>0927-825-3180<br>mica051998@gmail.com</p>
				      
				      </div>
				    </div>
				</div>
				<div class="col-md-1">
				  	
				</div>		
		    </div>
 

		    <div class="row footer" id="contact">
		    	<div class="col-lg-1"></div>
		    	<div class="col-lg-6">
		    		<!-- <div class="row" style="text-align: center;">
		    		<div class="col-lg-12">
		    			<img src="img/phil_seal.png" class="footer-img">
		    		</div>
		    		</div> -->
		    		<div class="row" style="text-align: left;">
		    		<div class="col-lg-4 post">
			    		<h4 class="page-header black-bordered verdana fadeInUp">NAVIGATION</h4>
			    		<h5><a href="index.php" class="deco-none1 verdana">Home</a></h5>
			    		<h5 class="verdana">Laboratory Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;">
								<?php
									include('config.php');
									$query = "SELECT * FROM lab WHERE UserLevelID = 2";
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
                        <h5><a href="about.php" class="deco-none1 verdana">About</a></h5>
                        <h5><a href="index.php?logout=1" class="deco-none1 verdana">Logout</a></h5>
		    		</div>

		    		<div class="col-lg-4 post">
		    			<h4 class="page-header black-bordered verdana">SERVICES</h4>
		    			<h5 class="verdana">Testing Services</h5>
			    			<ul style="list-style-type: none; padding-left: 10px;" class="verdana">
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
		   
		    <div class="row footer1">
		    	<div class="col-lg-12 post">
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
		    	<h5 style="color: #b6b6b6;" class="verdana">Department of Science and Technology<br>Laboratory Inventory System<br>&copy; 2017 All rights reserved.</h5></center>
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
					jQuery('html').animate({scrollTop: 0}, duration);
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
	jQuery(document).ready(function() {
		jQuery('.slideleft').addClass("show").viewportChecker({
		    classToAdd: 'visible animated slideInLeft', // Class to add to the elements when they are visible
		    offset: 215   
		   }); 
		   // jQuery('.slideright').addClass("show").viewportChecker({
		   //  classToAdd: 'visible animated slideInRight', // Class to add to the elements when they are visible

		   //  offset: 215    
		   // });     
	});   
	// jQuery(document).ready(function() {
	// 	jQuery('.slideright').addClass("show").viewportChecker({
	// 	    classToAdd: 'visible animated slideInRight', // Class to add to the elements when they are visible
	// 	    offset: 215    
	// 	   });   
	// });            
	</script>

<script src="assets/viewportchecker.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --> <!-- We also need jQuery-->
<script src="js/jquery.bootstrap-responsive-tabs.min.js"></script>
</body>

</html>
<script>
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
</script>

			<!-- Modal for Lab -->
				<div class="modal fade verdana" id="AddLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header ">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add Laboratory</h4>
				      </div>
				      <?php echo "<form action=insert.php?lab=&name=laboratoryindex&testlab= method=post>" ?>
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

