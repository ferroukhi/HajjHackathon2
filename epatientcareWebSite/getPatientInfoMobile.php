<?php 

	require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
	
	$patientID = $_GET["patient"];
	$patientInfoQuery = mysql_query("SELECT * FROM patients WHERE id = '".$patientID."'");
	
	$response = array();
	
	$response["success"] = 0;
	
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
		
		$response["success"] = 1;
		
		$response["country"] = $country;
		$response["passeportnumber"] = $passeportnumber;
		$response["firstname"] = $firstname;
		$response["lastname"] = $lastname;
		$response["age"] = $age;
		$response["gender"] = $gender;
		$response["height"] = $height;
		$response["weight"] = $weight;
		$response["blood"] = $blood;
		
		
	}
	
	
	echo json_encode($response);
	
	
 ?>