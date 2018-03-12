<?php
ob_start();
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

		<title>Login</title>
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
				<h5>Login to ThingsHub</h5>
					<form class="" method="post" action="#">
						
						
						
						
						
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
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

						<div class="form-group ">

						
							<input name= "submit" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button"value="Login"/>
							
							<!--<center><h2>Or</h2></center>
							<a href="#">
							
							<center> <img src="img/google.png" alt="google sign in" height="" width="200"></a></center>-->
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
 error_reporting(E_ERROR|E_WARNING);
if(isset($_POST["submit"]))
{
 
if(count($_POST)>0) 
{
 //Including dbconfig file.
include ("dbConnection/connect.php");
 session_start();
$email = $_POST["email"];

$password = $_POST["password"];
$_SESSION['login_user']=$email; 

//$EncryptPassword = md5($password);
if($email==""||$password==""){
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
				$sql_comparison="select email,userId from usertable where email = '$email' and password='$password'";
$result = mysqli_query($conn,$sql_comparison) or die(mysqli_error($conn)); 

if(mysqli_num_rows($result) >0)
		{
					 session_start();
					$row = mysqli_fetch_assoc($result);
			
			
			$_SESSION["my_session"] = $row["email"];
			$_SESSION["user_id"] = $row["userId"];
			
			
			
				// redirect to admin home page
				//header("Location: ./skywaysHomepage.php");
				header("Location: ./mychannels.php?channels");
			
			
		}
		else
		{
			echo '<center>' . "Wrong UserName or Password..." . '</center>';
		}



}
}
}
?>
</body>
</html>