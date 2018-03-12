<?php





	session_start();

	function randomKey($length) {

	$key="";

    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));



    for($i=0; $i < $length; $i++) {

        $key .= $pool[mt_rand(0, count($pool) - 1)];

    }

    return $key;

}

	if(isset($_SESSION["my_session"]))

		{

			//include("./common/logout_header.php");

		}

		

	if(!isset($_SESSION["my_session"]))

	{

		header("Location: login.php");

	}



 

 include("dbConnection/connect.php");

 $userId=$_SESSION["user_id"];



 $field1="";

		$field2='';

		$field3='';

		$field4='';

		$field5='';

		$field6='';

		$field7='';

		$field8='';

 

		$name=$_POST['channelName'];

		$discription=$_POST['channelDiscription'];



		

			$field1=$_POST['field1'];

			$field2=$_POST['field2'];

			$field3=$_POST['field3'];

			$field4=$_POST['field4'];

			$field5=$_POST['field5'];

			$field6=$_POST['field6'];

			$field7=$_POST['field7'];

			$field8=$_POST['field8'];

			

			$metadata=$_POST['metaData'];

			// $access=$_POST['access'];

			$date = date('Y/m/d');

			//echo $date;

//$tags=$_POST['tags'];

//$elevation=$_POST['elevation'];

//$showlocation=$_POST['showlocation'];



if($name==""||$discription==""){

                          $return=array(

					"title" =>"Parameter is missing!",

					"message" => "Parameter is missing.",

					"Error" => "true",

					"statusCode"=>"422"

					); 

				echo json_encode($return);

                                mysqli_close($conn);

				die();



             }

            else{

// Insert data into mysql

while($apikey=randomKey(10)){

	mysqli_query($conn,"Select * from channeltable where apikey='".$apikey."'") or die(mysqli_error($conn));

	if(mysqli_affected_rows($conn)>0)

		continue;

	else{

	$sql="INSERT INTO channeltable (channelName,channelDescription, field1,field2,field3,field4,field5,field6,field7,field8,metaData,createdDate,updated,userId,apikey)

VALUES ('$name', '$discription', '$field1' , '$field2' , '$field3', '$field4', '$field5', '$field6', '$field7', '$field8','$metadata','$date','$date','$userId','$apikey')";

break;

	}

}





$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

$channel_id=mysqli_insert_id($conn);

$fields=array($field1,$field2,$field3,$field4,$field5,$field6,$field7,$field8);

			for($i=0;$i<count($fields);$i++){

				// if($fields[$i]!==""){

				$field_id=$i+1;

				mysqli_query($conn,"insert into fieldattr (channel_id,field_id,title) values ($channel_id,$field_id,'".$fields[$i]."')") or die(mysqli_error($conn));

				// }
header("Location: ./mychannels.php");

			}

echo var_dump($result);



if($result){

	header("Location: ./mychannels.php");

}





else {

	echo mysqli_error;

echo "ERROR";

}

			}

?>



