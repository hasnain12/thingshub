
<!DOCTYPE html>  
  
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <title>ThingsHub</title>  
    <meta name="viewport" content="width=device-width,initial-scale=1">  
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
                 <li class="dropdown">  
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">  
                        Channels  
                        <span class="caret"></span>  
                    </a>  
                     <ul class="dropdown-menu">  
                        <li><a href="mychannels.php?channels">My channels</a></li>  
                        <li><a href="mychannels.php?watched">Watched channels</a></li>  
                        <li><a href="mychannels.php?public">Public channels</a></li>  
                    </ul>  
                </li> 
                <li><a href="#">Apps</a></li>  
				<li><a href="#">Community</a></li> 
                <!--dropdown Menu Start-->  
                <li bgcolor="#E6E6FA" class="dropdown" >  
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"  >  
                        Support  
                        <span class="caret"></span>  
                    </a>  
                    <ul  class="dropdown-menu" >  
                        <li><a href="login.php">Documentation </a></li>  
                        <li><a href="#">Tutorial</a></li>  
                        <li><a href="#">Examples</a></li>  
                    </ul>  
                </li>  
                <!--dropdown Menu End-->  
                <li><a href="#">Contact Us</a></li>  
            </ul>  
            <!--Menu End Here-->  
            <!--Right Aligned Menu Start-->  
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
            <!--Right Aligned Menu End-->  
        </div>  


    </nav>  
	
	 <div id="sidebar" class="col-xs-5 col-sm-16" >
    <h1 >Help</h1>
    <p >
Channels store all the data that a ThingSpeak application collects. Each channel includes eight fields that can hold any type of data,
 plus three fields for meta data and one for status data. Once you collect data in a channel, 
 you can use ThingsHub apps to analyze and visualize it.
 
</p>
	 
		<div class="container" >
			<div class="row main">
				<div class="main-login main-center" >
				<center><h3>Create New Channel </h3></center>
				  <input id="unsaved_message" name="unsaved_message" type="hidden" value="You have unsaved changes that will be lost." />
					<form class="" method="post" action="insert_ac.php"  >
						
						<div class="form-group" >
							<label for="name" class="cols-sm-2 control-label" >Name</label>
							<div class="cols-sm-10">
								<div class="input-group" >
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="channelName" id="name"  placeholder="Enter channel name"    />
									
			
								</div>
							</div>
						</div>
						<!--<div class="form-group" >
							<label for="name" class="cols-sm-2 control-label" >Access</label>
							<div class="cols-sm-10">
								<select class="form-control" name="access">
									<option value='1'>Public</option>
									<option value='0'>Private</option>
			
								</select>
							</div>
						</div>-->

						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Discription</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="channelDiscription" id="channelDiscription"  placeholder="Enter channel discription"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field1</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field1" id="field1"  placeholder="Enter field1"/>
									
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field2</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field2" id="field2"  placeholder="Enter field2"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field3</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field3" id="field3"  placeholder="Enter field3"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field4</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field4" id="field4"  placeholder="Enter field4"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field5</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field5" id="field5"  placeholder="Enter field5"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field6</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field6" id="field6"  placeholder="Enter field6"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field7</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field7" id="field7"  placeholder="Enter field7"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field8</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="field8" id="field8"  placeholder="Enter field8"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Meta Data</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="metaData" id="metaData"  placeholder="Enter meta data"/>
								</div>
							</div>
						</div>
					

						<div class="form-group ">

						
							<input name= "submit" type="submit" id="submit" class="btn btn-primary btn-lg btn-block login-button" value="Create channel"/>
						</div>
					
					</form>
				</div>
			</div>
		</div></div>
		

		
		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	

	
    <!--<nav> tag end-->  
    <!--Inverted Navbar End Here-->  
    <script src="js/jquery-2.1.4.min.js"></script>  
    <script src="js/bootstrap.min.js"></script>  
</body>  
</html> 



