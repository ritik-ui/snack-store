<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include 'nav/_dbconnect.php';
	$uid = uniqid();
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	
	$exists = "SELECT * FROM `users` WHERE username = '$username'";
	$results = mysqli_query($conn,$exists);
	$numExist = mysqli_num_rows($results);
	if ($numExist > 0) 
	{
		$showError = "Username Already Exists";		
	}
	else
	{

		if(($password == $cpassword))
		{
			$username = stripslashes($username);
			$username = addslashes($username);
		
			$password = stripslashes($password);
			$password = addslashes($password);
			$password = md5($password);
		
			$sql = "INSERT INTO `users` ( `uid`, `Username`, `Password`, `Date`, `uinfo`) VALUES ('$uid','$username', '$password', current_timestamp(), 'Unentered')";
			$results = mysqli_query($conn,$sql);

			if($results)
			{
				$showAlert = true;
			}
		}
		else
		{
			$showError = "Password does not Match";
		}
	}		
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="nav/all.css">
</head>
<body>
	<?php 
		require 'nav/_nav.php'; 
	?>
	<section style="background: linear-gradient(#E91E63,#0f3959); /*background: linear-gradient(#FFC107,#E91E63);*/">
		<div class="container">
			<div class="user signinBx">
				<div class="formBx">
					<form action="/snacks/usignup.php" method="post">
						<h2 style="color:#444; font-weight: 800;">Users Signup</h2>
						<h2>Create an Account</h2><br>
						
						<label for="username"></label>
						<input type="text" id="username" name="username" placeholder="Username" required="" autocomplete="off" title="Enter the Username">
						
						<label for="password"></label>
						<input type="password" id="password" name="password" required="" autocomplete="off" placeholder="Create Password" title="Enter the Password">
						
						<label for="cpassword"></label>
						<input type="password" id="cpassword" name="cpassword" required="" autocomplete="off" placeholder="Confirm Password" title="Re-Enter the Password">
						
						<input type="submit" name="" value="Sign Up">
						<p class="signup">Already have an Account ???<a href="/snacks/ulogin.php">Sign In.</a></p>
						<?php 
						if ($showAlert) {
							header("location: ulogin.php");
							echo "Success! Your Account is Succesfully Being Created You can now Login";
						}
						if ($showError) {
							echo $showError;
						}
						?>
					</form>
				</div>
				<div class="imgBx"><img src="images/pics1.jpg"></div>
			</div>
        </div>
	</section>
<?php require 'nav/footer.php' ?>
</body>
</html>