<?php
		require('dbConnection/connect.php');

                $email= $_REQUEST["email"]; 
		$passKey= $_REQUEST["passkey"];
		if( $email==""||$passKey=="" ){
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

                //from activation Table
		$sql_comparison="select * from tempusertable where email = '$email'";

		$result=mysqli_query($conn,$sql_comparison);

                if(mysqli_num_rows($result) >0)
		{
			$id="";
			$firstName="";
			    $lastName="";
                $phone="";
                $email="";
				$password="";
				
			 while ($row=mysqli_fetch_row($result))
                         {
						 $id=$row[0];
						 $firstName=$row[1];
						 $lastName=$row[2];
						 $email=$row[3];
						 $password=$row[4];
						 $activation=$row[5];
						}//end of while  
                                                 //now Move record from One Table to Other
$sql_query= "Insert into usertable (firstName,lastName,email,password) VALUES ('$firstName','$lastName','$email','$password') ";
						 if(mysqli_query($conn,$sql_query))
								{
									//now Remove Record from user(Temp) Table 
									// sql to delete a record
									$sql = "DELETE FROM tempusertable WHERE ID='$id'";

									if ($conn->query($sql) === TRUE) {
										$return=array(
												
											"Your Account Successfully Activated.",
												
												); 
											echo json_encode($return);	
mysqli_close($conn);
											die();
									} else {
										$return=array(
												"title" =>"Connot find.",
												"message" => "Cannot Find record for Delete.",
												"Error" => "true",
												"statusCode"=>"422"
												); 
											echo json_encode($return); 
mysqli_close($conn);
											die();
									}
											
								}//END OF iF FOR INSERT Query in UserTable (Main)
								else
								{
												$return=array(
												"title" =>"DATA INSERTION FAILED.",
												"message" => "DATA INSERTION FAILED.",
												"Error" => "true",
												"statusCode"=>"422"
												); 
											echo json_encode($return); 
mysqli_close($conn);
											die();
								}//end of else
		}//end of for chechking Email in Temp Table 
                else
                {
                  $return=array(
					"title" =>"No Account for Activation!",
					"message" => "No Email found for Activation.",
					"Error" => "true",
					"statusCode"=>"422"
					); 
					echo json_encode($return);
mysqli_close($conn);
					die();
                }
}//end of else if parameter not equal to null 

?>

