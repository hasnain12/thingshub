<?php
		session_start();
		
    include("dbConnection/connect.php");
	
$current=basename($_SERVER['PHP_SELF']);
	function encrypt($string) {
	$key="things";
	  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }

  return base64_encode($result);
}

function decrypt($string) {
	$key="things";
	  $result = '';
  $string = base64_decode($string);

  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }

  return $result;
}

	$channelId=$_GET['c_id'];
	
		?>

<!DOCTYPE html>  
  
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <title>ThingsHub</title>  
    <meta name="viewport" content="width=device-width,initial-scale=1">  
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
	
	
	<script type="text/javascript" src="code/date/moment.min.js"></script>
	<script type="text/javascript" src="code/date/daterangepicker.js"></script>
	<script type="text/javascript" src="code/date/moment.js"></script>
	
	
	<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="code/modules/exporting.js"></script>
	<style>
	.load_img {
    left: 39%;
    top: 28%;
    width: 21%;
    position: absolute;
}
.loader {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(21, 21, 21, 0.75);
    z-index: 1111;
}


	</style>
</head>  

  <body style='padding-top: 30px;'>
  <div class="loader" style="display: none;">
		<img src="loader.gif" class="img-responsive load_img">
	</div>
  

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
                        <li><a href="mychannels.php?share">Shared channels</a></li>  
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
	
	
	
	<h1 class="margin-left" id="channel-name-header"> </h1>
    <div class="row col-xs-12 col-sm-12" style="margin-bottom: 25px;">
      <div class="col-xs-6 col-sm-4">
  <ul class="no_bullets" id="table-channel-metadata">
    <b id="channel-metadata-id"></b></li>
       <a href="#" target="_blank"></a></li>

  </ul>
</div>

<div class="col-xs-6 col-sm-4" style="border-left: 1px solid #ccc;">
  
</div>

    </div>
	
	<?php
	if(isset($_GET['status'])){
	  mysqli_query($conn,"Update channeltable set status=".$_GET['status']." where channelId=".$channelId) or die(mysqli_error($conn));
		echo "<script>window.location.href='$current?c_id=$channelId';</script>";
		// header("Location:?c_id=".$channelId);
  }
  if(isset($_POST['update'])){
	  mysqli_query($conn,"UPDATE `channeltable` SET `channelName`='".$_POST['channelName']."',`channelDescription`='".$_POST['channelDescription']."',`field1`='".$_POST['field1']."',`field2`='".$_POST['field2']."',`field3`='".$_POST['field3']."',`field4`='".$_POST['field4']."',`field5`='".$_POST['field5']."',`field6`='".$_POST['field6']."',`field7`='".$_POST['field7']."',`field8`='".$_POST['field8']."',`metaData`='".$_POST['metaData']."'  where channelId=".$channelId) or die(mysqli_error($conn));
		$field1=$_POST['field1'];
			$field2=$_POST['field2'];
			$field3=$_POST['field3'];
			$field4=$_POST['field4'];
			$field5=$_POST['field5'];
			$field6=$_POST['field6'];
			$field7=$_POST['field7'];
			$field8=$_POST['field8'];
			
		$fields=array($field1,$field2,$field3,$field4,$field5,$field6,$field7,$field8);
			for($i=0;$i<count($fields);$i++){
				$field_id=$i+1;
				
			 mysqli_query($conn,"UPDATE `fieldattr` SET `title`='".$fields[$i]."' where field_id=".$field_id." and channel_id=".$channelId) or die(mysqli_error($conn));
	
			}
		// echo "<script>window.location.href='$current?c_id=$channelId';</script>";
		$msg= "<div class='alert alert-success'>Channel Updated Successfully!</div>";
	}
  
 $query = mysqli_query($conn,'SELECT * FROM channeltable where channelId='.$channelId) or die(mysqli_error($conn));
		$row = mysqli_fetch_array($query);
		if(!(isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId'])){
			if($row['status']=="0"||!isset($_SESSION['user_id']))
				die("You are not able to view this channel");
			else if($row['status']=='2'){
				$emails=json_decode($row['emails']);
				// echo $_SESSION["my_session"];
				// echo array_search($_SESSION["my_session"],$emails);
				// print_r($emails);
				// die;
				$find=array_search($_SESSION["my_session"],$emails);
			
				if($find==false&&$find!==0)
					die("You are not able to view this channel");
			
			}
		}
		?>
<div class="row">	
<div class="col-sm-10">	
 <h3><?php 
  echo "Channel name: \n\n\n\n".$row['channelName']."<br><br>";
  echo  "Channel id: \n\n\n\n".$row['channelId']."<br><br>";
  ?></h3>
  </div>
  <div class="col-sm-2 pull-right">	
	<?php 
  if(isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId']){
	  // echo $row['status']?"<a href='?c_id=$channelId&status=0'>Make It Private</a>":"<a href='?c_id=$channelId&status=1'>Make It Public</a>"; 
  }
  
  ?>
  </div>
  </div>
	
    <div class="row">
      <ul class="nav nav-tabs" style="margin: 25px;" data-no-turbolink>
       <li role="presentation" class="<?php echo $current=="privateshow.php"?"active":""; ?>">
        <a href="privateshow.php?c_id=<?php echo $_GET['c_id']; ?>" id="channel_link_private_view">Private View</a>
      </li>
	  <?php
	  if(isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId']){
	  ?>
	  <li role="presentation"  class="<?php echo $current=="apikeys.php"?"active":""; ?>">
        <a href="apikeys.php?c_id=<?php echo $_GET['c_id']; ?>" id="channel_link_api_keys">API Keys</a>
      </li>
      
      <li role="presentation" class="<?php echo $current=="chsettings.php"?"active":""; ?>">
        <a href="chsettings.php?c_id=<?php echo $_GET['c_id']; ?>" id="channel_link_settings">Channel Settings</a>
      </li>
     <li role="presentation" class="<?php echo $current=="sharing.php"?"active":""; ?>">
        <a href="sharing.php?c_id=<?php echo $_GET['c_id']; ?>" id="channel_link_settings">Sharing</a>
      </li>
    <li role="presentation" class="<?php echo $current=="data-export.php"?"active":""; ?>">
        <a href="data-export.php?c_id=<?php echo $_GET['c_id']; ?>" id="channel_link_settings">Data Export</a>
      </li>
      
	  <?php
	  }
	  ?>
       
     

    </ul>
	
	
  </div>
