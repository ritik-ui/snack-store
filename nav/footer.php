<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="all.css">
    <link rel="stylesheet" type="text/css" href="../quiz/login.css">
</head>
<body>
<div class="footer">
    
    <a href="/try/welcome.php">
	    <p class="text">Designed and Developed by Sagar Shelar & Team</p>
    </a>
	
    <ul>
		<p class="text">Follow Me On: </p>
		<li><a href="https://www.facebook.com/profile.php?id=100006049396116"><img src="images/facebook.png"></a></li>
		<li><a href="https://instagram.com/abhishekballal.2014?utm_medium=copy_link"><img src="images/twitter.png"></a></li>
		<li><a href="https://twitter.com/SketchOriginal?s=08"><img src="images/instagram.png"></a></li>
	</ul>
</div>
<script>
    var modal = document.getElementById("myy");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("cle")[0];

    btn.onclick = function() 
    {
        modal.style.display = "block";
    }

    span.onclick = function() 
    {
        modal.style.display = "none";
    }

    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>