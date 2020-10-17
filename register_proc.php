<?php

// define variables and set to empty values
$Name_error  = $Email_error = $Phone_error = $Gender_error = $Date_error = $password_error = $Repassword_error = $M_Teacher_error = $DB_error = "";
$Name = $Email = $Phone = $Gender = $Date = $password = $Repassword = $M_Teacher = "";

$conn = new mysqli('localhost','root','','messaging system');

if($conn->connect_error) {
	$DB_error ="Database Connection Error!";

} else{
	//$DB_error ="database connection done";
	//form is submitted with POST method
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	  //First Name validation
	  if (empty($_POST["Name"])) {
	    $Name_error = "Name is required";
	  } else {
	    $Name = test_input($_POST["Name"]);
	    // check if name only contains letters
	    if (!preg_match("/^[a-zA-Z ]+$/",$Name)) {
	      $Name_error = "Only letters allowed";
	    }
	  }

	  //Email validation
	  if (empty($_POST["Email"])) {
	    $Email_error = "Email is required";
	  } else {
	    $Email = test_input($_POST["Email"]);


	    // check if e-mail address is well-formed with a built in function in php ^^
	    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
	      $Email_error = "Invalid email format";
	    }else {

	    	$result= $conn->query("SELECT * FROM user WHERE Email = '$Email' ");
			 if( $result->num_rows > 0 ){

			 $Email_error = "This Email is already reserved";

			 }

	  	}

	  }

		//Phone validation
	  if (empty($_POST["Phone"])) {
	    $Phone_error = "Phone is required";
	  } else {
	    $Phone = test_input($_POST["Phone"]);
	    // check if phone number is well-formed
	    if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$Phone)) {
	      $Phone_error = "Invalid phone number";
	    }
	  }

		//Gender validation
	  if (empty($_POST["Gender"])) {
	    $Gender_error = "Gender is required";
	  }

	  //Birthdate validation
	  if (empty($_POST["Date"])) {
	    $Date_error = "Birthdate is required";
	  } else {
	    $Date = test_input($_POST["Date"]);
	    // check if Date is well-formed
	    if (!preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/",$Date)) {
	      $Date_error = "Invalid Date ";
	    }
	  }

	  ////Security Question validation
	  if (empty($_POST["M_Teacher"])) {
	    $M_Teacher_error = "this field is required for security reasons ";
	  } else {
	    $M_Teacher= test_input($_POST["M_Teacher"]);


	    if (!preg_match("/^[a-zA-Z ]*$/",$M_Teacher)) {
	      $M_Teacher_error = "Invalid name ";
	    }
	  }

	  //Password validation
	  if (empty($_POST["Password"])) {
	    $password_error = "You must Enter a Password!";
	  } else {
	    $password= test_input($_POST["Password"]);

			/*
			Between start -> ^
			And end -> $
			of the string there has to be at least one number -> (?=.*\d)
			and at least one letter -> (?=.*[A-Za-z])
			and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
			and there have to be 8-12 characters -> {8,12}
			*/
	    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/",$password)) {
	      $password_error = "The Password does not meet the requirements! ";
	    }
	  }
	  //rePassword validation
	  if (empty($_POST["Repassword"])) {
	    $Repassword_error = "You must Enter a Password!";
	  } else {
	    $Repassword = test_input($_POST["Repassword"]);
	  }

	  //matching passwords!
	  if($Repassword_error == "" && $password_error == "" ) {
	  	if($_POST['Password'] != $_POST['Repassword']){
				$password_error = "Passwords do not match!";
		}

	 }

		if($Repassword_error == "" && $password_error == "" && $Name_error == "" && $Email_error == "" && $Phone_error == "" && $Gender_error == "" && $Date_error == "" && $M_Teacher_error == "" ) {


			 $Name = test_input($_POST["Name"]);
			$Email = test_input($_POST["Email"]);
			$Phone = test_input($_POST["Phone"]);
			$Gender = $_POST["Gender"];

			$Date = test_input($_POST["Date"]);

			$M_Teacher= test_input($_POST["M_Teacher"]);
			$password= test_input($_POST["Password"]);



			$sql = "INSERT INTO user (Name, Email,Password,Phone,Gender,BirthDate,Q_Teacher) VALUES (?,?,?,?,?,?,?)" ;

			$stmt = mysqli_stmt_init($conn);



			 if(mysqli_stmt_prepare($stmt,$sql)){

	    		$DB_error ="New record created successfully";
	    		mysqli_stmt_bind_param($stmt,"sssssss",$Name,$Email,$password,$Phone,$Gender,$Date,$M_Teacher);
	    		mysqli_stmt_execute($stmt);
	    		header( "Refresh:2; url=login.php" );
				} else {

	    		$DB_error ="something went wrong !!!! ";

	    		}

		}


	//method="post"
	}
// DB
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
