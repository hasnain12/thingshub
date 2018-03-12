<?php 

session_start();

if(isset($_SESSION['user_id'])){

	header("Location:index.php");

}

 ?> 



<!DOCTYPE html>

<html lang="en">

    <head> 

		<meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 

 <link href="style/style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/style.css">

		<!-- Website CSS style -->

		<link href="css/bootstrap.min.css" rel="stylesheet">



		<!-- Website Font style -->

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

		<link rel="stylesheet" href="style.css">

		<!-- Google Fonts -->

		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>

		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>



		<title>Sign up</title>

	</head>

	 <body style='padding-top: 30px;'>

	<nav class="navbar navbar-inverse"  id="RedMenu">  

        <div class="container-fluid">  

            <!--Navbar Header Start Here-->  

            <div class="navbar-header">  

                <a class="navbar-brand" href="index.php"><font color="white">ThingsHub</font></a>  

				

            </div>  

            <!--Navbar Header End Here-->  

            <!--Menu Start Here-->  

            <ul class="nav navbar-nav">  

                <li> <a href="#">Channels</a></li>  

                <li><a href="#">Apps</a></li>  

				<li><a href="#">Community</a></li> 

                <!--dropdown Menu Start-->  

                <li class="dropdown">  

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">  

                        Support  

                        <span class="caret"></span>  

                    </a>  

                    <ul class="dropdown-menu">  

                        <li><a href="#">.NET</a></li>  

                        <li><a href="#">HTML5</a></li>  

                        <li><a href="#">ASP.NET MVC</a></li>  

                        <li><a href="#">Java</a></li>  

                    </ul>  

                </li>  

                <!--dropdown Menu End-->  

                <li><a href="#">Contact Us</a></li>  

            </ul>  

            <!--Menu End Here-->  

            <!--Right Aligned Menu Start-->  

            <ul class="nav navbar-nav navbar-right">  

                <li><a href="login.php">Sign in</a></li>  

                <li><a href="signup.php">Sign up</a></li>  

            </ul>  

            <!--Right Aligned Menu End-->  

        </div>  





    </nav> 

		<div class="container">

			<div class="row main">

				<div class="main-login main-center">

				<h5>Sign up for ThingsHub</h5>

					<form class="" method="post" action="#">

						

						<div class="form-group">

							<label for="name" class="cols-sm-2 control-label">First Name</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="fName" id="name"  placeholder="Enter your first Name"/>

								</div>

							</div>

						</div>



						

						<div class="form-group">

							<label for="name" class="cols-sm-2 control-label">Last Name</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="lName" id="name"  placeholder="Enter your last Name"/>

								</div>

							</div>

						</div>

						

						

						

						<div class="form-group">

							<label for="email" class="cols-sm-2 control-label">Your Email</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>

									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>

								</div>

							</div>

						</div>





						<div class="form-group">

							<label for="password" class="cols-sm-2 control-label">Password</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>

									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>

								</div>

							</div>

						</div>



						<div class="form-group">

							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>

							<div class="cols-sm-10">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>

									<input type="password" class="form-control" name="password1" id="confirm"  placeholder="Confirm your Password"/>

								</div>

							</div>

						</div>



						<div class="form-group ">



						

							<input name= "submit" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button" value="Sign up"/>

						</div>

					

					</form>

				</div>

			</div>

		</div>



		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/bootstrap.min.js"></script>

	

	

	<?php



	

	$message = "";

	

	if(isset($_POST["submit"]))

	{

		try{ 

		// database related info

		

		//$host_name = "localhost";

		//$host_username = "root";

		//$host_password = "";

		//$host_database = "thingspeak";

		

			include("dbConnection/connect.php");

		

		// get data from @_POST

		

		$firstName = $_POST["fName"];

		$lastName = $_POST["lName"];

		$email = $_POST["email"];

		$password = $_POST["password1"];

		$activation=(rand(10000,100000)); 

		

                  if($firstName==""||$lastName==""||$email==""||$password==""){

                          $return=array(

					"title" =>"Parameter is missing!",

					"message" => "Parameter is missing.",

					"Error" => "true",

					"statusCode"=>"422"

					); 

				echo json_encode($return);

                                mysqli_close($conn);

				die();



             }

            else{



		//from activation Table

		$sql_comparison="select email from tempusertable where email = '$email'";



		$result=mysqli_query($conn,$sql_comparison);

                //from main Table

                $sql_comparison1="select email from usertable where email = '$email'";



		$result1=mysqli_query($conn,$sql_comparison1);



$sql_query= "Insert into tempusertable (firstName,lastName,email,password,activationCode) VALUES ('$firstName','$lastName','$email','$password','$activation') ";



		

		if(mysqli_num_rows($result) >0)

		{

			$return=array(

					"title" =>"Activate your accocunt!",

					"message" => "This Email already sign up Please Activate your account.",

					"Error" => "true",

					"statusCode"=>"422"

					); 

				echo json_encode($return);

				mysqli_close($conn);

				die();

		}

                else if(mysqli_num_rows($result1) >0)

		{

			$return=array(

					"title" =>"Email Exist!",

					"message" => "This Email already Exist.",

					"Error" => "true",

					"statusCode"=>"422"

					); 

				echo json_encode($return);

				mysqli_close($conn);

				die();

		}

		else if(mysqli_query($conn,$sql_query))

		{

		              // Sending email

					 sendVarifecationEmail($email,$activation);

                            mysqli_close($conn);

					die();

		}

		else

		{

						$return=array(

						"title" =>"DATA INSERTION FAILED.",

						"message" => "DATA INSERTION FAILED.",

						"Error" => "true",

						"statusCode"=>"422"

						); 

					echo json_encode($return); 

					mysqli_close($conn);

					die();

		}//end of else

}//end of else for parameter

}//end of try



//catch exception

	catch(Exception $e){

		echo 'Message: ' .$e->getMessage();

		}

//mysqli_close($conn);

	}

?>

<?php



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



function sendVarifecationEmail($email,$activation) {

error_reporting(E_ALL); ini_set('display_errors', 1);



require 'phpmailer/Exception.php';

require 'phpmailer/PHPMailer.php';

require 'phpmailer/SMTP.php';







$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

		try {

			//Server settings

			$mail->SMTPDebug = 0;                                 // Enable verbose debug output

			//$mail->isSMTP();                                      // Set mailer to use SMTP

			$mail->Host = 'mail@thingsshub.info';  // Specify main and backup SMTP servers

			$mail->SMTPAuth = true;                               // Enable SMTP authentication

			$mail->Username = 'verify@thingsshub.info';                 // SMTP username

			$mail->Password = '@TesT@123';								//SMTO Password

			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

			$mail->Port = 465;                                    // TCP port to connect to



			//Recipients

			$mail->setFrom('verify@thingsshub.info', 'Mailer');

			

			$mail->addAddress($email, 'Testing');   



			//Content

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Testing';

$mail->Body    = "Link for activation!</b>  http:thingsshub.info/verify.php?email=".$email."&passkey=".$activation;

			$mail->send();

			$return=array(

					

					"Your Confirmation link Has Been Sent To Your Email Address.",

					

					);

					 

					//header('Content-type: application/json');

				echo json_encode($return);

				die();

		} 

	catch (Exception $e) 

	{

	   $return=array(

				

				"Cannot send Confirmation link to your e-mail address.",

				

				

				);

				//header('Content-type: application/json');

			echo json_encode($return);

		    echo 'Mailer Error: ' . $mail->ErrorInfo;

		die();

	}

}		

?>

</body>

</html>

	

	

	