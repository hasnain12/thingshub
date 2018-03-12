<?php

include "header.php";

// echo randomKey(10);die;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



function sendShare($email) {

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

$mail->Body    = "Channel has been share with you successfully,Please login to view, channel id is ".$_GET['c_id'];

			$mail->send();

		} 

	catch (Exception $e) 

	{

	   $return=array(

				

				"Cannot send Confirmation link to your e-mail address.",

				

				

				);

			echo json_encode($return);

		    echo 'Mailer Error: ' . $mail->ErrorInfo;

		die();

	}

}	

if(isset($_POST['emails'])){

	$emails=json_decode($row['emails']);

	$emails[]=$_POST['emails'];

	$email=json_encode($emails);

	mysqli_query($conn,"Update channeltable set emails='".$email."' where channelId=".$_GET['c_id']) or die(mysqli_error($conn));

	sendShare($_POST['emails']);

	echo "<div class='alert alert-success'>New User Added successfully</div>";



}

if(isset($_GET['email'])){

	$emails=json_decode($row['emails']);

	$email=array_diff( $emails, [$_GET['email']] );

	$email=json_encode(array_values($email));

	// print_r($email);

	// die;

	

	mysqli_query($conn,"Update channeltable set emails='".$email."' where channelId=".$_GET['c_id']) or die(mysqli_error($conn));

	// echo "<div class='alert alert-success'>New User Added successfully</div>";

	echo "<script>window.location.href='$current?c_id=$channelId';</script>";

		

}



?>





  <div id="sidebar" class="col-xs-12 col-sm-6">



<div class="col-xs-12 col-sm-12">

		<h2>Channel Sharing Settings</h2>

		<form action="" method="get">

			<div class="row col-xs-12 col-sm-12" style="margin-bottom: 25px;">

				<div class="col-xs-12 col-sm-12">

					

					<div class="row">

						<label class="control-label radio-inline radio_pointer"><input id="make_private_radio" type="radio" value="0" name="status" <?php echo $row['status']==0?"checked":"";?>>Keep channel view private</label>

					</div>

					<div class="row">

						<label class="control-label radio-inline radio_pointer"><input id="make_public_radio" type="radio"  value="1"name="status" <?php echo $row['status']==1?"checked":"";?>>Share channel view with everyone</label>

					</div>

					<input type="hidden" name="c_id" value="<?php echo $_GET['c_id']; ?>">

					<div class="row">

						<label class="control-label radio-inline radio_pointer"><input id="share_private_radio" type="radio"  value="2" name="status" <?php echo $row['status']==2?"checked":"";?>>Share channel view only with the following users:</label>

					</div>

					<div class="row">

						<input type="submit" value="Save" >

					</div>

					

				</div>

			</div>

		</form>

        <div id="sharing_parent_div" style="display:<?php echo $row['status']==2?"block":"none";	?>">

            <div>

                <div id="sharing_div" class="form-group ">

                    <form action="?c_id=<?php echo $_GET['c_id']; ?>" method="post">

					<div>

                        <label id="sharing_email_label_div" class="col-sm-2 col-xs-12">Email Address</label>

                        <div id="sharing_child_div" class="col-sm-7 col-xs-12">

                            <input type="text" class="form-control shared_email_field maxlength_exempt" id="emails" placeholder="Enter email here" name="emails" maxlength="255">

						</div>

						<input type="hidden" name="c_id" value="<?php echo $_GET['c_id']; ?>">

					

                      <button class="btn btn-primary btn-sm add_shared_user" id="commit" name="button" type="submit">Add User</button>

                    </div>

					</form>

                </div>

            </div>

            <br>

            <div class="form-group" >

                <div id="shared_with_div">

                    <table id="shared_with_table" class="table table-striped table-bordered tablesorter" data-no-turbolink="">

                        <thead>

                            <tr>

                                <th>Email Address<i class="fa fa-unsorted"></i></th>

                                <th>Delete</th>

                            </tr>

                        </thead>

                        <tbody id="table_body">

						<?php

						$query = mysqli_query($conn,'SELECT * FROM channeltable where channelId='.$channelId) or die(mysqli_error($conn));

		$row = mysqli_fetch_array($query);



						$emails=json_decode($row['emails']);

						if(!empty($emails)){

							foreach($emails as $email){

								echo "<tr>";

								echo "<td>$email</td>";

								echo "<td><a href='?email=$email&c_id=$channelId&delete'>Delete</a></td>";

								echo "</tr>";

							}

						}

						?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

  </div>

  </div>

  <script type="text/javascript">_satellite.pageBottom();</script>



  </body>

</html>

      

  