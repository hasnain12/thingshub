<?php

	 session_start();

 include("dbConnection/connect.php");

		

if(isset($_POST['action'])&&$_POST['action']=='getFieldData'){

		$channelId=mysqli_real_escape_string($conn,$_POST['channelId']);

		$start=(int)mysqli_real_escape_string($conn,$_POST['start']);

		$end=(int)mysqli_real_escape_string($conn,$_POST['end']);

		$live= time()-3 ;

		// die;

		$unix_condition=$start==0?" and UNIX_TIMESTAMP(timeStamp) >=$live limit 1":" and UNIX_TIMESTAMP(timeStamp) between $start and $end";

		$fieldId=(int)mysqli_real_escape_string($conn,$_POST['fieldId']);

		$fieldId++;

		$query11=mysqli_query($conn,"Select * from fieldattr where channel_id=$channelId and field_id=$fieldId") or die(mysqli_error($conn));

			$yaxis=mysqli_fetch_array($query11);

			$results=$yaxis['results'];

		if(!isset($_POST['live'])){

			$unix_condition=$start==0?" limit 30":" and UNIX_TIMESTAMP(timeStamp) between $start and $end limit $results";

		}

		else{

			$unix_condition=" and UNIX_TIMESTAMP(timeStamp) >=$live limit 1";

		}

		// echo "Select UNIX_TIMESTAMP(timeStamp),reading from field01 where channelId='$channelId' and field_id='$fieldId' ".$unix_condition;die;

		// die;

		$query=mysqli_query($conn,"Select UNIX_TIMESTAMP(timeStamp),reading from `field-data` where channelId='$channelId' and field_id='$fieldId' ".$unix_condition) or die(mysqli_error($conn));

		$results=mysqli_fetch_all($query);

		// print_r($results);

		// die;

		for($i=0;$i<count($results);$i++){

			$date=$results[$i][0];

			 $results[$i][0]=isset($_POST['live'])?$live*1000:(int)($results[$i][0])*1000;

			 $results[$i][1]=(float)($results[$i][1]);

		}

		if(isset($_POST['live'])&&count($results)!==0){

			echo "[".$results[0][0].",".$results[0][1]."]";

		}

		else{

		echo json_encode($results);

		}

		// sleep(10);

		die;

	}

			

