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
	
	$speciality = $_GET["speciality"];
	
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
	
	<!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                    
                        <a href="firstop.php">
                            <i class="material-icons">view_list</i>
                            <span>Hajj List</span>
                        </a>
                    
                    <li>
                        <a href="addnewpatient.php" >
                            <i class="material-icons">add</i>
                            <span>Add new patient</span>
                        </a>
                    </li>	
					<li>
					<li class="active">
                        <a href="addmedicalspeciality.php" >
                            <i class="material-icons">add</i>
                            <span>Medical speciality</span>
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
                <h2>Medical Speciality</h2>
            </div>
			
			</br>
			
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add Medical Speciality
                            </h2>
                        </div>
                        <div class="body">
						<form class="form-horizontal" method="POST" action="modality.php?speciality=<?php echo $speciality; ?>">
							</br>
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="speaciality">Medical speciality</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="speaciality" name="speaciality" class="form-control" placeholder="Entre speciality">
										</div>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<input type="submit" class="btn btn-primary btn-lg waves-effect" value="Add speciality" style="float: right; margin-right: 50px;" />
							</div>
							</br>
                            <div class="body table-responsive">
								<table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Modality</th>
											<th>specialty</th>
											<th></th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
											
											<?php 
								
												$allModality = mysql_query("SELECT * FROM modality m JOIN medicalspecialty ms ON ms.id = m.fkSpecialty  where fkSpecialty = ".$speciality."");
												$i = 1;
												while ($row2 = mysql_fetch_assoc($allModality)) 
												{
													echo 
													"
													<tr>
														<td>".$i."</td>
														<td>".$row2['modalityName']."</td>
														<td>".$row2['specialtyName']."</td>
													</tr>
													";
													$i++;
												}
											?>
                                        
                                    </tbody>
                                </table>
								
								
								<?php 
								
									if(!empty($_POST['speaciality']))
									{
										$modality = mysql_real_escape_string($_POST['speaciality']);
										
										$insertModality = mysql_query("INSERT INTO modality (modalityName, fkSpecialty) VALUES ('".$modality."', '".$speciality."' )");
										
										echo "<meta http-equiv='refresh' content='0'>";
									}
								?>
                            </div>
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

	<!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        
	<!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="js/pages/maps/google.js"></script>
    <script src="js/pages/index.js"></script>
	<script src="js/pages/tables/jquery-datatable.js"></script>

	
	
</body>

</html>