<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include 'nav/_dbconnect.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	echo $username.'&nbsp;'.$password;

    $username = stripslashes($username);
    $username = addslashes($username);

    $password = stripslashes($password);
    $password = addslashes($password);
	$password = md5($password);
	
	$sql = "select * from `users` WHERE username='$username' and password='$password'";
	$results = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($results); 

	if($num == 1)
	{
		while ($row = mysqli_fetch_assoc($results))
		{
			$login = true;
			session_start();
			$_SESSION['uloggedin'] = true;
			$_SESSION['cust'] = $username;
			$_SESSION['uuid'] = $row['uid'];
			echo $row['uid'];
			$try = '9870330063';
			$_SESSION['user'] = $try;
			header("location: umain.php?q=0");
		}
	}
	else
	{
		$showError = "Invalid Credentials";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
    <link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="nav/all.css">
</head>
<body>
	<?php 
		require 'nav/_nav.php';
		require 'loading.php';
		?> 
	<section style="background: linear-gradient(#E91E63,#0f3959); /*background: linear-gradient(#FFC107,#E91E63);*/">
		<div class="container">
			<div class="user signinBx">
				<div class="imgBx"><img src="images/pics2.jpg"></div>
				<div class="formBx">
					<form action="/snacks/ulogin.php" method="post">
						<h2 style="color:#444; font-weight: 800;">Users Sign In</h2>
						<h2>Sign In</h2>
						<input type="text" name="username" id="username" placeholder="Username" required="" autocomplete="off" title="Enter the Username">
						<input type="password" name="password" id="password" placeholder="Password" required="" autocomplete="off" title="Enter the Password">
						<input type="submit" name="" value="Login" />
						<p class="signup">Don't have an Account ???<a href="/snacks/usignup.php">Sign Up.</a></p>
						<?php 
							if ($login)
							{
								echo "Success! You are Succesfully Logged In";
							}
							if ($showError)
							{
								echo $showError;
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php 
		require 'nav/footer.php' 
	?>
</body>
</html>