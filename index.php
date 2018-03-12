<?php

session_start();

?>

<!DOCTYPE html>  

  

<html lang="en">  

<head>  

    <meta charset="utf-8">  

    <title>ThingsHub</title>  

   <meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />  

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	

	

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

            <ul class="nav navbar-nav " >  

	<?php

			if(isset($_SESSION['user_id'])){

				?>

				<li class="dropdown">  

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">  

                        Channels  

                        <span class="caret"></span>  

                    </a>  

                    <ul class="dropdown-menu">  

                        <li><a href="mychannels.php?channels">My channels</a></li>  

                        <li><a href="mychannels.php?watched">Watched channels</a></li>  

                        <li><a href="mychannels.php?public">Public channels</a></li>  

						<li><a href="mychannels.php?share">Shared channels</a></li>  

                                      

				   </ul>  

                </li> 

				<?php

				

				// header("Location:index.php");

			}

			else{

				?>

				<li><a href="#">Channels</a></li> 

				

			<?php

			}

	?>

                  				  

                <li><a href="#">Apps</a></li>  

				<li><a href="#">Community</a></li> 

                <!--dropdown Menu Start-->  

                <li bgcolor="#E6E6FA" class="dropdown" >  

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"  >  

                        Support  

                        <span class="caret"></span>  

                    </a>  

                    <ul  class="dropdown-menu" >  

                        <li><a href="#">Documentation </a></li>  

                        <li><a href="#">Tutorial</a></li>  

                        <li><a href="#">Examples</a></li>  

                         

                    </ul>  

                </li>  

                <!--dropdown Menu End-->  

                <li><a href="#">Contact Us</a></li>  

            </ul>  

            <!--Menu End Here-->  

            <!--Right Aligned Menu Start-->  

            <?php

			if(isset($_SESSION['user_id'])){

			?>

			<ul class="nav navbar-nav navbar-right">  

                 <li bgcolor="#E6E6FA" class="dropdown" >  

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"  >  

                        Account  

                        <span class="caret"></span>  

                    </a>  

                    <ul  class="dropdown-menu" >  

                        <li><a href="login.php">My account </a></li>  

                        <li><a href="#">My profile</a></li>  

                         

                    </ul>  

                </li>  

                <li><a href="logout.php">Sign out</a></li>  

            </ul> 

			<?php

			}

			else{

				?>

			<ul class="nav navbar-nav navbar-right">  

                  <li><a href="login.php">Sign in</a></li>

                <li><a href="signup.php">Sign up</a></li>  

            </ul>  

            

			<?php

			}

			?>			

            

			<!--Right Aligned Menu End-->  

        </div>  



<div class="bigpic" >

  <span class="bigletters" align="center">Understand Your Things</span>

   

</div>

<div align="center">

<a class="btn btn-primary btn-lg" href="/signup.php" align= "center" >Get Started here</a> </div>

    </nav>  

	

 <div class="row text-center">

    <div class="col-sm-4">

      <h1 class="text-center heading-pad"><a href="#" class="header-default"><img alt="Collect" height="72" src="/img/collect-534c4d963c6222337349e6558b31bb2f.svg" width="60" /><br/>Collect</a></h1>

      <div>Send sensor data through sensor.</div>

    </div>



    <div class="col-sm-4">

      <h1 class="text-center heading-pad"><a href="#" class="header-default"><img alt="Analyze" height="72" src="/img/analyze-85df79f0a8ff707a22707af8b3e3d8ef.svg" width="60" /><br/>Analyze</a></h1>

      <div>Analyze and visualize your data with Highcharts.</div>

    </div>



    <div class="col-sm-4">

      <h1 class="text-center heading-pad"><a href="#" class="header-default"><img alt="Act" height="72" src="/img/act-6c9e1de366cc6646bb1636bb403cecc3.svg" width="60" /><br/>Act</a></h1>

      <div>Trigger a reaction.</div>

    </div>

  </div>

	

	

	

	

    <!--<nav> tag end-->  

    <!--Inverted Navbar End Here-->  

    <script src="js/jquery-2.1.4.min.js"></script>  

    <script src="js/bootstrap.min.js"></script>  

</body>  

</html> 