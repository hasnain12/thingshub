<?php

include "header.php";

?>

	

  <div class="datecontainer">

  

  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 3px solid #ccc; width: 30%">

    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;

    <span></span> <b class="caret"></b>

</div>

  </div>

 

<script>



var start;

 var end;

Highcharts.setOptions({

  global: {

    useUTC: false

  }

  // color: '#ccc',

});

  $(function() {



    // start = moment().subtract(29, 'days');

    // end = moment();

start = "Live";

    end = "Live";



    function cb(start, end) {

		$('#reportrange span').html(isNaN(start)?'Live Data':start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    loadGraphData(start,end,<?php echo $channelId; ?>);

		

	}



    $('#reportrange').daterangepicker({

        startDate: start,

        endDate: end,

        ranges: {

           'Live': ['live', 'live'],

           'Today': [moment(), moment()],

           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],

           'Last 7 Days': [moment().subtract(6, 'days'), moment()],

           'Last 30 Days': [moment().subtract(29, 'days'), moment()],

           'This Month': [moment().startOf('month'), moment().endOf('month')],

           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]

        }

    }, cb);



    cb(start, end);

    

});

 function loadGraphData(startt,endd,channelIdd){

	$(".loader").show();

	ss = new Date(startt);

			ss=ss.valueOf()/1000;

			ee = new Date(endd);

			ee=ee.valueOf()/1000;

	 $.ajax({

				url: 'ajax.php',

				method: 'POST',

				// dataType: 'json',

				data: {action: 'getFieldDataByRange', channelId: channelIdd, start: ss, end: ee},

				success: function(result) {

					$(".graph_data").html(result);

					$(".loader").hide();

				}

	 });

 }

  </script>  



 

  <br> <br/>

  <?php

  

    if(isset($_POST['submit'])){

				mysqli_query($conn,"update fieldattr set title='".$_POST['title']."',color='".$_POST['color']."',results='".$_POST['results']."',`y-axis`='".$_POST['y-axis']."',`ymin`='".$_POST['ymin']."',`ymax`='".$_POST['ymax']."',`trigger`='".$_POST['trigger']."' where channel_id=".$_POST['channel_id']." and field_id=".$_POST['field_id']."") or die(mysqli_error($conn));

				// if(mysqli_affected_rows($con)>0)

					echo "<div class='alert alert-success'>Field Updated Successfully!</div>";

			}

	 if(isset($_GET['compDel'])){

		mysqli_query($conn,"Delete from comparison where channel_id=".$_GET['c_id']." and field1=".$_GET['field1']." and field2=".$_GET['field2']."") or die(mysqli_error($conn));

		echo "<script>window.location.href='?c_id=".$_GET['c_id']."';</script>";

	}

			if(isset($_POST['comparison'])){

				$field1=$_POST['comparison_field'][0];

				$field2=$_POST['comparison_field'][1];

				$c_id=$_GET['c_id'];

				$query=mysqli_query($conn,"Select * from comparison where channel_id=$c_id and (field1=$field1 and field2=$field2) or (field1=$field2 and field2=$field1)") or die(mysqli_error($conn));

				if(mysqli_num_rows($query)>0)

					echo "<div class='alert alert-danger'>Unsuccussful! These fields already have comparison graph </div>";

				else{

					mysqli_query($conn,"Insert into comparison(channel_id,field1,field2) values(".$_GET['c_id'].",".$_POST['comparison_field'][0].",".$_POST['comparison_field'][1].")") or die(mysqli_error($conn));

					echo "<div class='alert alert-success'>Added to Comparison successfully!</div>";

				}

					}

			

			?>

  <div class="graph_data">

  		 </div>

	

  </body>

</html>

      

  