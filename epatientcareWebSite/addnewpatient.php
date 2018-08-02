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
                        <a href="firstop.php">
                            <i class="material-icons">view_list</i>
                            <span>Hajj List</span>
                        </a>
                 
                    </li>	
					<li class="active">
                        <a href="addnewpatient.php" >
                            <i class="material-icons">add</i>
                            <span>Add new patient</span>
                        </a>
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
                <h2>Add new patient</h2>
            </div>
			
			</br>
			</br>
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Form
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" method="POST" action="addnewpatient.php">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="country">Country</label>
                                    </div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="country" name="country" class="form-control" placeholder="Please select country from list">
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="passeportnumber">Passport number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="passeportnumber" name="passeportnumber" class="form-control" placeholder="Put the patient passeport number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="firstname">First Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Put the firstname">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="lastname">Last Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Put the lastname">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="age">Age</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group form-float">
											<div class="form-line">
												<input min="1" type="number" id="age" name="age" class="form-control" required>
												<label class="form-label">Age</label>
											</div>
											<div class="help-info">The warning step will show up if age is less than 1</div>
										</div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="gender">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
											<input type="radio" name="gender" value="Male" id="male" class="with-gap">
											<label for="male">Male</label>

											<input type="radio" name="gender" value="Female" id="female" class="with-gap">
											<label for="female" class="m-l-20">Female</label>
										</div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="height">Height</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group form-float">
											<div class="form-line">
												<input type="text" name="height" id="height" class="form-control" required>
												<label class="form-label">Height</label>
											</div>
										</div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="weight">Weight</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group form-float">
											<div class="form-line">
												<input type="number" id="weight" name="weight" class="form-control" required>
												<label class="form-label">Weight</label>
											</div>
										</div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="blood">Blood group</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group form-float">
											<div class="form-line">
												<input type="text" id="blood" name="blood" class="form-control" required>
												<label class="form-label">Blood group</label>
											</div>
										</div>
                                    </div>
                                </div>
								
								</br>
								</br>
								
								<div class="row clearfix">
                                
                                    <input type="submit" class="btn btn-primary btn-lg waves-effect" value="Save patient" style="float: right; margin-right: 50px;" />
                                    
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
											//header("Location:patientinformations.php?patient=".$id);
											echo "<script type='text/javascript'>location.href='patientinformations.php?patient=".$id."';</script>"; exit;
										
										}
									}
								?>
								
							</form>
                        </div>
                    </div>
                </div>
            </div>
			
			
            
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