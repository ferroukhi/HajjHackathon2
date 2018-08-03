<!DOCTYPE html>
<html>
<?php 

	require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
	
	session_start();
	
	if(empty($_SESSION['loggedin']) or empty($_SESSION['idUsername']))
	{
		header("Location:login.php");
		exit();
	}
	
	if($_SESSION['loggedin'] != 1)
	{
		header("Location:login.php");
		exit();
	}
	
	
	
	$userDetail = mysql_query("SELECT * FROM users WHERE id = ".$_SESSION['idUsername']." ");
	
	$firstname = "";
	$lastname = "";
	$usertype = "";
	
	if(mysql_num_rows($userDetail) == 1)
	{
		$row = mysql_fetch_array($userDetail);
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$usertype = $row['fkusertype'];
	}
	
	$patientID = $_GET["patient"];
	$patientInfoQuery = mysql_query("SELECT * FROM patients WHERE id = '".$patientID."'");
	if(mysql_num_rows($patientInfoQuery) == 1)
	{
		
		$row = mysql_fetch_array($patientInfoQuery);
		$country = $row['fkCountry'];
		$passeportnumber = $row['passeport'];
		$firstname = $row['firstName'];
		$lastname = $row['lastName'];
		$age = $row['age'];
		$gender = $row['gender'];
		$height = $row['height'];
		$weight = $row['weight'];
		$blood = $row['bloodgroup'];
	}
	
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>E-PatientCare | Home</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
	
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">E<b> - PatientCare</b></a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $firstname." ".$lastname ; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
							<li><a href="logout.php"><i class="material-icons">input</i>Logout</a></li>	
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
					<li class="active">
                        <a href="firstdoc.php">
                            <i class="material-icons">view_list</i>
                            <span>Hajj List</span>
                        </a>
					</li>
                    </li>	
					
                    </li>					
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; Hajj Hackathon 2018 <a href="javascript:void(0);"> E<b> - PatientCare</b> </br> Ensure good health monitorings </a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Patient informations</h2>
            </div>
			
			</br>
			</br>
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Patient informations
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" method="POST" action="addnewpatient.php">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="country">Country : </label> <?php echo $country;?>
                                    </div>                                     
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="passeportnumber">Passport number : </label> <?php echo $passeportnumber;?>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="firstname">First Name : </label> <?php echo $firstname;?>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="lastname">Last Name : </label> <?php echo $lastname;?>
                                    </div>
                                    
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="age">Age : </label> <?php echo $age;?>
                                    </div>
                                    
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="gender">Gender : </label> <?php echo $gender;?>
                                    </div>
                                    
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="height">Height : </label> <?php echo $height;?>
                                    </div>
                                    
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="weight">Weight : </label><?php echo $weight;?>
                                    </div>
                                    
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="blood">Blood group : </label> <?php echo $blood;?>
                                    </div>
                                    
                                </div>
								
								
								<?php 
								
									if(!empty($_POST['country']) && !empty($_POST['passeportnumber']) && !empty($_POST['firstname']))
									{
										$country = mysql_real_escape_string($_POST['country']);
										$passeportnumber = mysql_real_escape_string($_POST['passeportnumber']);
										$firstname = mysql_real_escape_string($_POST['firstname']);
										$lastname = mysql_real_escape_string($_POST['lastname']);
										$age = mysql_real_escape_string($_POST['age']);
										$gender = mysql_real_escape_string($_POST['gender']);
										$height = mysql_real_escape_string($_POST['height']);
										$weight = mysql_real_escape_string($_POST['weight']);
										$blood = mysql_real_escape_string($_POST['blood']);
										
										$id = $country.$passeportnumber ;
										
										$checkIdIfExist = mysql_query("SELECT * FROM patients WHERE id = '".$id."'");
									
										if(mysql_num_rows($checkIdIfExist) == 1)
										{
											echo "<div class='msg' style='color:red'> This patient exist in our database please check list !! </div>";
										}
										else
										{	
											$insertPatient = mysql_query("INSERT INTO patients (id, passeport,firstName,lastName,age,fkCountry,height,weight,gender,bloodgroup) VALUES ('".$id."', '".$passeportnumber."', '".$firstname."', '".$lastname."', '".$age."', '".$country."', '".$height."', '".$weight."', '".$gender."', '".$blood."' )");
											echo "<div class='msg' style='color:red'> Done".$insertPatient." </div>";
										}
									}
								?>
								
							</form>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add consultation
                            </h2>
                        </div>
                        <div class="body">
						<form class="form-horizontal" method="POST" action="patientinfoconsult.php?patient=<?php echo $patientID; ?>">
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="modality">Illness </label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<select id="modality" name="modality" class="form-control show-tick">
												<option value="">-- Please select --</option>
												<?php 
								
													$allModality = mysql_query("SELECT * FROM modality ");
													while ($row = mysql_fetch_assoc($allModality)) 
													{
														echo " <option value='".$row['id']."'>".$row['modalityName']."</option> ";
													
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>

								
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="description">Description </label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<textarea rows="4" class="form-control no-resize" id="description" name="description" placeholder="Please type what you want..."></textarea>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row clearfix">
                                
								<input type="submit" class="btn btn-primary btn-lg waves-effect" value="Add consultation" style="float: right; margin-right: 50px;" />
								
							</div>
							
							<?php 
								
								if(!empty($_POST['description']))
								{
									$description = mysql_real_escape_string($_POST['description']);
									$modality = mysql_real_escape_string($_POST['modality']);
									$date = date("Y-m-d");
									$time = date("h:i:sa");
									
									$insertConsultation = mysql_query("INSERT INTO medicalconsultation (fkhaj ,date ,time ,note ,fkstate  ) VALUES ('".$patientID."', '".$date."', '".$time."', '".$description."', '".$modality."' )");	
									echo "<meta http-equiv='refresh' content='0'>";
								}
							?>
						</form>		
						</div>
                    </div>
                </div>
            </div>
			
			<?php 
								
				$allConsultation = mysql_query("SELECT * FROM medicalconsultation mc JOIN modality m ON mc.fkstate = m.id  WHERE fkhaj = ".$patientID);
				while ($row = mysql_fetch_assoc($allConsultation)) 
				{
					echo 
					"
						<div class='row clearfix'>
							<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<div class='card'>
									<div class='header'>
										<h2>
											Consultation ".$row['date']." - ".$row['time']."
										</h2>
									</div>
									<div class='body'>
											Illness : ".$row['modalityName']." </br></br></br>
											Description : ".$row['note']."
									</div>
								</div>
							</div>
						</div>
					";
				
				}
			?>
            
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
	
    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="../../js/pages/maps/google.js"></script>
    <script src="js/pages/index.js"></script>

	
	
</body>

</html>