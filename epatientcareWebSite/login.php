<!DOCTYPE html>
<html>
<?php 

	require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
	session_start();
 ?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> E-PatientCare | Login </title>
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

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a >E<b> - PatientCare</b></a>
            <small>Ensure good health monitoring</small>
        </div>
		</br>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="login.php">
                    <div class="msg">Login to your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="login" id="login">LOGIN</button>
                        </div>
                    </div>
					<div class="row">
					<?php 
						if(!empty($_POST['username']) && !empty($_POST['password']))
						{
							$username = mysql_real_escape_string($_POST['username']);
							$password = mysql_real_escape_string($_POST['password']);
							
							$checklogin = mysql_query("SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'");
							
							
							
							if(mysql_num_rows($checklogin) == 1)
							{
								$row = mysql_fetch_array($checklogin);
								$id = $row['id'];
								$usertype = $row['fkusertype'];
								
								$_SESSION['idUsername'] = $id;
								$_SESSION['loggedin'] = 1;
								
								switch($usertype)
								{
									case 'operator':
										header("Location:firstop.php");
										exit();
										break;
										
									case 'doctor':
										header("Location:firstdoc.php");
										exit();
										break;
									
									case 'dashboard':
										header("Location:firstdash.php");
										exit();
										break;
								}
								
								
							}
							else
							{
								echo "<div class='msg' style='color:red'>Sorry your username or password is incorrect !!</div>";
							}
						}
					?>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>