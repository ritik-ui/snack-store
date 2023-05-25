<?php include 'nav/_dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['store'];?></title>
    <!-- <title>Document</title> -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="background:#eee;">
    <?php include 'loading.php'; ?>

    <nav>
        <ul class="kp">
            <li class="t">Snack Store</li>
                <?php
                    // $store = $_SESSION['store'];
                    echo '<li class="tu" style="padding-left: 0px;"><a href="/snacks/logout.php?q=store" style="color: white;">Logout</a></li><li class="tu" style="padding-right: 5px;"> Hello,&nbsp;&nbsp;|</li>' ;
                ?>
        </ul>
    </nav>
    <div class="topnav" id="myTopnav">
        <a href="/snacks"><b>Dashboard</b></a>
        <a <?php
            if (@$_GET['q'] == 0)
            echo 'class="active"';
            ?> href="main.php?q=0">Home</a>
        <a <?php
            if (@$_GET['q'] == 1)
            ?> href="main.php?q=1">Add Item</a>
        <a <?php
            if (@$_GET['q'] == 2)
            ?> href="main.php?q=2">Edit Item</a>
        <a <?php
            if (@$_GET['q'] == 4)
            ?> href="main.php?q=4">Remove Item</a>
        <!-- <a <?php
            if (@$_GET['q'] == 4)
            ?> href="main.php?q=4">Maintain Bills</a> -->
        <a <?php
            if (@$_GET['q'] == 8)
            ?> href="main.php?q=8">See Records</a>
        <!-- <a <?php
            if (@$_GET['q'] == 6)
            ?> href="main.php?q=6">Print Bills</a> -->
        <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

    <!-- &#128269; -->
<section class="tip">
<div class="cont">
<div class="rew">
<div class="ds">
<?php
echo 'Sagar';
?>
</div>
</div>
</div>
</section>