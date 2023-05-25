<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include 'nav/_dbconnect.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	
    $username = stripslashes($username);
    $username = addslashes($username);

    $password = stripslashes($password);
    $password = addslashes($password);
	$password = md5($password);
	
	$sql = "Select * from store where username='$username'AND password='$password'";
	$results = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($results); 

	if($num == 1)
	{
		while ($row = mysqli_fetch_assoc($results))
		{
			$login = true;
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['store'] = $username;
			$_SESSION['uid'] = $row['uid'];
			$try = '9870330063';
			$_SESSION['admin'] = $try;
			header("location: main.php");
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
	<section>
		<div class="container">
			<div class="user signinBx">
				<div class="imgBx"><img src="images/pics2.jpg"></div>
				<div class="formBx">
					<form action="/snacks/login.php" method="post">
						<h2>Sign In</h2>
						<input type="text" name="username" id="username" placeholder="Username" required="" autocomplete="off" title="Enter the Username">
						<input type="password" name="password" id="password" placeholder="Password" required="" autocomplete="off" title="Enter the Password">
						<input type="submit" name="" value="Login" />
						<p class="signup">Don't have an Account ???<a href="/snacks/signup.php">Sign Up.</a></p>
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