<?php
ob_start();

include("dbConnection/connect.php");
if(isset($_GET['live'])){
	$apikey=mysqli_real_escape_string($conn,$_GET['api-key']);
	$sql=mysqli_query($conn,"Select * from channeltable where apikey='$apikey'");
	$channel=mysqli_fetch_array($sql);
	$channelId=$channel['channelId'];
	$field_id=mysqli_real_escape_string($conn,$_GET['field_id']);
	$reading = rand(20, 25);
	$query = mysqli_query($conn, "Insert into `field-data` (channelId,reading,field_id) values($channelId,'$reading',$field_id)") or die(mysqli_error($con));
	echo mysqli_insert_id($conn)."<br>".$reading;
	// sleep(3000);
	// $page = $_SERVER['PHP_SELF'];
$sec = "2";
header("Refresh: $sec; url=addApi.php?api-key=$apikey&field_id=$field_id&live");
}
else{
	$apikey=mysqli_real_escape_string($conn,$_GET['api-key']);
	$sql=mysqli_query($conn,"Select * from channeltable where apikey='$apikey'");
	$channel=mysqli_fetch_array($sql);
	$channelId=$channel['channelId'];
	$reading=mysqli_real_escape_string($conn,$_GET['reading']);
	$field_id=mysqli_real_escape_string($conn,$_GET['field_id']);
	
	
	//////////
	$userId=$channel['userId'];
	$sql1=mysqli_query($conn,"Select * from fieldattr where channel_id='$channelId' && field_id='$field_id'");
	$sql2=mysqli_query($conn,"Select * from usertable where userId='$userId'");
	$value=mysqli_fetch_array($sql1);
	$emailId=mysqli_fetch_array($sql2);
	$email=$emailId['email'];
	$trigger=$value['trigger'];
	
	
	
		if($trigger<$reading){
		
		sendEmail($email,$trigger,$reading);
		
			$query = mysqli_query($conn, "Insert into `field-data` (channelId,reading,field_id) values($channelId,'$reading',$field_id)") or die(mysqli_error($con));

			
			
		}
	else{
			$query = mysqli_query($conn, "Insert into `field-data` (channelId,reading,field_id) values($channelId,'$reading',$field_id)") or die(mysqli_error($con));

		}
	
	}	
	
?>

<?php



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



function sendEmail($email,$trigger,$reading) {

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

			$mail->setFrom('verify@thingsshub.info', 'Support');

			

			$mail->addAddress($email, 'testing');   



			//Content

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Warning';

$mail->Body    = "Alert!<br> Your Reading=".$reading." exceeds your Trigger=".$trigger." value.<br> Best Regards<br> Team ThingsHub.info ";

			$mail->send();

			
		} 

	catch (Exception $e) 

	{

	   $return=array(

				

				"Cannot send Confirmation link to your e-mail address.",

				

				

				);

				//header('Content-type: application/json');

			echo json_encode($return);

		    echo 'Mailer Error: ' . $mail->ErrorInfo;

		die();

	}

}		

?>
