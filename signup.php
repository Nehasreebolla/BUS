<html>
	<body style="background-color:rgb(255,254,145);">
		<?php
		//echo "hi";
		$conn = mysqli_connect("localhost", "root", "", "BUS");
		if(!$conn){
			die("Connection failed: Please try again");
		}

		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']); 
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$emailCheck = "SELECT email FROM Accounts WHERE email = '$email';" ;
		$pwdCheck = "SELECT pwd FROM accounts WHERE pwd = '$pwd';" ;
		$emailResult = mysqli_query($conn, $emailCheck);
		$pwdResult = mysqli_query($conn, $pwdCheck);
		
		//echo "hi before empty";
		if (empty($name) || empty($email) || empty($pwd)) {
			echo '<p style="font-size:200%; margin-left:35%; margin-top:10%;">Please fill in all the required fields.</p>';
                      
		}
		else if($emailResult && mysqli_num_rows($emailResult) > 0){
			echo '<p style="font-size:200%; margin-left:35%; margin-top:10%;">An account already exists with this email</p>';
		}
		else if($pwdResult && mysqli_num_rows($pwdResult) > 0){
			echo '<p style="font-size:200%; margin-left:35%; margin-top:10%;">This password already exists. Give another password</p>' ;
		}
		else if($emailResult && $pwdResult){
			$fillDetails = "INSERT INTO Accounts (name, email, pwd) VALUES ('$name', '$email', '$pwd');" ; 
			$fillResult = mysqli_query($conn, $fillDetails);

			if ($fillResult) {
				echo '<p style="font-size:180%; margin-left:35%; margin-top:10%;">Account created successfully. :)</p>';
			} 
			else {
				echo '<p style="font-size:180%; margin-left:35%; margin-top:10%;">Error: Account not created. Try again later.</p>' ;
			}
		}
		
		mysqli_close($conn);
		?>

	        <span style="font-size: 200%; color: blue; margin-left:45%;margin-bottom:10%;">Hi <?php echo $_POST["name"]; ?></span><br>	
		<span style="font-size: 200%; color: blue; margin-left:40%;margin-top:20%;margin-bottom:10%;margin-right:35%;">Hope you have a nice day!</span><br>
		<span style="font-size: 200%; color: blue; margin-left:37%;margin-top:20%;margin-bottom:10%;">You have successfully signed up.</span><br>
		<button type="button" style="font-size: 200%; color: green;margin-left: 47%;margin-top:3%; " onclick="window.location.href= 'http://192.168.33.126/BUS%20FRONT_PAGE.html' ">Visit page</button>		
	</body>
</html>
