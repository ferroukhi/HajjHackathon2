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
                    <li class="active">
                        <a href="firstop.php">
                            <i class="material-icons">view_list</i>
                            <span>Hajj List</span>
                        </a>
                    </li>
                    <li>
                        <a href="addnewpatient.php" >
                            <i class="material-icons">add</i>
                            <span>Add new patient</span>
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
			
			<a href="addnewpatient.php" class="btn btn-primary waves-effect">
				<i class="material-icons">add</i>
				<span>Add new patient</span>
			</a>
			
			</br>
			</br>
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Hajaj List
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Country</th>
                                            <th>Passeport number</th>
											<th>First name</th>
											<th>Last name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Height</th>
											<th>Weight</th>
											<th>Blood</th>
											<th>Consult</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Country</th>
                                            <th>Passeport number</th>
											<th>First name</th>
											<th>Last name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Height</th>
											<th>Weight</th>
											<th>Blood</th>
											<th>Consult</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											
											<?php 
								
												$allPatientsInformations = mysql_query("SELECT * FROM patients ORDER BY fkCountry ");
												while ($row = mysql_fetch_assoc($allPatientsInformations)) 
												{
													echo 
													"
													<tr>
														<td>".$row['id']."</td>
														<td>".$row['fkCountry']."</td>
														<td>".$row['passeport']."</td>
														<td>".$row['firstName']."</td>
														<td>".$row['lastName']."</td>
														<td>".$row['age']."</td>
														<td>".$row['gender']."</td>
														<td>".$row['height']."</td>
														<td>".$row['weight']."</td>
														<td>".$row['bloodgroup']."</td>
														<td>
															<a href='patientinformations.php?patient=".$row['id']."' class='btn bg-purple btn-circle waves-effect waves-circle waves-float' >
																<i class='material-icons'>search</i>
															</a>
														</td>
													</tr>
													";
												
												}
											?>
                                        
                                    </tbody>
                                </table>
                            </div>
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

	
	<!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    
    
    
	<!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="../../js/pages/maps/google.js"></script>
    <script src="js/pages/index.js"></script>
	<script src="../../js/pages/tables/jquery-datatable.js"></script>

	
	
</body>

</html>