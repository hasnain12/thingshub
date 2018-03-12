<?php
include "header.php";

?>


  <div id="sidebar" class="col-xs-12 col-sm-12">

<div class="col-xs-12 col-sm-12">
		<h2>Data Exporting</h2>
		Download all of this Channel's feeds in CSV format. <br>
		<a href="download.php?c_id=<?php echo $channelId; ?>&download" class="btn btn-info">Download</a>
		</div>
<div class="col-xs-12 col-sm-12">
		<h2>Data Exporting</h2>
		Download specific feeds in CSV format. <br>
		<div class="datecontainer col-sm-12">
  
			  <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 3px solid #ccc; width: 30%">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div>
  </div>
  	<div class="col-sm-12">
		<label>Select Fields</label><br>
		<label>Field1 :</label><input type="checkbox" value="1" class="fields"><br>
		<label>Field2 :</label><input type="checkbox" value="2" class="fields"><br>
		<label>Field3 :</label><input type="checkbox" value="3" class="fields"><br>
		<label>Field4 :</label><input type="checkbox" value="4" class="fields"><br>
		<label>Field5 :</label><input type="checkbox" value="5" class="fields"><br>
		<label>Field6 :</label><input type="checkbox" value="6" class="fields"><br>
		<label>Field7 :</label><input type="checkbox" value="7" class="fields"><br>
		<label>Field8 :</label><input type="checkbox" value="8" class="fields"><br>
  </div>
  <div class="col-sm-12">
		<a href="download.php?c_id=<?php echo $channelId; ?>&download" class="specific btn btn-info">Download</a>
		</div>
		</div>
  </div>
  <script>
  
var start;
 var end;
  $(function() {

    start = moment().subtract(29, 'days');
    end = moment();
$(document).ready(function(){
		$(document).on("change",".fields",function(){
			cb(start,end);
		})
	});
    function cb(start, end) {
		$('#reportrange span').html(isNaN(start)?'Live Data':start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	fields="";
	$("input[type='checkbox']:checked").each(function(i){
		fields=fields+$(this).val();
		if($("input[type='checkbox']:checked").length-1!==i)
			fields=fields+",";
	})
	console.log(fields);
  ss = new Date(start);
			ss=ss.valueOf()/1000;
			ee = new Date(end);
			ee=ee.valueOf()/1000;
	href="download.php?c_id=<?php echo $channelId; ?>&download"+"&start="+ss+"&end="+ee+"&fields="+fields;
    $(".specific").attr("href",href);
	}

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
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
	
  </script>
  
  <script type="text/javascript">_satellite.pageBottom();</script>

  </body>
</html>
      
  