if(isset($_POST['action'])&&$_POST['action']=='getFieldDataByRange'){

		$channelId=mysqli_real_escape_string($conn,$_POST['channelId']);

		$start=(int)mysqli_real_escape_string($conn,$_POST['start']);

		$end=(int)mysqli_real_escape_string($conn,$_POST['end']);

		

$query = mysqli_query($conn,'SELECT * FROM channeltable where channelId='.$channelId) or die(mysqli_error($conn));

		$row = mysqli_fetch_array($query);

		

			$fields=array($row['field1'],$row['field2'],$row['field3'],$row['field4'],$row['field5'],$row['field6'],$row['field7'],$row['field8']);

			for($i=0;$i<count($fields);$i++){

				if($fields[$i]!==""){

					$field_id=$i+1;

					$query11=mysqli_query($conn,"Select * from fieldattr where channel_id=$channelId and field_id=$field_id") or die(mysqli_error($conn));

					$yaxis=mysqli_fetch_array($query11);

					$color=$yaxis['color'];

					$results=$yaxis['results'];

					if($yaxis['y-axis']!==""&&$yaxis['y-axis']!==null){

						$y_name=$yaxis['y-axis'];

					}

					else{

						$y_name=$yaxis['title'];

					}

					$queryy=mysqli_query($conn,"Select * from fieldattr where field_id=".$field_id." and channel_id=".$channelId) or die(mysqli_error($con));

						$fetch=mysqli_fetch_array($queryy);

						

					?>

					<div class="col-sm-6">

					<div class="panel panel-info">

						<div class="panel-heading">

						 <?php

						 // echo $_SESSION['user_id']."<br>";

						 // echo $row['userId']."<br>";

						 // die;

						 if((isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId'])){

				?>

	<a href="#"  data-toggle="modal" data-target="#myModal<?php echo $field_id; ?>">Edit</a>

						

				<?php

					// header("Location:index.php");

						}

						?>

						</div>

						<div class="panel-body">

							<div id="fields<?php echo $i; ?>" style="width: 100%; height: 300px;display: inline-block;"></div> 

						</div>

					</div>

					

					</div>

					<div id="myModal<?php echo $field_id; ?>" class="modal fade" role="dialog">

						  <div class="modal-dialog">



							<!-- Modal content-->

							<div class="modal-content">

							  <div class="modal-header">

								<button type="button" class="close" data-dismiss="modal">&times;</button>

								<h4 class="modal-title">Edit Fields</h4>

							  </div>

							  <div class="modal-body">

							  

									<form class="" method="post" action="#">

						

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Enter Field Title</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="text" class="form-control" name="title" id="name" value="<?php echo $fetch['title']; ?>" placeholder="Enter Field Title"/>

												</div>

											</div>

										</div>

										<input type="hidden" name="channel_id" value="<?php echo $channelId; ?>">

										<input type="hidden" name="field_id" value="<?php echo $field_id; ?>">

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Y-Axis</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="text" value="<?php echo $fetch['y-axis']; ?>"  class="form-control" name="y-axis" id="name"  placeholder="Enter Y-Axis Name"/>

												</div>

											</div>

										</div>

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Y-Axis Min. Value</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="number"  value="<?php echo $fetch['ymin']; ?>"  class="form-control" name="ymin" id="name" step="0.5" placeholder="Enter Y-Axis Minimum value " />

												</div>

											</div>

										</div>

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Y-Axis Max. Value</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="number" value="<?php echo $fetch['ymax']; ?>"  class="form-control" name="ymax" id="name"  placeholder="Enter Y-Axis Maximum value "/>

												</div>

											</div>

										</div>

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Colour</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="color" value="<?php echo $fetch['color']; ?>"  class="form-control" name="color" id="name" />

												</div>

											</div>

										</div>

										<div class="form-group">

											<label for="name" class="cols-sm-2 control-label">Results</label>

											<div class="cols-sm-10">

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>

													<input type="number" value="<?php echo $fetch['results']; ?>"  class="form-control" name="results" id="name"  placeholder="Enter No. Results"/>

												</div>

											</div>

										</div>
										<div class="form-group">
											<label for="name" class="cols-sm-2 control-label">Trigger</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
													<input type="number" value="<?php echo $fetch['trigger']; ?>"  class="form-control" name="trigger" id="name"  placeholder="Enter Trigger Value"/>
												</div>
											</div>
										</div>

										<div class="form-group ">

											<input name= "submit" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button" value="Update Field"/>

										</div>

									

									</form>

								

							  </div>

							 

							</div>



						  </div>

						</div>

						

	<script type="text/javascript">



		function loadData<?php echo $i; ?>(){

			$(document).ready(function(){

			

			s=<?php echo $start; ?>;

			e=<?php echo $end; ?>;

        // s = parseSeconds(selectedDate);

			// console.log();

			// console.log(e+"     "+s);

			// alert("usman")

			$.ajax({

				url: 'ajax.php',

				method: 'POST',

				dataType: 'json',

				data: {action: 'getFieldData', channelId: <?php echo $channelId;?>, fieldId: <?php echo $i;?>, start: s, end: e},

				success: function(result) {

					

				var chart<?php echo $i; ?>=	Highcharts.chart('fields<?php echo $i; ?>', {

        chart: {

			

            zoomType: 'x',

			<?php 

			if($start==0){

				?>

				 animation: Highcharts.svg, // don't animate in old IE

				marginRight: 10,

				events: {

					load: function () {



						// set up the updating of the chart each second

						var series = this.series[0];

						setInterval(function () {

							$.ajax({

								url: 'ajax.php',

								method: 'POST',

								dataType: 'json',

								data: {action: 'getFieldData', channelId: <?php echo $channelId;?>, fieldId: <?php echo $i;?>, start: s, end: e, live: "1"},

								success: function(result) {

									// console.log(result);

									series.addPoint(result, true, true);

								}

							});

							// var x = (new Date()).getTime(), // current time

								// y = Math.random();

							// series.addPoint([x, y], true, true);

						}, 3000);

					}

				}

			<?php

			}

			?>

			

        },

        title: {

            text: '<?php echo $yaxis['title']; ?>'

        },

        subtitle: {

            text: document.ontouchstart === undefined ?

                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'

        },

        xAxis: {

            type: 'datetime'

        },

        yAxis: {

			min : <?php echo $yaxis['ymin']; ?>,

			max : <?php echo $yaxis['ymax']; ?>,

            title: {

                text: '<?php echo $y_name; ?>'

            }, plotLines: [{

            value: 0,

            width: 1,

            color: '#ccc'

        }]

			

        },

        legend: {

            enabled: false

        },

		

        plotOptions: {

            area: {

                fillColor: {

                    linearGradient: {

                        x1: 0,

                        y1: 0,

                        x2: 0,

                        y2: 1

                    },

                    stops: [

                        [0, Highcharts.getOptions().colors[0]],

                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]

                    ]

                },

                marker: {

                    radius: 2

                },

                lineWidth: 1,

                states: {

                    hover: {

                        lineWidth: 1

                    }

                },

                threshold: null

            }

        },



        series: [{

            type: 'area',

            color: '<?php echo $color; ?>',

            name: '<?php echo $fields[$i]; ?>',

            data: result

        }]

    });

	/* if(s==0){

		var series = chart<?php echo $i; ?>.series[0],

                shift = series.data.length > 20; // shift if the series is 

                                                 // longer than 20

// options.series[0].data

            // add the point

            chart<?php echo $i; ?>.series[0].addPoint(result, true, shift);

	 setTimeout(loadData<?php echo $i; ?>, 3000);   

	} */

	  

				}

			});

		})

 

		}

		loadData<?php echo $i; ?>();



		</script>	

		

			<?php

				}

			

			// if($row['field1']!=="")

				

		}

		$cquery=mysqli_query($conn,"Select * from comparison where channel_id=$channelId") or die(mysqli_error($conn));

		$series=array();

		while($cfetch=mysqli_fetch_assoc($cquery)){

			$series[]=$cfetch;

		}

		echo "<script>var comgraph=".json_encode($series).";</script>";

		foreach($series as $cfetch){

		$comaprison=array($cfetch['field1'],$cfetch['field2']);

		if(!empty($comaprison)){

				// print_r($comaprison);

				// die;

				?>

				<div class="col-sm-6">

					<div class="panel panel-info">

						<div class="panel-heading">

						 Comparison Graph

						<?php

						if((isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId'])){

				?>

					<a onclick="return confirm('Are you sure to delete this?');" href="?compDel&c_id=<?php echo $channelId; ?>&field1=<?php echo $cfetch['field1']; ?>&field2=<?php echo  $cfetch['field2']; ?>"><span class="pull-right glyphicon glyphicon-remove"></span></a>

				<?php

						}

						?>

						</div>

						<div class="panel-body">

							<div id="comparison<?php echo $cfetch['id']; ?>" style="width: 100%; height: 300px;display: inline-block;"></div> 

						</div>

					</div>

					

				</div>

				<?php

				$fields2=array();

				for($i=0;$i<count($fields);$i++){

					$field_id=$i+1;

					$query22=mysqli_query($conn,"Select title from fieldattr where channel_id=".$channelId." and field_id=".$field_id ) or die(mysqli_error($conn));

					$title=mysqli_fetch_array($query22);

					$fields2[]=$title['title'];

				}

				// print_r($fields2);die;

				// mysqli_fetch_array("")

						echo "<script>var fields=".json_encode($fields2).";</script>";

		

				}						

			}

			?>

				<script type="text/javascript">

					s=<?php echo $start; ?>;

			e=<?php echo $end; ?>;

					if(comgraph.length)

					comgraphfunction(0,comgraph);

		function comgraphfunction(i,comgraph){

			var seriesss=[];

				ajaxx2(comgraph[i].field1,i,seriesss,1);

				if(i<comgraph.length-1){

					i++;

					comgraphfunction(i,comgraph);

				}

				

		}

		function ajaxx2(field,i,seriesss,cond){

	var object={};

			

	name=fields[field-1];

					object.name=name;

				$.ajax({

					url: 'ajax.php',

					method: 'POST',

					dataType: 'json',

					data: {action: 'getFieldData', channelId: <?php echo $channelId;?>, fieldId:field-1, start: s, end: e},

					success: function(result) {

							 object.data=result;

							seriesss.push(object);

							if(cond)

								ajaxx2(comgraph[i].field2,i,seriesss,0);

							else

								CreateComparison2(seriesss,comgraph[i].id);

							

					} 

				});

}



function CreateComparison2(series2,index){

		Highcharts.chart('comparison'+index, {

		chart: {

        type: 'spline',

		 zoomType: 'x',

			

    },

 xAxis: {

        type: 'datetime',

        dateTimeLabelFormats: { // don't display the dummy year

            month: '%e. %b',

            year: '%b'

        },

        title: {

            text: 'Date'

        }

    },	

	yAxis: {

            min : 0,

			title: {

                text:'y-axis'

            },

            plotLines: [{

                value: 0,

                width: 2,

                color: 'silver'

            }]

        },

		

        plotOptions: {

            series: {

                compare: 'percent',

                showInNavigator: true

            }

        },



        tooltip: {

            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',

            valueDecimals: 2,

            split: true

        },



        series: series2

    });

		}

		</script>

				

<?php		

		 if((isset($_SESSION['user_id'])&&$_SESSION['user_id']==$row['userId'])){

						 ?>

		<div class="col-sm-6" style="height:140px;">

			<div class="panel panel-info">

				<div class="panel-heading">

				Visualizations

				</div>

				</div class="panel-body">

				<h3>

				<a href="#"  data-toggle="modal" data-target="#comaprison">

	

					<center>+ Add Visualizations</center>

					</a>

				</h3>

				</div>

			</div>

		<div id="comaprison" class="modal fade" role="dialog">

			  <div class="modal-dialog">



				<!-- Modal content-->

				<div class="modal-content">

				  <div class="modal-header">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Add Comparison</h4>

				  </div>

				  <div class="modal-body">

						<form class="" method="post" action="">

							<?php

							for($i=0;$i<count($fields);$i++){

								if($fields[$i]!==""){

									$field_idd=$i+1;

									

									// $comaprison=$row['comparison_field']!==""&&$row['comparison_field']!==null?json_decode($row['comparison_field']):array();

									// $checked=in_array($field_idd,$comaprison)?"checked":"";

									echo "<label>Field$field_idd</label>";

								echo "<input type='checkbox' value='$field_idd' name='comparison_field[]' ><br>";

								}

							}

				?>

				<input type="submit" value="Submit" name='comparison' class="btn btn-info">

						</form>

				  </div>

				</div>

				</div>

		</div>

		<script>

			$(document).ready(function(){

				$("input[type='checkbox']").on("click",function(){

					if($("input[type='checkbox']:checked").length==2){

					$("input[type='checkbox']:not(:checked)").prop("disabled",true)

					}

					else{

					$("input[type='checkbox']:not(:checked)").prop("disabled",false)

						

					}

				})

				

		

			})

		</script>

						 <?php

						 }

		

	}

	if(isset($_POST['action'])&&$_POST['action']=='getTestt'){

		?>

			<div id="container" style="width: 100%; height: 300px;display: inline-block;"></div> 

						

	<script type="text/javascript">

		var seriesOptions = [],

    seriesCounter = 0,

    names = ['MSFT', 'AAPL', 'GOOG'];



/**

 * Create the chart when all data is loaded

 * @returns {undefined}

 */

function createChart() {



    Highcharts.stockChart('container', {



        rangeSelector: {

            selected: 4

        },



        yAxis: {

			min : 0,

            labels: {

                formatter: function () {

                    return (this.value > 0 ? ' + ' : '') + this.value + '%';

                }

            },

            plotLines: [{

                value: 0,

                width: 2,

                color: 'silver'

            }]

        },



        plotOptions: {

            series: {

                compare: 'percent',

                showInNavigator: true

            }

        },



        tooltip: {

            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',

            valueDecimals: 2,

            split: true

        },



        series: seriesOptions

    });

}



$.each(names, function (i, name) {

console.log('https://www.highcharts.com/samples/data/' + name.toLowerCase() + '-c.json');

    $.getJSON('https://www.highcharts.com/samples/data/' + name.toLowerCase() + '-c.json',    function (data) {



        seriesOptions[i] = {

            name: name,

            data: data

        };



        // As we're loading the data asynchronously, we don't know what order it will arrive. So

        // we keep a counter and create the chart when all the data is loaded.

        seriesCounter += 1;



        if (seriesCounter === names.length) {

            createChart();

        }

    });

});

		</script>	

		

			<?php

			

	}

	

?>