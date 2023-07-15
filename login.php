<html>
	<body>
		<?php
		//echo "hi";
			$conn = mysqli_connect("localhost", "root", "", "BUS");
				if(!$conn){ 									//conn is an object where connect_error is a property of it
		 			die("Connection failed: Please try again");		//to terminate script execution
				}
				//checking credentials with those in Accounts table
				$email = mysqli_real_escape_string($conn, $_POST['email']); 
				$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
				$emailCheck = "Select email from Accounts where email= '$email';" ;
				$pwdCheck = "Select pwd from Accounts where pwd= '$pwd' and email= '$email';" ;
				$emailResult = mysqli_query($conn, $emailCheck);
				$pwdResult = mysqli_query($conn, $pwdCheck);
				
		//check if there is an account 
				if($emailResult && mysqli_num_rows($emailResult) ==0){
					echo '<p style="color: red; font-weight: bold; font-size: 16px;margin-left:30%;font-size:140%;">There is no account with this email, signup to create an account.</p>';
				}
				else if($pwdResult && mysqli_num_rows($pwdResult) ==0){
					echo '<p style="color: red; font-weight: bold; font-size: 16px;margin-left:42%;font-size:150%;margin-top:15%">Incorrect password</p>';
				}
				
				else if(mysqli_num_rows($emailResult) ==1 && mysqli_num_rows($pwdResult) ==1){
						// Redirect to the desired webpage
					header("Location:./BUS%20FRONT_PAGE.html");
					exit; // Make sure to terminate the script after redirection
					
    					/*
					Hi <?php echo $_POST["name"]; ?><br>
			
					Hope you have a nice day!<br>
					You have successfully logged in.
					*/
				}
			mysqli_close($conn);
		?>	
		<button type="button" style="color:blue;margin-left:45%;background-color:yellow;font-size:150%;" onclick= "window.location.href ='./signup.html' ">Sign up</button>
			
	</body>
</html>
