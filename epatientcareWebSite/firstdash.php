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
	
	
	$nbrPatient = 0;
	$nbrConsultation = 0;
	$nbrIllness = 0;
	
	$patientQuery = mysql_query("SELECT COUNT(*) as nbt FROM patients ");
	if(mysql_num_rows($patientQuery) == 1)
	{
		$row = mysql_fetch_array($patientQuery);
		$nbrPatient = $row['nbt'];
	}
	
	$patientQuery = mysql_query("SELECT COUNT(*) as nbt FROM medicalconsultation ");
	if(mysql_num_rows($patientQuery) == 1)
	{
		$row = mysql_fetch_array($patientQuery);
		$nbrConsultation = $row['nbt'];
	}
	
	$patientQuery = mysql_query("SELECT COUNT(*) as nbt FROM modality ");
	if(mysql_num_rows($patientQuery) == 1)
	{
		$row = mysql_fetch_array($patientQuery);
		$nbrIllness = $row['nbt'];
	}
	
 ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>E-PatientCare | Home</title>
    <!-- Favicon-->
    <link rel="icon" href="images/logo.png" type="image/x-icon">

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
	
	<!-- Morris Css -->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    
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
                        <a href="firstop.php">
                            <i class="material-icons">view_list</i>
                            <span>Dashboard</span>
                        </a>
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
                <h2>Home</h2>
            </div>
			
			<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">PATIENTS</div>
                            <div class="number"><?php echo $nbrPatient;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">CONSULTATIONS</div>
                            <div class="number"><?php echo $nbrConsultation;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">airline_seat_flat</i>
                        </div>
                        <div class="content">
                            <div class="text">Illness</div>
                            <div class="number"><?php echo $nbrIllness;?></div>
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>BAR CHART</h2>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="150"></canvas>
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
	
	<!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
	
	<!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- Chart Plugins Js -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>
	
	<!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="js/pages/maps/google.js"></script>
    <script src="js/pages/index.js"></script>
	<script src="js/pages/tables/jquery-datatable.js"></script>

	
	
</body>

</html>