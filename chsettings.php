<?php
include "header.php";

?>


  <div id="sidebar" class="col-xs-12 col-sm-6">
<?php
echo isset($msg)?$msg:"";

?>
<div class="col-xs-12 col-sm-12">
		<h2>Channel Fields Settings</h2>
			<form class="?c_id=<?php echo $channelId;?>" method="post" action=""  >
						
						<div class="form-group" >
							<label for="name" class="cols-sm-2 control-label" >Name</label>
							<div class="cols-sm-10">
								<div class="input-group" >
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="channelName" value='<?php echo $row['channelName']; ?>' id="name"  placeholder="Enter channel name"    />
									
			
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
									<input type="text" class="form-control" name="channelDescription" value='<?php echo $row['channelDescription']; ?>' id="channelDiscription"  placeholder="Enter channel discription"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field1</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" value='<?php echo $row['field1']; ?>' name="field1" id="field1"  placeholder="Enter field1"/>
									
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field2</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" value='<?php echo $row['field2']; ?>' name="field2" id="field2"  placeholder="Enter field2"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field3</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" value='<?php echo $row['field3']; ?>' name="field3" id="field3"  placeholder="Enter field3"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field4</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  value='<?php echo $row['field4']; ?>'name="field4" id="field4"  placeholder="Enter field4"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field5</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  value='<?php echo $row['field5']; ?>'name="field5" id="field5"  placeholder="Enter field5"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field6</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  value='<?php echo $row['field6']; ?>'name="field6" id="field6"  placeholder="Enter field6"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field7</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  value='<?php echo $row['field7']; ?>'name="field7" id="field7"  placeholder="Enter field7"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Field8</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  value='<?php echo $row['field8']; ?>'name="field8" id="field8"  placeholder="Enter field8"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Meta Data</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" value='<?php echo $row['metaData']; ?>' name="metaData" id="metaData"  placeholder="Enter meta data"/>
								</div>
							</div>
						</div>
					

						<div class="form-group ">

						
							<input name= "update" type="submit" id="submit" class="btn btn-primary btn-lg btn-block login-button" value="Update channel"/>
						</div>
					
					</form>
				<div id="sharing_parent_div" style="display:<?php echo $row['status']==2?"block":"none";	?>">
            <br>
        </div>
  </div>
  </div>
  <script type="text/javascript">_satellite.pageBottom();</script>

  </body>
</html>
      
  