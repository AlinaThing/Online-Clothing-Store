<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
    <?php

	$Name=$_POST['txtName'];
	$Address=$_POST['txtAddress'];
	$City=$_POST['cmbCity'];
	
	$Email=$_POST['txtEmail'];
	$Mobile=$_POST['txtMobile'];
	$Gender=$_POST['rdGender'];
	$BirthDate=$_POST['txtDate'];
	$UserName=$_POST['txtUserName'];
	$Password=$_POST['txtPassword'];
	

	//$enc_pw=md5($Password);
	$v_key=md5(time().$Email);
	$verified=false;
	$body="<a href='http://localhost/Online%20Clothing%20Store/Verify.php?key=$v_key'>Click here to verify</a>";
	

	if($UserName && $Password){
		$conn= mysqli_connect("localhost","root","","shopping");
		
		$result = mysqli_query($conn,"SELECT *  FROM customer_registration WHERE username='".$UserName."' or Email='".$Email."'");
		if($result){
			  if(mysqli_num_rows($result)>0){
				echo '<script type="text/javascript">alert("User Exist with email or username.");window.location=\'register.php\';</script>';
				mysqli_close ($conn);

			}else{
					
				if ($conn->connect_error) {
					die("Connection failed:" .$conn->connect_error);
				  }

				    $con = mysqli_connect ("localhost","root", "", "shopping"); 
					$insert_sql="INSERT INTO customer_registration (CustomerName,Address,City,Email,Mobile,Gender,UserName,Password,Verification_Code,Verified,BirthDate) VALUES ('$Name','$Address','$City','$Email','$Mobile','$Gender','$UserName','$Password','$v_key',0,'$BirthDate')";
				
					if (mysqli_query($conn,$insert_sql)) {
							
							$subject = "User Verification";
							
							 // Always set content-type when sending HTML email
							 $headers = "MIME-Version: 1.0" . "\r\n";
							 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							 $headers .= "From: Alina Thing";
							
							 if (mail($Email, $subject, $body, $headers)) {
								echo '<script type="text/javascript">alert("Registration Completed Succesfully.Please Check Mail to Verify.");window.location=\'index.php\';</script>';
								
								mysqli_close ($conn);
							} else {
								echo '<script type="text/javascript">alert("Registration Completed Succesfully but Email Sending Failed.");window.location=\'index.php\';</script>';
								mysqli_close ($conn);
							} 
							 
							/* 
							if (mail($Email,$subject,$body,$headers)) {
								
								echo '<script type="text/javascript">alert("Registration Completed Succesfully.Please Check Mail to Verify.");window.location=\'index.php\';</script>';
								
								mysqli_close ($conn);
							} else {
   							
					//			echo '<script type="text/javascript">alert("Registration Completed Succesfully but Email Sending Failed.");window.location=\'index.php\';</script>';
								mysqli_close ($conn); 
							}*/
					} else {
						echo '<script type="text/javascript">alert("Registration Failed");window.location=\'register.php\';</script>';
						mysqli_close ($conn);

				  }
			
			  }
		  }
	}else{
		echo '<script type="text/javascript">alert("Error");window.location=\'index.php\';</script>';
	}

?>
</body>

</html>