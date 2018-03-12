<?php
session_start();
?>
<!DOCTYPE html>  
  
<html lang="en">  
<head>  
    <meta charset="utf-8">  
    <title>ThingsHub</title>  
    <meta name="viewport" content="width=device-width,initial-scale=1">  
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/table.css">
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
	
	 <h1><?php echo isset($_GET['public'])?"Public":(isset($_GET['watched'])?"Watch":(isset($_GET['share'])?"Shared":"My")); ?> Channels</h1><br> <br>
	 <div class="col-pad" data-no-turbolink>

     <center> <a class="btn btn-primary" data-no-turbolink="true" href="createChannel.php" id="channel-new-channel-btn">New Channel</a> <br> </center> 

      <br><br>


        

    </div>
	<?php
		echo (isset($_GET['msg'])&&$_GET['msg']=='unwatch')?"<div class='alert alert-success'>Channel successfully unwatched</div>":"";
		echo (isset($_GET['msg'])&&$_GET['msg']=='addwatch')?"<div class='alert alert-success'>Channel Added to Watch Successfully</div>":"";
	?>
	<table class="data-table">
		<thead>
			<tr>
				<th>Channel Name</th>
				<th>Access</th>
				<th>Creation Date</th>
				<th>Updated Date</th>
				<?php
				echo isset($_GET['public'])?"<th>Action</th>":"";
				?>
				
			</tr>
		</thead>
		<tbody>
		<?php
		// session_start();
	if(isset($_SESSION["my_session"]))
		{
			//include("./common/logout_header.php");
		}
		
	if(!isset($_SESSION["my_session"]))
	{
		header("Location: login.php");
	}
	include("dbConnection/connect.php");
	$user_id=$_SESSION["user_id"];

 if(isset($_GET['addWatch'])){
	 $channel_id=$_GET['id'];
	 $query = mysqli_query($conn,"Insert into watchchannels (channel_id,user_id) VALUES ($channel_id,$user_id)") or die(mysqli_error($conn));
		if(mysqli_affected_rows($conn)>0)
			header("location:?public&msg=addwatch");
 }
 if(isset($_GET['unWatch'])){
	 $channel_id=$_GET['id'];
	 $query = mysqli_query($conn,"delete from watchchannels where channel_id=$channel_id and user_id=$user_id") or die(mysqli_error($conn));
		if(mysqli_affected_rows($conn)>0)
			header("location:?public&msg=unwatch");
 }
	
 		
	if(isset($_GET['channels'])){
		$sql = 'SELECT channelId,status,channelName,createdDate,updated 
		FROM channeltable where userId='.$user_id;
	}
	else if(isset($_GET['watched'])){
		$sql = 'SELECT ct.channelId,ct.status,ct.channelName,ct.createdDate,ct.updated 
		FROM channeltable ct inner join watchchannels wc  on ct.channelId=wc.channel_id where wc.user_id='.$user_id;
	
	
	}
	else if(isset($_GET['public'])){
		$sql = 'SELECT channelId,status,channelName,createdDate,updated 
		FROM channeltable where status=1 and userId!='.$user_id;
	}
	else if(isset($_GET['share'])){
		$sql = 'SELECT emails,channelId,status,channelName,createdDate,updated 
		FROM channeltable where status=2 and userId!='.$user_id;
	}
	else{
			$sql = 'SELECT channelId,status,channelName,createdDate,updated 
		FROM channeltable where userId='.$user_id;
	
	}
	
		
		$query = mysqli_query($conn, $sql) or die($sql);
		while ($row = mysqli_fetch_array($query))
		{
		$status=$row['status']?"Public":"Private";
		$watched="";
		if(isset($_GET['public'])){
			$query2 = mysqli_query($conn, "Select * from watchchannels where channel_id=".$row['channelId']." and user_id=".$user_id) or die(mysqli_error($conn));
				if(mysqli_num_rows($query2)>0)
					$watched='<td><a href="?unWatch&id='.$row['channelId'].'">UnWatched</a></td>';
				else
				$watched='<td><a href="?addWatch&id='.$row['channelId'].'">Watched</a></td>';
		}
		if(isset($_GET['share'])){
			$emails=json_decode($row['emails']);
			$find=array_search($_SESSION["my_session"],$emails);
			// print_r($find);
			// print_r(array_search($_SESSION["my_session"],$emails));
			// die;
			if($find==false&&$find!==0)
				continue;
			}
					
			echo '<tr>
					<td> <a href="privateshow.php?c_id='.$row['channelId'].'">'.$row['channelName'].'</td>
					<td>'.$status.'</td>
					<td>'.$row['createdDate'].'</td>
					<td>'.$row['updated'] . '</td>
					'.$watched.'
				</tr>';
				
				
			
		}?>
		</tbody>
		<tfoot>
			<tr>
				</tr>
		</tfoot>
	</table>
    
	


	
	
    <!--<nav> tag end-->  
    <!--Inverted Navbar End Here-->  
    <script src="js/jquery-2.1.4.min.js"></script>  
    <script src="js/bootstrap.min.js"></script>  
	<script src="http://d3js.org/d3.v3.min.js"></script>
 <style> /* set the CSS */
 
body { font: 12px Arial;}
 
path { 
  stroke: red;
  stroke-width: 2;
  fill: none;
}
 
.axis path,
.axis line {
	fill: none;
	stroke: grey;
	stroke-width: 1;
	shape-rendering: crispEdges;
}
 
</style>
<script>
 
// Set the dimensions of the canvas / graph
var	margin = {top: 30, right: 20, bottom: 30, left: 50},
	width = 600 - margin.left - margin.right,
	height = 270 - margin.top - margin.bottom;
 
// Parse the date / time
var	parseDate = d3.time.format("%d-%b-%y").parse;
 
// Set the ranges
var	x = d3.time.scale().range([0, width]);
var	y = d3.scale.linear().range([height, 0]);
 
// Define the axes
var	xAxis = d3.svg.axis().scale(x)
	.orient("bottom").ticks(5);
 
var	yAxis = d3.svg.axis().scale(y)
	.orient("left").ticks(5);
 
// Define the line
var	valueline = d3.svg.line()
	.x(function(d) { return x(d.date); })
	.y(function(d) { return y(d.close); });
    
// Adds the svg canvas
var	svg = d3.select("body")
	.append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
	.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
 
// Get the data
d3.tsv("data-alt.tsv", function(error, data) {
	data.forEach(function(d) {
		d.date = parseDate(d.date);
		d.close = +d.close;
	});
 
	// Scale the range of the data
	x.domain(d3.extent(data, function(d) { return d.date; }));
	y.domain([0, d3.max(data, function(d) { return d.close; })]);
 
	// Add the valueline path.
	svg.append("path")	
		.attr("class", "line")
		.attr("d", valueline(data));
 
	// Add the X Axis
	svg.append("g")		
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis);
 
	// Add the Y Axis
	svg.append("g")		
		.attr("class", "y axis")
		.call(yAxis);
 
});
</body>  
</html> 