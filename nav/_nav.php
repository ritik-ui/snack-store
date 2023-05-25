<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="all.css">
</head>
<body>
  <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['admin']))
    {
      $loggedin = true;
    }
    else 
    {
      $loggedin = false;
    }

    echo '<div class="banner">
          <div class="topnav" id="myTopnav">
          <a href="/snacks"><b>Snack Store</b></a>
          <a href="/snacks">Home</a>';
      
      if(!$loggedin)
      {
        echo '<a href="/snacks/login.php">Login</a>
              <a href="/snacks/signup.php">Sign Up</a>';
      }
  ?>

  <?php
    if($loggedin)
    {
      // echo '<a href="/quiz/question.php">Quiz </a>';
      echo '<a href="/snacks/adduser.php">Add Users</a>';
      echo '<a href="/snacks/main.php?q=0">Add Quiz</a>';
      echo '<a href="/snacks/logout.php?q=admin">Log Out</a>';
      echo '<a href="/snacks/welcome.php" class="user">';
      echo $_SESSION['ausername'];
      echo '<img src="images/user.jpg" style="width: 27px; height: 27px; float:right; display:flex; border-radius:50%; margin-left:20px;"></a>';
      // echo '<div class="dropdown">
      //       <button class="dropbtn">';
      //         echo $_SESSION['username'];
      //         echo '<img src="user.jpg" style="width:25px; height: 25px; float:right; display:flex; border-radius:40%; margin-left:20px;">
      //         </button>
      //         <div class="dropdown-content">
      //           <a href="#">Link 1</a>
      //           <a href="#">Link 2</a>
      //           <a href="#">Link 3</a>
      //         </div>
      //       </div> ';
    }
  ?>

    <!-- <a href="#about">About</a> -->
    <a href="javascript:void(0);" style="font-size:15px;" class="icon toggle" onclick="toggleMenu(); myFunction();"></a>
    <!-- <a href="javascript:void(1);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a> -->
  </div>
  </section>

  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
  <script type="text/javascript">
    function toggleMenu()
    {
      var menuToggle = document.querySelector('.toggle');
      var banner = document.querySelector('.banner');
      menuToggle.classList.toggle('active');
      banner.classList.toggle('active');
    }
  </script>
</body>
</html>