<?php
session_start();
if(!isset($_SESSION['uloggedin']) || $_SESSION['uloggedin'] != true || !isset($_SESSION['user']))
{
	header("location: ulogin.php");
	exit;
}
?>
<?php include 'nav/_dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['cust'];?></title>
    <!-- <title>Document</title> -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="background:#eee;">
<?php include 'loading.php'; ?>
<?php
    $cust = $_SESSION['cust'];
    $uuid = $_SESSION['uuid'];
?>
    <nav>
        <ul class="kp" style="background: linear-gradient(167deg,#ff3b3b,#f0f403,#b9ff09);">
            <li class="t">Snack Store</li>
                <?php
                    echo '<li class="tu" style="padding-left: 0px;"><a href="/snacks/logout.php?q=user" style="color: white;">Logout</a></li><li class="tu" style="padding-right: 5px;"> Hello,&nbsp;'. $cust .'&nbsp;|</li>' ;
                ?>
        </ul>
    </nav>
    <div class="topnav nv" id="myTopnav">
        <a href="/snacks"><b>Dashboard</b></a>
        <a <?php
            if (@$_GET['q'] == 0)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=0">Home</a>
        <a <?php
            if (@$_GET['q'] == 1)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=1">Personal Details</a>
        <a <?php
            if (@$_GET['q'] == 2)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=2">Go to Cart</a>
        <a <?php
            if (@$_GET['q'] == 4)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=4">My Orders</a>
        <!-- <a <?php
            if (@$_GET['q'] == 4)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=4">Maintain Bills</a> -->
        <!-- <a <?php
            if (@$_GET['q'] == 8)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=8"></a> -->
        <!-- <a <?php
            if (@$_GET['q'] == 6)
            {
                echo 'style="background-color: #4974fe; color: #fff;"';
            }
            ?> href="umain.php?q=6">Print Bills</a> -->
        <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

<section class="tip">
<div class="cont">
<div class="rew">
<div class="ds">
<?php

if (@$_GET['q'] == 0 && !(@$_GET['step']))
{
    $result = mysqli_query($conn, "Select * from items where `availability`='available'") or die('Error');
    $q = mysqli_query($conn, "Select * from users") or die('Error');
    
    while ($row = mysqli_fetch_array($q))
    {
        $info = $row['pinfo'];
        if ($info == 'Unentered')
        {
            echo '<div class="uvitm active" style="overflow: auto;">
                    <div class="ainfo" style="position: inherit; top: 40px;">
                        <div class="info" style="background-color: #fff; border-radius: 10px;">
                            <h2 style="text-align: center; font-size: 30px; padding-top: 20px;">Edit Food Item Details</h2>
                            <div class="formBx" style="margin: 0 0 40px 0;">
                                <form name="form" action="uupdate.php?q=addinfo&uid='. $uuid .'" method="POST" enctype="multipart/form-data" style="width: 100%;">

                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Name :</label>

                                        <input id="fname" name="fname" placeholder="Enter Your First Name" type="text" required="" autocomplete="off" title="Enter Your First Name" style="width:93%; background:#deefff;">
                                        
                                        <input id="lname" name="lname" placeholder="Enter Your Last Name" type="text" required="" autocomplete="off" title="Enter Your Last Name" style="width:93%; background:#deefff;">

                                    </div>
                            
                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Phone No :</label>

                                        <div style="display: flex;">
                                        
                                            <div style="height: 40px;background: #b3b3b3;text-align: center;margin: 2% 0 0 3%;">
                                            
                                                <p style="color: #0000009e; text-align: center; padding: 6px 10px;">+91</p>
                                            
                                            </div>

                                            <input id="phno" name="phno" placeholder="Enter Your Phone Number" type="text" required="" autocomplete="off" title="Enter Your Phone Number" style="width: 81%; background:#deefff;" maxlength="10">

                                        </div>

                                    </div>
                                
                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Email Id :</label>

                                        <input id="emid" name="emid" placeholder="Enter Your Email-ID" type="text" autocomplete="off" title="Enter Your Email-ID" style="width:93%; background:#deefff;">

                                        <p style="cursor: context-menu; color: #3737378c; font-size: 0.7rem; text-align: start; padding: 0 4%;">*Optional</p>

                                    </div>

                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Address :</label>

                                        <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Address" autocomplete="off" title="Enter Your Address" style="width: 354px; background: rgb(222, 239, 255); height: 97px;"></textarea>

                                    </div>
                            
                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Neighbourhood :</label>

                                        <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width:93%; background:#deefff;">

                                        <p style="cursor: context-menu; color: #3737378c; font-size: 0.7rem; text-align: start; padding: 0 4%;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>

                                    </div>

                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Pin Code</label>

                                        <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" required="" autocomplete="off" title="Enter Your Pincode" style="width:93%; background:#deefff;">

                                    </div>

                                    <a onclick="cancel()" class="sub btn" style="border-radius:0px;border:none;width:100px;height:40px;padding:10px;background:#ff6767;text-transform:none;">Cancel</a>
                                    <script>
                                        function cancel()
                                        {
                                            var data = prompt("Are You Sure You Want to go Back\nNo Changes Would be Done to the Details of the Food Item if you Click on Ok", "Yes");
                                            if (data == "yes" || data == "Yes" || data == "YES")
                                            {
                                                window.location ="main.php?q=0";
                                            }
                                        }
                                    </script>

                                    <input class="sub" type="submit" value="Submit" style="margin-top: 20px;">
                                </form>
                            </div>
                        </div>
                    </div>
                <img src="images/close.png" onclick="togggle();">
            </div>';
        }
        else
        {
        
    // echo '<div class="search" style="position:relative; display:flex; transition:0.5s;">
    //         <div class="fl" style="padding: 0 30px; width: 600px;">
    //             <button class="collapsible" style="background:linear-gradient(90deg,#FFC107,#E91E63);">Search by Food Name</button>
    //             <div class="content">
    //                 <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
    //                     <form name="form" action="main.php?q=0&step=1" method="POST" style="width:100%;">
    //                         <input id="fname" name="fname" placeholder="Search by Food Name"  type="text" required="" autocomplete="off" title="Enter the Food Name">
    //                         <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
    //                     </form>
    //                 </div>
    //             </div>
    //         </div>

    //         <div class="fl" style="padding: 0 30px; width: 600px;">
    //             <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Food Item No</button>
    //             <div class="content">
    //                 <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
    //                     <form name="form" action="main.php?q=0&step=2" method="POST" style="width:100%;">
    //                         <input id="fitno" name="fitno" placeholder="Search by Food Item No"  type="text" required="" autocomplete="off" title="Enter the Food Item No">
    //                         <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
    //                     </form>
    //                 </div>  
    //             </div>
    //         </div>
    //     </div>';

            echo '<h2 class="cat">Categories: </h2>
            <div class="cati" style="display: flex; justify-content: space-evenly;">
                <div class="cai one" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb1.jpg);"><img class="ima" src="images/fb1.jpg"/><a href="umain.php?q=0&step=9&cat=Snack" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Snack</a></div>
                <div class="cai two" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb2.jpg);"><img class="ima" src="images/wb2.png"/><a href="umain.php?q=0&step=9&cat=Munchies" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Munchies</a></div>
                <div class="cai three" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb3.jpg);"><img class="ima" src="images/wb3.png"/><a href="umain.php?q=0&step=9&cat=Dairy, Bread and Eggs" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Dairy, Bread and Eggs</a></div>
                <div class="cai four" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb4.jpg);"><img class="ima" src="images/wb4.png"/><a href="umain.php?q=0&step=9&cat=Tea, Coffee and Health" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Tea, Coffee and Health</a></div>
                <div class="cai five" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb5.jpg);"><img class="ima" src="images/wb5.png"/><a href="umain.php?q=0&step=9&cat=Cold Drinks and Juices" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Cold Drinks and Juices</a></div>
                <div class="cai six" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb6.jpg);"><img class="ima" src="images/wb6.png"/><a href="umain.php?q=0&step=9&cat=Sauces and Spreads" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Sauces and Spreads</a></div>
            </div>';

            $c = 1;
            echo '<div style="display: inline-block; width: 1200px;">';
            while ($row = mysqli_fetch_array($result))
            {
                                    
                $fid = $row['fid'];
                $fitno = $row['fitno'];
                $type = $row['type'];
                $desc = $row['description'];
                $netwt = $row['netwt'];
                $image = $row['image'];
                $hid = $row['hid'];
                $hname = $row['hname'];
                $fname = $row['fname'];
                $mrp = $row['mrp'];
                $disc = $row['discount'];
                $avi = $row['availability'];
                $aditm = $row['ditm'];
                // $ = $row[''];
                
                // echo $fname.'<br>'.$hname.'<br>';
                $qk4 = mysqli_query($conn, "select * from sinfo where hid='$hid'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qk4))
                {
                    $sstatus = $row['sstatus'];
                }
    
                $amrp = $mrp - $disc;
                if ($sstatus != 'offline')
                {
                    echo '<div class="itm uitm" style="position: relative;">
                            <div class="ima">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div> 
                            <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$netwt.'</p>';
                            if ($disc == 0)
                            {
                                echo '<h3 style="color: #ff0000;">₹'.$mrp.'</h3>
                                <p style="height: 21px;">&nbsp;</p>';
                                
                            }
                            else
                            {
                                echo '<div style="display: flex;">
                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$mrp.'</h3>
                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$amrp.'</h3>
                                </div>
                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$disc.' Off</p>';
                            }
                            // echo '<div class="fl">
                            //         <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            //         <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                            //     </div>
                            echo'<a href="umain.php?q=0&step=1&fid='.$fid.'" class="btn" style="background: #2700ff; color: #FFFFFF; width: 100%; padding: 9px 12px; margin: 10px 0 0 0;">View Details</a>';
                            $qq4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
                            while ($row = mysqli_fetch_array($qq4))
                            {
                                $fit = $row['fit'];
                            }
                            if ($fit < 1)
                            {
                                echo '<a href="uupdate.php?q=adcart&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&rtn=main" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #5eff0c;">Add To Cart</a>';
                            }
                            else if ($fit >= 1)
                            {
                                echo '<a class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #5eff0c;">Item Already in cart</a>';
                            }

                            echo '<a href="umain.php?q=2&step=1&fid='.$fid.'" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>
                            </div>';
                
                    // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
                    // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
                    // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
                    // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>
                }
            }
        }
    }

?>
</div>
<?php
}?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top: 0px;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step'] == 9))
{
    $st = @$_GET['cat'];
    $result = mysqli_query($conn, "Select * from items where `availability`='available' and type='$st'") or die('Errorjhcs');
    $q = mysqli_query($conn, "Select * from users") or die('Error');
    
    while ($row = mysqli_fetch_array($q))
    {
        $info = $row['pinfo'];
        
    // echo '<div class="search" style="position:relative; display:flex; transition:0.5s;">
    //         <div class="fl" style="padding: 0 30px; width: 600px;">
    //             <button class="collapsible" style="background:linear-gradient(90deg,#FFC107,#E91E63);">Search by Food Name</button>
    //             <div class="content">
    //                 <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
    //                     <form name="form" action="main.php?q=0&step=1" method="POST" style="width:100%;">
    //                         <input id="fname" name="fname" placeholder="Search by Food Name"  type="text" required="" autocomplete="off" title="Enter the Food Name">
    //                         <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
    //                     </form>
    //                 </div>
    //             </div>
    //         </div>

    //         <div class="fl" style="padding: 0 30px; width: 600px;">
    //             <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Food Item No</button>
    //             <div class="content">
    //                 <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
    //                     <form name="form" action="main.php?q=0&step=2" method="POST" style="width:100%;">
    //                         <input id="fitno" name="fitno" placeholder="Search by Food Item No"  type="text" required="" autocomplete="off" title="Enter the Food Item No">
    //                         <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
    //                     </form>
    //                 </div>  
    //             </div>
    //         </div>
    //     </div>';

            echo '<h2 class="cat">Categories: </h2>
                <div class="cati" style="display: flex; justify-content: space-evenly;">
                    <div class="cai one" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb1.jpg);"><img class="ima" src="images/fb1.jpg"/><a href="umain.php?q=0&step=9&cat=Snack" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Snack</a></div>
                    <div class="cai two" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb2.jpg);"><img class="ima" src="images/wb2.png"/><a href="umain.php?q=0&step=9&cat=Munchies" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Munchies</a></div>
                    <div class="cai three" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb3.jpg);"><img class="ima" src="images/wb3.png"/><a href="umain.php?q=0&step=9&cat=Dairy, Bread and Eggs" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Dairy, Bread and Eggs</a></div>
                    <div class="cai four" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb4.jpg);"><img class="ima" src="images/wb4.png"/><a href="umain.php?q=0&step=9&cat=Tea, Coffee and Health" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Tea, Coffee and Health</a></div>
                    <div class="cai five" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb5.jpg);"><img class="ima" src="images/wb5.png"/><a href="umain.php?q=0&step=9&cat=Cold Drinks and Juices" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Cold Drinks and Juices</a></div>
                    <div class="cai six" style="position: relative; margin: 30px 0; color: #fff; background-size: cover; background-position: center; background-image: url(images/rb6.jpg);"><img class="ima" src="images/wb6.png"/><a href="umain.php?q=0&step=9&cat=Sauces and Spreads" class="link" style="padding: 0; color: #fff; font-size: unset; font-weight: unset;text-align: center; height: auto;"><span class="wlink"></span>Sauces and Spreads</a></div>
                </div>';

            $c = 1;
            echo '<div style="display: inline-block; width: 1200px;">';
            while ($row = mysqli_fetch_array($result))
            {
                                    
                $fid = $row['fid'];
                $fitno = $row['fitno'];
                $type = $row['type'];
                $desc = $row['description'];
                $netwt = $row['netwt'];
                $image = $row['image'];
                $hid = $row['hid'];
                $hname = $row['hname'];
                $fname = $row['fname'];
                $mrp = $row['mrp'];
                $disc = $row['discount'];
                $avi = $row['availability'];
                $aditm = $row['ditm'];
                // $ = $row[''];
                
                // echo $fname.'<br>'.$hname.'<br>';
                $amrp = $mrp - $disc;
                    echo '<div class="itm uitm" style="position: relative;">
                            <div class="ima">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div> 
                            <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$netwt.'</p>';
                            if ($disc == 0)
                            {
                                echo '<h3 style="color: #ff0000;">₹'.$mrp.'</h3>
                                <p style="height: 21px;">&nbsp;</p>';
                                
                            }
                            else
                            {
                                echo '<div style="display: flex;">
                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$mrp.'</h3>
                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$amrp.'</h3>
                                </div>
                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$disc.' Off</p>';
                            }
                            // echo '<div class="fl">
                            //         <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            //         <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                            //     </div>
                            echo'<a href="umain.php?q=0&step=1&fid='.$fid.'" class="btn" style="background: #2700ff; color: #FFFFFF; width: 100%; padding: 9px 12px; margin: 10px 0 0 0;">View Details</a>';
                            $qq4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
                            while ($row = mysqli_fetch_array($qq4))
                            {
                                $fit = $row['fit'];
                            }
                            if ($fit < 1)
                            {
                                echo '<a href="uupdate.php?q=adcart&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&rtn=main" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #5eff0c;">Add To Cart</a>';
                            }
                            else if ($fit >= 1)
                            {
                                echo '<a class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #5eff0c;">Item Already in cart</a>';
                            }

                            echo '<a href="" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>
                            </div>';
                
                // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
                // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
                // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
                // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>
            }
        }

?>
</div>
<?php
}?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 1) && (@$_GET['fid']))
{
    $fid = @$_GET['fid'];
    $yes = @$_GET['yes'];
    $tryt = $fid;
    // echo $tryt;

    $q3 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
    $c = 1;
    while ($row = mysqli_fetch_array($q3))
    {
        $fid = $row['fid'];
        $fitno = $row['fitno'];
        $type = $row['type'];
        $desc = $row['description'];
        $netwt = $row['netwt'];
        $image = $row['image'];
        $hid = $row['hid'];
        $hname = $row['hname'];
        $foname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        $inote = $row['inote'];
        $ibox = $row['ibox'];
        $ingden = $row['ingden'];
        $aditm = $row['ditm'];

        $q4 = mysqli_query($conn, "select * from sinfo where hid='$hid'") or die("No Items Details Fetched, Error Ask Sagar");
        $c = 1;
        while ($row = mysqli_fetch_array($q4))
        {
            $addrs = $row['address'];
            
            $amrp = $mrp - $disc;
            echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                    <div style="display: flex;">
                        <div style="position: -webkit-sticky; position: sticky; top: 20px; bottom: 0; z-index: 2; -webkit-align-self: flex-start; -ms-flex-item-align: start; align-self: flex-start;">
                            <div class="vdima">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto; height: 370px;"/>
                            </div>
                            <div style="display: flex; padding: 7px 10px;">';
                            $qq4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
                            while ($row = mysqli_fetch_array($qq4))
                            {
                                $qty = $row['qty'];
                                $fit = $row['fit'];
                            }
                            if ($fit != 0)
                            {
                                echo '<div style="display: flex; margin: auto 0; height: 35px; width: 100%; text-align: center; background: #fafafa; border: 1px solid #efeaea;">
                                        <a href="uupdate.php?q=rqty&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=1page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 30%; font-weight: 600; font-size: 25px;">-</a>
                                        <form action="uupdate.php?q=uqty&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=1page" method="POST">
                                            <input id="qtyy" name="qtyy" placeholder="Enter Your Hotel Name" type="text" required="" autocomplete="off" value="'.$qty.'" title="Enter Your Hotel Name" style="text-align: center; width: 90%; height: 33px; background: #fff; padding: 3px; border: 1px solid #efeaea;"  onchange="this.form.submit()">
                                        </form>
                                        <!-- <p style="text-align: center; width: 40%; background: #fff; padding: 3px; border: 1px solid #efeaea;">'.$qty.'</p> -->
                                        <a href="uupdate.php?q=aqty&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=1page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 30%; font-weight: 600; font-size: 25px;">+</a>
                                    </div>';
                            }
                            else
                            {
                                echo '<a href="uupdate.php?q=adcart&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&rtn=1page" class="btn" style="margin: 10px 0 0 0; width: 100%; color: #FFFFFF; background: #5eff0c;">Add To Cart</a>';
                            }
                                echo '<a href="umain.php?q=2&step=1&fid='.$fid.'" class="btn" style="margin: 10px 0 0 20px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>
                            </div>
                        </div>
                        <div class="vdd">
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                            <h1>'.$foname.'</h1>
                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$netwt.'</p>';
                            if ($disc == 0)
                            {
                                echo '<h3 style="color: #ff0000;">₹'.$mrp.'</h3>
                                <p style="height: 21px;">&nbsp;</p>';
                                
                            }
                            else
                            {
                                echo '<div style="display: flex;">
                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$mrp.'</h3>
                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$amrp.'</h3>
                                    </div>
                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$disc.' Off</p>';
                            }

                        echo '<div>
                                <div style="display: flex;">
                                    <p style="color: #9b9b9b;">Important Note : </p>
                                    <p style="color: #3a3a3a; padding: 0 0 0 10px;"> '.$inote.'</p>
                                </div>
                                <div style="display: flex;">
                                    <p style="color: #9b9b9b; width: 110px;">Seller : </p>
                                    <div>
                                        <p style="color: #3a3a3a; padding: 0 0 0 10px;"> '.$hname.'</p>
                                        <p style="color: #3a3a3a; padding: 5px 0 0 10px;">Address :</p>
                                        <p style="color: #3a3a3a; padding: 10px 0 0 10px;"> '.$addrs.'</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display: block;">
                                <div style="display: flex; padding: 30px 0 0 0;">
                                    <p style="color: #9b9b9b; padding: 5px 0 0 0;">Delivery : </p>
                                    <form action="" method="post" style="display: flex; padding: 0 0 0 20px;">
                                        <div class="input-field">
                                            <input type="text" maxlength="6" name="pcde" placeholder="Enter Pin Code" id="pcde" required="" autocomplete="off">
                                            <span></span>
                                        </div>
                                        <input type="submit" class="btn" name="" value="Check Now" style="margin-top: 0px; color: #FFFFFF; margin: 0 0 0 20px; height: 30px; width: 35%; padding: 3px; background: #ff0f0f;" />
                                    </form>';
                                echo '</div>';
                                $showError = 0;
                                if($_SERVER["REQUEST_METHOD"] == "POST")
                                {
                                	$pcde = $_POST["pcde"];
                                    $q3 = mysqli_query($conn, "select * from dpcode where hid='$hid'") or die("No Items Details Fetched, Error Ask Sagar");
                                    while ($row = mysqli_fetch_array($q3))
                                    {
                                        $pcode = $row['pcode'];
                                        if ($pcde == $pcode)
                                        {
                                            $showError = 1;
                                        }
                                        elseif ($pcde != $pcode)
                                        {
                                            $showError = 2;
                                        }
                                    }
                                }
                                if ($showError == 1)
                                {
                                    echo '<p style="padding: 10px;">This Food Can Be Delivered At This Pin Code</p>';
                                }
                                elseif ($showError == 2)
                                {
                                    echo '<p style="padding: 10px;">This Food Cannot Be Delivered At This Pin Code</p>';
                                }
                                elseif ($showError == 0)
                                {
                                    echo '<p style="padding: 10px;">Please Enter A Pin Code';
                                }
                                echo '</div>
                            
                            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <h1>Specifications</h1>
                                </div>
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <p style="font-size: 20px">In The Box</p>
                                    <p style="padding: 10px 0 0 0;font-size: 15px">'.$ibox.'</p>
                                </div>
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <p style="font-size: 20px">Ingredients</p>
                                    <p style="padding: 10px 0 0 0;font-size: 15px">'.$ingden.'</p>
                                </div>
                            </div>
                            
                            <div style="margin: 20px 0 0 0; display: grid; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <h1>Frequently Bought Together</h1>
                                </div>';
                                echo '<div class="fbou" style="border-bottom: 1px solid #ddd;">';
                                $amrp = $mrp - $disc;
                                echo '<div style="width: 33.5%; position: relative; padding: 30px 5px 30px 30px;">
                                        <div class="ima" style="height: 80px; width: 121px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <a href="" class="link"><span class="wlink" style="height: 78%;"></span>'.$foname.'</a>
                                        <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$netwt.'</p>';
                                        if ($disc == 0)
                                        {
                                            echo '<h3 style="color: #ff0000;">₹'.$mrp.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';
                                            
                                        }
                                        else
                                        {
                                            echo '<div style="display: flex;">
                                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$mrp.'</h3>
                                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$amrp.'</h3>
                                                </div>
                                            <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$disc.' Off</p>';
                                        }
                                        $qt3 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
                                        while ($row = mysqli_fetch_array($qt3))
                                        {
                                            $fit = $row['fit'];
                                        }
                                        if ($fit < 1)
                                        {
                                            echo '<div style="margin: 15px 0 0 0; text-align: center;">
                                                    <a href="" class="btn" style="color: #FFFFFF; background: #5eff0c;">Add To Cart</a>
                                                </div>';
                                        }
                                        else if ($fit >= 1)
                                        {
                                            echo '<div style="margin: 15px 0 0 0; text-align: center;">
                                                    <a class="btn" style="margin-top: 10px; font-size: 12.5px; width: 100%; color: #FFFFFF; background: #5eff0c;">Item Already in cart</a>
                                                </div>';
                                        }
                                        echo '</div>';
                            $q5 = mysqli_query($conn, "Select * from fbought where fid='$fid'") or die('Error');
                            while ($row = mysqli_fetch_array($q5))
                            {
                                $fbfid = $row['fbfid'];
                                $q6 = mysqli_query($conn, "Select * from items where `fid`='$fbfid' and `availability`='available'") or die('Error');
                                while ($row = mysqli_fetch_array($q6))
                                {
                                    $ffid = $row['fid'];
                                    $ffitno = $row['fitno'];
                                    $ftype = $row['type'];
                                    $fdesc = $row['description'];
                                    $fnetwt = $row['netwt'];
                                    $fimage = $row['image'];
                                    $fhid = $row['hid'];
                                    $fhname = $row['hname'];
                                    $ffname = $row['fname'];
                                    $fmrp = $row['mrp'];
                                    $fdisc = $row['discount'];
                                    $favi = $row['availability'];
                                    $finote = $row['inote'];
                                    $fibox = $row['ibox'];
                                    $fingden = $row['ingden'];
                                    
                                    $famrp = $fmrp - $fdisc;

                                    $tryt = $tryt.','.$fbfid;
                                    // echo $tryt;

                                    echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p><div style="width: 33.5%; position: relative; padding: 30px 5px 30px 30px;">
                                        <div class="ima" style="height: 80px; width: 121px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($fimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <a href="umain.php?q=0&step=1&fid='.$ffid.'" target="_blank" class="link"><span class="wlink" style="height: 78%;"></span>'.$ffname.'</a>
                                        <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$fnetwt.'</p>';
                                        if ($fdisc == 0)
                                        {
                                            echo '<h3 style="color: #ff0000;">₹'.$fmrp.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';

                                        }
                                        else
                                        {
                                            echo '<div style="display: flex;">
                                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$fmrp.'</h3>
                                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$famrp.'</h3>
                                                </div>
                                            <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$fdisc.' Off</p>';
                                        }
                                        $qt4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
                                        while ($row = mysqli_fetch_array($qt4))
                                        {
                                            $fit = $row['fit'];
                                        }
                                        if ($fit < 1)
                                        {
                                            echo '<div style="margin: 15px 0 0 0; text-align: center;">
                                                    <a href="" class="btn" style="color: #FFFFFF; background: #5eff0c;">Add To Cart</a>
                                                </div>';
                                        }
                                        else if ($fit >= 1)
                                        {
                                            echo '<div style="margin: 15px 0 0 0; text-align: center;">
                                                    <a class="btn" style="margin-top: 10px; font-size: 12.5px; width: 100%; color: #FFFFFF; background: #5eff0c;">Item Already in cart</a>
                                                </div>';
                                        }
                                    echo '</div>';
                                }
                            }
                            echo '</div>
                                <div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <p style="text-align: center; width: 100px; font-size: 13px; display: block;">1 Item<br><span style=" font-size: 20px;"> ₹ '.$amrp.'</span></p>';
                                    $qrp = 0;
                                    $q5 = mysqli_query($conn, "Select * from fbought where fid='$fid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q5))
                                    {
                                        $fbfid = $row['fbfid'];
                                        $q6 = mysqli_query($conn, "Select * from items where `fid`='$fbfid' and `availability`='available'") or die('Error');
                                        while ($row = mysqli_fetch_array($q6))
                                        {
                                            $afmrp = $row['mrp'];
                                            $afdisc = $row['discount'];

                                            if ($afdisc != 0)
                                            {
                                                $afamrp = $afmrp - $afdisc;
                                                $qrp = $qrp + $afamrp;
                                            }
                                            else
                                            {
                                                // $afamrp = 0;
                                                $qrp = $qrp + $afmrp;
                                            }
                                            // echo $qrp;
                                        }
                                    }
                                    $c = 0;
                                    // $q5 = mysqli_query($conn, "Select *, count(fid) as ty from fbought where fid='$fid'") or die('Error');
                                    $q5 = mysqli_query($conn, "Select * from fbought where fid='$fid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q5))
                                    {
                                        $fbfid = $row['fbfid'];
                                        // $ty = $row['ty'];
                                        // echo $ty;

                                        $q6 = mysqli_query($conn, "Select * from items where `fid`='$fbfid' and `availability`='available'") or die('Error');
                                        while ($row = mysqli_fetch_array($q6))
                                        {
                                            $ffid = $row['fid'];
                                            // $qrp = $row['qrp'];
                                            $ffitno = $row['fitno'];
                                            $ftype = $row['type'];
                                            $fdesc = $row['description'];
                                            $fnetwt = $row['netwt'];
                                            $fimage = $row['image'];
                                            $fhid = $row['hid'];
                                            $fhname = $row['hname'];
                                            $ffname = $row['fname'];
                                            $fmrp = $row['mrp'];
                                            $fdisc = $row['discount'];
                                            $favi = $row['availability'];
                                            $finote = $row['inote'];
                                            $fibox = $row['ibox'];
                                            $fingden = $row['ingden'];

                                            if ($favi == 'Available')
                                            {
                                                $c++;
                                            }

                                            if ($fdisc == 0)
                                            {
                                                $total = $mrp + $qrp;
                                                $tquan = $c + 1;
                                            }
                                            else
                                            {
                                                $total = $mrp + $qrp;
                                                $tquan = $c + 1;
                                            }
                                        }
                                        
                                    }
                                    if ($c >= 1)
                                    {
                                        echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p><p style="text-align: center; width: 100px; font-size: 13px; display: block;">'.$c.' Item<br><span style=" font-size: 20px;"> ₹ '.$qrp.'</span></p>
                                        <p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">=</p><p style="text-align: center; width: 100px; font-size: 13px; display: block;">'.$tquan.' Item<br><span style=" font-size: 20px;"> ₹ '.$total.'</span></p>';
                                    }
                                    echo '<div style="margin-top: auto; margin-bottom: auto;">
                                            <a href="uupdate.php?q=aldcart&uid='.$uuid.'&hid='.$hid.'&fid='.$tryt.'&rtn='.$fid.'" class="btn" style="color: #FFFFFF; background: #5eff0c;">Add To Cart</a>
                                        </div>';
                                    echo '</div>
                                </div>';

                            echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                        <h1>Ratings & Reviews</h1>
                                    </div>
                                    <button class="collapsible btn rate">Rate Food Item</button>';
                                    $st = false;
                                    $q65 = mysqli_query($conn, "Select * from reviews where fid='$fid' and uid='$uuid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q65))
                                    {
                                        $review = $row['review'];
                                        $rate = $row['ratings'];
                                        $st = true;

                                        $five = '';
                                        $four = '';
                                        $three = '';
                                        $two = '';
                                        $one = '';

                                        if ($rate == 5)
                                        {
                                            $five = "checked";
                                        }
                                        elseif ($rate == 4)
                                        {
                                            $four = "checked";
                                        }
                                        elseif ($rate == 3)
                                        {
                                            $three = "checked";
                                        }
                                        elseif ($rate == 2)
                                        {
                                            $two = "checked";
                                        }
                                        elseif ($rate == 1)
                                        {
                                            $one = "checked";
                                        }

                                    }
                                    echo'<div class="content" style="margin: 10px 10px 0px;">';
                                    if ($st)
                                    {
                                        echo '<p style="padding: 20px 10px 0 10px; font-size: 1.2rem;">You Have Already Responded for this Food</p>';
                                        echo'<form name="form" action="uupdate.php?q=star&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&st=resp" method="POST" style="text-align: center; padding: 10px 0;">
                                        <div style="display: flex;">
                                                <div class="rating" style="margin: auto;">
                                                    <label>
                                                        <input type="radio" name="stars" value="1" '.$one.' />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>

                                                    <label>
                                                        <input type="radio" name="stars" value="2" '.$two.' />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>

                                                    <label>
                                                        <input type="radio" name="stars" value="3" '.$three.' />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>   
                                                    </label>

                                                    <label>
                                                        <input type="radio" name="stars" value="4" '.$four.' />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>

                                                    <label>
                                                        <input type="radio" name="stars" value="5" '.$five.' />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="text-align: center;">
                                                <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Write Your Review :</label>
                                                <textarea rows="3" cols="5" name="review" placeholder="Enter Your Review About Food" autocomplete="off" title="Enter Your Address" style="width: 445px; background: rgb(222, 239, 255); height: 97px;">'.$review.'</textarea>
                                            </div>
                                            <input class="sub btn" type="submit" value="Submit">
                                        </form>';
                                    }
                                    else
                                    {
                                        echo'<form name="form" action="uupdate.php?q=star&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'&st=unresp" method="POST" style="text-align: center; padding: 10px 0;">
                                        <div style="display: flex;">
                                                <div class="rating" style="margin: auto;">
                                                    <label>
                                                        <input type="radio" name="stars" value="1" />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>
    
                                                    <label>
                                                        <input type="radio" name="stars" value="2" />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>
    
                                                    <label>
                                                        <input type="radio" name="stars" value="3" />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>   
                                                    </label>
    
                                                    <label>
                                                        <input type="radio" name="stars" value="4" />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>
    
                                                    <label>
                                                        <input type="radio" name="stars" value="5" />
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                        <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="text-align: center;">
                                                <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Write Your Review :</label>
                                                <textarea rows="3" cols="5" name="review" placeholder="Enter Your Review About Food" autocomplete="off" title="Enter Your Address" style="width: 445px; background: rgb(222, 239, 255); height: 97px;"></textarea>
                                            </div>
                                            <input class="sub btn" type="submit" value="Submit">
                                        </form>';
                                        
                                    }
                                    echo '</div>';

                                    $q5 = mysqli_query($conn, "Select count(ratings) as star5 from reviews where fid='$fid' and ratings=5") or die('Error');
                                    while ($row = mysqli_fetch_array($q5))
                                    {
                                        $star5 = $row['star5'];
                                        $q55 = mysqli_query($conn, "Select count(ratings) as starr5 from reviews where fid='$fid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q55))
                                        {
                                            $starr5 = $row['starr5'];
                                            if ($star5 != 0)
                                            {
                                                $per5 = ($star5/$starr5)*100;
                                                $perr5 = 5 * $star5;
                                            }
                                            else
                                            {
                                                $per5 = 0;
                                                $perr5 = 0;
                                            }
                                        }
                                    }

                                    $q4 = mysqli_query($conn, "Select count(ratings) as star4 from reviews where fid='$fid' and ratings=4") or die('Error');
                                    while ($row = mysqli_fetch_array($q4))
                                    {
                                        $star4 = $row['star4'];
                                        $q44 = mysqli_query($conn, "Select count(ratings) as starr4 from reviews where fid='$fid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q44))
                                        {
                                            $starr4 = $row['starr4'];
                                            if ($star4 != 0)
                                            {
                                                $per4 = ($star4/$starr4)*100;
                                                $perr4 = 4 * $star4;
                                            }
                                            else
                                            {
                                                $per4 = 0;
                                                $perr4 = 0;
                                            }
                                        }
                                    }

                                    $q3 = mysqli_query($conn, "Select count(ratings) as star3 from reviews where fid='$fid' and ratings=3") or die('Error');
                                    while ($row = mysqli_fetch_array($q3))
                                    {
                                        $star3 = $row['star3'];
                                        $q33 = mysqli_query($conn, "Select count(ratings) as starr3 from reviews where fid='$fid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q33))
                                        {
                                            $starr3 = $row['starr3'];
                                            if ($star3 != 0)
                                            {
                                                $per3 = ($star3/$starr3)*100;
                                                $perr3 = 3 * $star3;
                                            }
                                            else
                                            {
                                                $per3 = 0;
                                                $perr3 = 0;
                                            }
                                        }
                                    }

                                    $q2 = mysqli_query($conn, "Select count(ratings) as star2 from reviews where fid='$fid' and ratings=2") or die('Error');
                                    while ($row = mysqli_fetch_array($q2))
                                    {
                                        $star2 = $row['star2'];
                                        $q22 = mysqli_query($conn, "Select count(ratings) as starr2 from reviews where fid='$fid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q22))
                                        {
                                            $starr2 = $row['starr2'];
                                            if ($star2 != 0)
                                            {
                                                $per2 = ($star2/$starr2)*100;
                                                $perr2 = 2 * $star2;
                                            }
                                            else
                                            {
                                                $per2 = 0;
                                                $perr2 = 0;
                                            }
                                        }
                                    }

                                    $q1 = mysqli_query($conn, "Select count(ratings) as star1 from reviews where fid='$fid' and ratings=1") or die('Error');
                                    while ($row = mysqli_fetch_array($q1))
                                    {
                                        $star1 = $row['star1'];
                                        $q11 = mysqli_query($conn, "Select count(ratings) as starr1 from reviews where fid='$fid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q11))
                                        {
                                            $starr1 = $row['starr1'];
                                            if ($star1 != 0)
                                            {
                                                $per1 = ($star1/$starr1)*100;
                                                $perr1 = 1 * $star1;
                                            }
                                            else
                                            {
                                                $per1 = 0;
                                                $perr1 = 0;
                                            }
                                        }
                                    }
                                    $fstar = $star1 + $star2 + $star3 + $star4 + $star5;
                                    $q1 = mysqli_query($conn, "Select count(review) as revi from reviews where fid='$fid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q1))
                                    {
                                        $revi = $row['revi'];
                                    }
                                    if ($star1 != 0 || $star2 != 0 || $star3 != 0 || $star4 != 0 || $star5 != 0)
                                    {
                                        $tstar = ($perr1+$perr2+$perr3+$perr4+$perr5) / $fstar;
                                        // echo();
                                        echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                            <div style="display: flex;">
                                            <div style="width: 25%; text-align: center; margin-left: auto; margin-right: auto;">
                                                <p style="font-size: 25px; font-weight: 500;">'.round($tstar,2).'<span style="font-size: 30px;">★<span></p>
                                                <p style="text-align: center; padding: 0 8px 0 0; font-size: 13px;">'.$fstar.' Ratings and <br>'.$revi.' Reviews</p>
                                            </div>
                                                <div>
                                                    <div style="display: flex;">
                                                        <p>5<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                        <div class="container">
                                                            <div class="skills star5" style="width: '.$per5.'%;"></div>
                                                        </div>
                                                        <p>'.$star5.'</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <p>4<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                        <div class="container">
                                                            <div class="skills star4" style="width: '.$per4.'%;"></div>
                                                        </div>
                                                        <p>'.$star4.'</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <p>3<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                        <div class="container">
                                                            <div class="skills star3" style="width: '.$per3.'%;"></div>
                                                        </div>
                                                        <p>'.$star3.'</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <p>2<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                        <div class="container">
                                                            <div class="skills star2" style="width: '.$per2.'%; background-color: #fffe00;"></div>
                                                        </div>
                                                        <p>'.$star2.'</p>
                                                    </div>
                                                    <div style="display: flex;">
                                                        <p>1<span style="font-size: 20px; padding: 0 0 0 9px;">★<span></p>
                                                        <div class="container">
                                                            <div class="skills star1" style="width: '.$per1.'%; background-color: #ff3600;"></div>
                                                        </div>
                                                        <p>'.$star1.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    else
                                    {
                                        echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                        <div style="display: flex;">
                                            <div style="width: 25%; text-align: center; margin-left: auto; margin-right: auto;">
                                                <p style="font-size: 25px; font-weight: 500;">0<span style="font-size: 30px; padding: 0 0 0 5px;">★<span></p>
                                                <p style="text-align: center; padding: 0 8px 0 0; font-size: 13px;">'.$fstar.' Ratings and <br>'.$revi.' Reviews</p>
                                            </div>
                                            <div>
                                                <div style="display: flex;">
                                                    <p>5<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                    <div class="container">
                                                        <div class="skills star5" style="width: '.$per5.'%;"></div>
                                                    </div>
                                                    <p>'.$star5.'</p>
                                                </div>
                                                <div style="display: flex;">
                                                    <p>4<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                    <div class="container">
                                                        <div class="skills star4" style="width: '.$per4.'%;"></div>
                                                    </div>
                                                    <p>'.$star4.'</p>
                                                </div>
                                                <div style="display: flex;">
                                                    <p>3<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                    <div class="container">
                                                        <div class="skills star3" style="width: '.$per3.'%;"></div>
                                                    </div>
                                                    <p>'.$star3.'</p>
                                                </div>
                                                <div style="display: flex;">
                                                    <p>2<span style="font-size: 20px; padding: 0 0 0 5px;">★<span></p>
                                                    <div class="container">
                                                        <div class="skills star2" style="width: '.$per2.'%; background-color: #fffe00;"></div>
                                                    </div>
                                                    <p>'.$star2.'</p>
                                                </div>
                                                <div style="display: flex;">
                                                    <p>1<span style="font-size: 20px; padding: 0 0 0 9px;">★<span></p>
                                                    <div class="container">
                                                        <div class="skills star1" style="width: '.$per1.'%; background-color: #ff3600;"></div>
                                                    </div>
                                                    <p>'.$star1.'</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                    }

                                    echo '<h3 style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px;">Reviews</h3>';
                                    $q5 = mysqli_query($conn, "Select * from reviews where fid='$fid' order by date desc") or die('Error');
                                    while ($row = mysqli_fetch_array($q5))
                                    {
                                        $uuid = $row['uid'];
                                        $ratings = $row['ratings'];
                                        $review = $row['review'];

                                        $q6 = mysqli_query($conn, "Select * from uinfo where uid='$uuid'") or die('Error');
                                        while ($row = mysqli_fetch_array($q6))
                                        {
                                            $fname = $row['fname'];
                                        }

                                        if ($ratings == 5 || $ratings == 4 || $ratings == 3)
                                        {
                                            echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                    <div style="display: flex;">
                                                        <h4 style="padding: 0 15px 0 0; text-align: center; font-size: 15px;">'.$fname.'</h4>
                                                        <p style="padding: 1px 0; text-align: center; box-sizing: border-box; width: 45px; border-radius: 5px; background-color: #04AA6D; color: #fff; font-size: 15px;">'.$ratings.' ★</p>
                                                    </div>
                                                    <p style="padding: 10px 0 0 0; font-size: 15px">'.$review.'</p>
                                                </div>';
                                        }
                                        
                                        elseif ($ratings == 2)
                                        {
                                            echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                    <div style="display: flex;">
                                                        <h4 style="padding: 0 15px 0 0; text-align: center; font-size: 15px;">'.$fname.'</h4>
                                                        <p style="padding: 1px 0; text-align: center; box-sizing: border-box; width: 45px; border-radius: 5px; background-color: #fffe00; color: #000; font-size: 15px;">'.$ratings.' ★</p>
                                                    </div>
                                                    <p style="padding: 10px 0 0 0; font-size: 15px">'.$review.'</p>
                                                </div>';
                                        }

                                        elseif ($ratings == 1)
                                        {
                                            echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                    <div style="display: flex;">
                                                        <h4 style="padding: 0 15px 0 0; text-align: center; font-size: 15px;">'.$fname.'</h4>
                                                        <p style="padding: 1px 0; text-align: center; box-sizing: border-box; width: 45px; border-radius: 5px;  background-color: #ff3600; color: #fff; font-size: 15px;">'.$ratings.' ★</p>
                                                    </div>
                                                    <p style="padding: 10px 0 0 0; font-size: 15px">'.$review.'</p>
                                                </div>';
                                        }
                                    }
                                echo '</div>

                            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <h1>Questions</h1>
                                </div>';

                                    $q66 = mysqli_query($conn, "SELECT COUNT(Serial_no) as cques from questions where fid='$fid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q66))
                                    {
                                        $cques = $row['cques'];
                                        // echo $cques;
                                    }
                                    
                                    $a = 0;
                                    if ($cques == 0)
                                    {
                                        echo '<p style="padding: 10px;">Be the First One to Ask A Question</p>';    
                                    }
                                    else
                                    {
                                        $q6 = mysqli_query($conn, "Select * from questions") or die('Error');
                                        while ($row = mysqli_fetch_array($q6))
                                        {
                                            $ques = $row['ques'];
                                            $qdate = $row['qdate'];
                                            $uqid = $row['uid'];
                                            $qid = $row['qid'];
                                            $fname = $row['fname'];
                                            $q68 = mysqli_query($conn, "Select * from ans where qid='$qid' and fid='$fid'") or die('Error');
                                            while ($row = mysqli_fetch_array($q68))
                                            {
                                                $a++;
                                                $ans = $row['ans'];
                                                $adate = $row['adate'];
                                                if ($ans == '')
                                                {
                                                    if ($a >= 6)
                                                    {
                                                        echo'<div class="" style="margin: 10px 10px 0px;">
                                                        </div>';
                                                    }
                                                    else
                                                    {
                                                        echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                                <div style="display: flex; justify-content: space-between;">
                                                                    <div style="display: flex;">
                                                                        <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                                        <p style=" font-size: 20px; font-weight: 600;">'.$ques.'</p>
                                                                    </div>
                                                                    <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                                </div>
                                                                <p style="font-size: 15px; font-weight: 600; color: #8b8b8b;">'.$fname.'</p>
                                                                <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                                <p style="padding: 5px 10px 10px 10px;">The Question is not Answered Yet</p>
                                                            </div>';
                                                    }
                                                }
                                                else
                                                {
                                                    if ($a >= 5)
                                                    {
                                                        echo'<div class="" style="margin: 10px 10px 0px;">
                                                        </div>';
                                                    }
                                                    else
                                                    {
                                                        echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                                <div style="display: flex; justify-content: space-between;">
                                                                    <div style="display: flex;">
                                                                        <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                                        <p style=" font-size: 20px; font-weight: 600;">'.$ques.'</p>
                                                                    </div>
                                                                    <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                                </div>
                                                                <p style="font-size: 15px; font-weight: 600; color: #8b8b8b;">'.$fname.'</p>
                                                                <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                                <div style="display: flex; justify-content: space-between;">
                                                                    <p style="padding: 5px 10px 10px 10px;">'.$ans.'</p>
                                                                    <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$adate.'</p>
                                                                </div>
                                                            </div>';
                                                    }
                                                }
                                            }
                                        }
                                    }

                            echo '<div class="quest">
                                    <form name="form" action="uupdate.php?q=equest&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: 40%;">
                                        <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                            <div style="width: 90%; margin: auto; text-align: center;">
                                                <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Question :</label>
                                                <textarea rows="3" cols="5" name="quest" placeholder="Enter Your Question" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px;"></textarea>
                                                <input class="sub btn" type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </form>
                                    <img src="images/close.png" onclick="foggle();">
                                </div>
                                <div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                    <a href="umain.php?q=0&step=2&fid='.$fid.'" target="_blank" class="link">View All Question</a>
                                    <button onclick="foggle()" style="cursor: pointer; border: none; padding: 10px;">Post A Question</button>
                                </div>
                            </div>
                        </div><!-- vdd class -->
                    </div><!-- Flex Class -->
                    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <h1>Categories</h1>
                        </div>
                        <div class="fbou" style="box-sizing: border-box; height: 35vh; border-radius: 2px; border-bottom: 1px solid #ddd;">
                            <div style="display: flex;">
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #e1202d;*/ background-image: url(images/rb1.jpg); border-radius: 10px;"><img class="ima" src="images/fb1.jpg"/><a href="umain.php?q=0&step=9&cat=Snack" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Snack</a></div>
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #ffe400;*/ background-image: url(images/rb2.jpg); border-radius: 10px;"><img class="ima" src="images/uy2.png"/><a href="umain.php?q=0&step=9&cat=Munchies" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Munchies</a></div>
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #9be120;*/ background-image: url(images/rb3.jpg); border-radius: 10px;"><img class="ima" src="images/uy3.png"/><a href="umain.php?q=0&step=9&cat=Dairy, Bread and Eggs" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Dairy, Bread and Eggs</a></div>
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #6aa3a8;*/ background-image: url(images/rb4.jpg); border-radius: 10px;"><img class="ima" src="images/uy4.png"/><a href="umain.php?q=0&step=9&cat=Tea, Coffee and Health" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Tea, Coffee and Health</a></div>
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #e1202d;*/ background-image: url(images/rb5.jpg); border-radius: 10px;"><img class="ima" src="images/uy5.png"/><a href="umain.php?q=0&step=9&cat=Cold Drinks and Juices" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Cold Drinks and Juices</a></div>
                                <div style="position: relative; box-shadow: 2px 1px 20px 0px rgb(155 123 123); display: flex; width: 350px; background: #fff; text-align: center; margin: auto 20px; padding: 10px; /*background-color: #e1202d;*/ background-image: url(images/rb6.jpg); border-radius: 10px;"><img class="ima" src="images/uy6.png"/><a href="umain.php?q=0&step=9&cat=Sauces and Spreads" class="link" style="color: #fff; font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink"></span>Sauces and Spreads</a></div>
                            </div>
                        </div>
                    </div>
                    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <h1>Similar Food Items</h1>
                        </div>
                        <div class="fbou" style="box-sizing: border-box; border-radius: 2px; height: 55vh; border-bottom: 1px solid #ddd;">';
                                $q68 = mysqli_query($conn, "Select * from items where fname='$foname'") or die('Error');
                                while ($row = mysqli_fetch_array($q68))
                                {
                                    $sfid = $row['fid'];
                                    $sfitno = $row['fitno'];
                                    $stype = $row['type'];
                                    $sdesc = $row['description'];
                                    $snetwt = $row['netwt'];
                                    $simage = $row['image'];
                                    $shid = $row['hid'];
                                    $shname = $row['hname'];
                                    $sfname = $row['fname'];
                                    $smrp = $row['mrp'];
                                    $sdisc = $row['discount'];
                                    $savi = $row['availability'];
                                    $sinote = $row['inote'];
                                    $sibox = $row['ibox'];
                                    $singden = $row['ingden'];
                                    
                                    $samrp = $smrp - $sdisc;
                                    
                                    echo '<div style="position: relative; padding: 1%; box-shadow: 2px 1px 20px 0px rgb(155 123 123); margin: auto 0 auto 40px;">
                                            <div class="ima" style="height: 120px; width: 180px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($simage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                            </div>
                                            <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$shname.'</p>
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$stype.'</p>
                                            <a href="umain.php?q=0&step=1&fid='.$sfid.'" target="_blank" class="link"><span class="wlink"></span>'.$sfname.'</a>
                                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$snetwt.'</p>';
                                            if ($sdisc == 0)
                                            {
                                                echo '<h3 style="color: #ff0000;">₹'.$smrp.'</h3>
                                                    <p style="height: 21px;">&nbsp;</p>';
                                                
                                            }
                                            else
                                            {
                                                echo '<div style="display: flex;">
                                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$smrp.'</h3>
                                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$samrp.'</h3>
                                                    </div>
                                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$sdisc.' Off</p>';
                                            }
                                            echo '</div>';
                                }
                        echo '</div>
                        </div>
                        <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                            <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                <h1>Bought Together</h1>
                            </div>
                            <div class="fbou" style="box-sizing: border-box; border-radius: 2px; height: 55vh; border-bottom: 1px solid #ddd;">';
                                $q5 = mysqli_query($conn, "Select * from boughtogh where fid='$fid'") or die('Error');
                                while ($row = mysqli_fetch_array($q5))
                                {
                                    $btfid = $row['btfid'];
                                    $q6 = mysqli_query($conn, "Select * from items where `fid`='$btfid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q6))
                                    {
                                        $sfid = $row['fid'];
                                        $sfitno = $row['fitno'];
                                        $stype = $row['type'];
                                        $sdesc = $row['description'];
                                        $snetwt = $row['netwt'];
                                        $simage = $row['image'];
                                        $shid = $row['hid'];
                                        $shname = $row['hname'];
                                        $sfname = $row['fname'];
                                        $smrp = $row['mrp'];
                                        $sdisc = $row['discount'];
                                        $savi = $row['availability'];
                                        $sinote = $row['inote'];
                                        $sibox = $row['ibox'];
                                        $singden = $row['ingden'];
                
                                        $samrp = $smrp - $sdisc;
                                            
                                        echo '<div style="position: relative; padding: 1%; box-shadow: 2px 1px 20px 0px rgb(155 123 123); margin: auto 0 auto 40px;">
                                                <div class="ima" style="height: 120px; width: 180px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                                    <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($simage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                                </div>
                                                <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$shname.'</p>
                                                <p style="color: #9b9b9b; font-size: 0.9rem;">'.$stype.'</p>
                                                <a href="umain.php?q=0&step=1&fid='.$sfid.'" target="_blank" class="link"><span class="wlink"></span>'.$sfname.'</a>
                                                <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$snetwt.'</p>';
                                                if ($sdisc == 0)
                                                {
                                                    echo '<h3 style="color: #ff0000;">₹'.$smrp.'</h3>
                                                        <p style="height: 21px;">&nbsp;</p>';                    
                                                }
                                                else
                                                {
                                                    echo '<div style="display: flex;">
                                                            <h3 style="text-decoration: line-through 1.8px;">₹'.$smrp.'</h3>
                                                            <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$samrp.'</h3>
                                                        </div>
                                                    <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$sdisc.' Off</p>';
                                                }
                                                echo '</div>';
                                        }
                                    }
                    echo '</div>
                    </div>
                    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <h1>Questions</h1>
                        </div>
                        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <p style="font-size: 20px">In The Box</p>
                            <p style="padding: 10px 0 0 0;font-size: 15px">'.$ibox.'</p>
                        </div>
                        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <p style="font-size: 20px">Ingredients</p>
                            <p style="padding: 10px 0 0 0;font-size: 15px">'.$ingden.'</p>
                        </div>
                    </div>

                </div>';
        }
    }
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<!-- View Question -->
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 2) && (@$_GET['fid']))
{
    $fid = @$_GET['fid'];

    $q3 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
    $c = 1;
    while ($row = mysqli_fetch_array($q3))
    {
        $fid = $row['fid'];
        $fitno = $row['fitno'];
        $type = $row['type'];
        $desc = $row['description'];
        $netwt = $row['netwt'];
        $image = $row['image'];
        $hid = $row['hid'];
        $hname = $row['hname'];
        $foname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        $inote = $row['inote'];
        $ibox = $row['ibox'];
        $ingden = $row['ingden'];
        $aditm = $row['ditm'];

        $amrp = $mrp - $disc;
        echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                <div style="display: flex;">
                    <div style="position: -webkit-sticky; position: sticky; top: 20px; bottom: 0; width: 37%; z-index: 2; -webkit-align-self: flex-start; -ms-flex-item-align: start; align-self: flex-start;">
                        <div class="vdima" style="width: unset;">
                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto; height: 200px;"/>
                        </div>
                        <a href="" class="btn" style="margin: 10px 0 0 0; width: 100%; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>
                        
                        <div style="position: relative; padding: 20px 0 0 0;">
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;" target="_blank"><span class="wlink" style="height: 135px;"></span>'.$foname.'</a></h1>
                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$netwt.'</p>';
                            if ($disc == 0)
                            {
                                echo '<h3 style="color: #ff0000;">₹'.$mrp.'</h3>
                                <p style="height: 21px;">&nbsp;</p>';    
                            }
                            else
                            {
                                echo '<div style="display: flex;">
                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$mrp.'</h3>
                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$amrp.'</h3>
                                    </div>
                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$disc.' Off</p>';
                            }
                
                echo '</div>
                    </div>
                    <div class="vdd" style="width: 100%;">
                        <div style="box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                            <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                <h1>Questions</h1>
                            </div>';

                            $q66 = mysqli_query($conn, "SELECT COUNT(Serial_no) as cques from questions where fid='$fid'") or die('Error');
                            while ($row = mysqli_fetch_array($q66))
                            {
                                $cques = $row['cques'];
                                // echo $cques;
                            }
                                    
                            $a = 0;
                            if ($cques == 0)
                            {
                                echo '<p style="padding: 10px;">Be the First One to Ask A Question</p>';    
                            }
                            else
                            {
                                $q6 = mysqli_query($conn, "Select * from questions") or die('Error');
                                while ($row = mysqli_fetch_array($q6))
                                {
                                    $ques = $row['ques'];
                                    $qdate = $row['qdate'];
                                    $uqid = $row['uid'];
                                    $qid = $row['qid'];
                                    $fname = $row['fname'];
                                    $q68 = mysqli_query($conn, "Select * from ans where qid='$qid' and fid='$fid'") or die('Error');
                                    while ($row = mysqli_fetch_array($q68))
                                    {
                                        $a++;
                                        $ans = $row['ans'];
                                        $adate = $row['adate'];
                                        if ($ans == '')
                                        {
                                            echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                    <div style="display: flex; justify-content: space-between;">
                                                        <div style="display: flex;">
                                                            <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                            <p style=" font-size: 20px; font-weight: 600;">'.$ques.'</p>
                                                        </div>
                                                        <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                    </div>
                                                    <p style="font-size: 15px; font-weight: 600; color: #8b8b8b;">'.$fname.'</p>
                                                    <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                    <p style="padding: 5px 10px 10px 10px;">The Question is not Answered Yet</p>
                                                </div>';
                                        }
                                        else
                                        {
                                            echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                    <div style="display: flex; justify-content: space-between;">
                                                        <div style="display: flex;">
                                                            <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                            <p style=" font-size: 20px; font-weight: 600;">'.$ques.'</p>
                                                        </div>
                                                        <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                    </div>
                                                    <p style="font-size: 15px; font-weight: 600; color: #8b8b8b;">'.$fname.'</p>
                                                    <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                    <div style="display: flex; justify-content: space-between;">
                                                        <p style="padding: 5px 10px 10px 10px; width: 74.5%;">'.$ans.'</p>
                                                        <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$adate.'</p>
                                                    </div>
                                                </div>';
                                        }
                                    }
                                }
                            }
                        }                      

                    echo '<div class="quest">
                            <form name="form" action="uupdate.php?q=equest&uid='.$uuid.'&hid='.$hid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: 40%;">
                                <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                    <div style="width: 90%; margin: auto; text-align: center;">
                                        <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Question :</label>
                                        <textarea rows="3" cols="5" name="quest" placeholder="Enter Your Question" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px;"></textarea>
                                        <input class="sub btn" type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                            <img src="images/close.png" onclick="foggle();">
                        </div>
                        <div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd; justify-content: end;">
                            <button onclick="foggle()" style="cursor: pointer; border: none; padding: 10px;">Post A Question</button>
                        </div>
                    </div>
                </div>';
}
?>
                        
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 1 && !(@$_GET['step']))
{
    $ch = @$_GET['ch'];
    $qq3 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($qq3))
    {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phno = $row['phno'];
        $emid = $row['emid'];
        $address = $row['address'];
        $city = $row['city'];
        $pincode = $row['pincode'];
    }

    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
        <p style="font-size: 2rem; font-weight: 600; text-align: center; color: #000;">Personal Details</p>';
    
        if ($ch == '')
        {
            echo '<div style="display: flex; justify-content: center;">
                    <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                        <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Name :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 65%;">
                                    <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$fname.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                    <input id="lname" name="lname" placeholder="Enter the Last Name" type="text" value="'.$lname.'" required="" autocomplete="off" title="Enter the Last Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=name" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Phone No :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 65%;">
                                    <div style="display: flex;">
                                        <div style="height: 40px; background: #b3b3b3; text-align: center;">
                                            <p style="color: #0000009e; text-align: center; padding: 6px 10px;">+91</p>
                                        </div>
                                        <input id="phno" name="phno" placeholder="Enter Your Phone Number" type="text" value="'.$phno.'" required="" autocomplete="off" title="Enter Your Phone Number" style="width: 100%; background:#deefff;position: relative;padding: 10px;color: #000;border: none;outline: none;box-shadow: none; font-size: 14px;letter-spacing: 1px;font-weight: 300; cursor: not-allowed;" maxlength="10" disabled>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=phno" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>


                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Email Id :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 65%;">
                                    <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$emid.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=emid" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 65%;">
                                    <textarea rows="3" cols="5" name="quest" placeholder="Enter Your Addredd" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px; cursor: not-allowed;" disabled>'.$address.'</textarea>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=address" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>
                    
                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Neighbourhood :</label>
                            <div style="display: flex; justify-content: space-between;">
                                <div style="width: 65%;">
                                    <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=nbhood" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>
                            <p style="cursor: context-menu; color: #3737378c; margin: 10px 0 35px 0; font-size: 0.7rem; text-align: start;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>


                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Pin Code :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 65%;">
                                    <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pincode.'" required="" autocomplete="off" title="Enter Your Pincode" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                </div>

                                <div style="display: flex; align-items: center;">
                                    <a href="umain.php?q=1&ch=pcode" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                </div>
                            </div>
                            <a href="umain.php?q=1&ch=all" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit All Details</a>
                        </div>
                    </form>
                </div>';
        }
        elseif ($ch == 'all')
        {
            echo '<div style="display: flex; justify-content: center;">
                    <form name="form" action="uupdate.php?q=editall&uid='.$uuid.'" method="POST" enctype="multipart/form-data" style="width: 50%;">
                        <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Name :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 100%;">
                                    <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$fname.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                    <input id="lname" name="lname" placeholder="Enter the Last Name" type="text" value="'.$lname.'" required="" autocomplete="off" title="Enter the Last Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                </div>
                            </div>

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Phone No :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 100%;">
                                    <div style="display: flex;">
                                        <div style="height: 40px; background: #b3b3b3; text-align: center;">
                                            <p style="color: #0000009e; text-align: center; padding: 6px 10px;">+91</p>
                                        </div>
                                        <input id="phno" name="phno" placeholder="Enter Your Phone Number" type="text" value="'.$phno.'" required="" autocomplete="off" title="Enter Your Phone Number" style="width: 100%; background:#deefff;position: relative;padding: 10px;color: #000;border: none;outline: none;box-shadow: none; font-size: 14px;letter-spacing: 1px;font-weight: 300;" maxlength="10">
                                    </div>
                                </div>
                            </div>


                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Email Id :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 100%;">
                                    <input id="emid" name="emid" placeholder="Enter the First Name" type="text" value="'.$emid.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                </div>
                            </div>

                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 100%;">
                                    <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Addredd" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px;">'.$address.'</textarea>
                                </div>
                            </div>
                    
                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Neighbourhood :</label>
                            <div style="display: flex; justify-content: space-between;">
                                <div style="width: 100%;">
                                    <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                </div>
                            </div>
                            <p style="cursor: context-menu; color: #3737378c; margin: 10px 0 35px 0; font-size: 0.7rem; text-align: start;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>


                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Pin Code :</label>
                            <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                <div style="width: 100%;">
                                    <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pincode.'" required="" autocomplete="off" title="Enter Your Pincode" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center;">
                                <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                            </div>
                        </div>
                    </form>
                </div>';
        }
        else
        {
            if ($ch == 'name')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Phone No :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$fname.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                        <input id="lname" name="lname" placeholder="Enter the Last Name" type="text" value="'.$lname.'" required="" autocomplete="off" title="Enter the Last Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                    </div>
                                </div>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Name :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$fname.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                        <input id="lname" name="lname" placeholder="Enter the Last Name" type="text" value="'.$lname.'" required="" autocomplete="off" title="Enter the Last Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=name" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            if ($ch == 'phno')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Phone No :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <div style="display: flex;">
                                            <div style="height: 40px; background: #b3b3b3; text-align: center;">
                                                <p style="color: #0000009e; text-align: center; padding: 6px 10px;">+91</p>
                                            </div>
                                            <input id="phno" name="phno" placeholder="Enter Your Phone Number" type="text" value="'.$phno.'" required="" autocomplete="off" title="Enter Your Phone Number" style="width: 100%; background:#deefff;position: relative;padding: 10px;color: #000;border: none;outline: none;box-shadow: none; font-size: 14px;letter-spacing: 1px;font-weight: 300;" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Phone No :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <div style="display: flex;">
                                            <div style="height: 40px; background: #b3b3b3; text-align: center;">
                                                <p style="color: #0000009e; text-align: center; padding: 6px 10px;">+91</p>
                                            </div>
                                            <input id="phno" name="phno" placeholder="Enter Your Phone Number" type="text" value="'.$phno.'" required="" autocomplete="off" title="Enter Your Phone Number" style="width: 100%; background:#deefff;position: relative;padding: 10px;color: #000;border: none;outline: none;box-shadow: none; font-size: 14px;letter-spacing: 1px;font-weight: 300; cursor: not-allowed;" maxlength="10" disabled>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=phno" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            if ($ch == 'emid')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Email Id :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$emid.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                    </div>
                                </div>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Email Id :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="fname" name="fname" placeholder="Enter the First Name" type="text" value="'.$emid.'" required="" autocomplete="off" title="Enter the First Name" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=emid" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            if ($ch == 'address')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Addredd" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px;">'.$address.'</textarea>
                                    </div>
                                </div>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <textarea rows="3" cols="5" name="quest" placeholder="Enter Your Addredd" required="" autocomplete="off" title="Enter Your Address" style="width: 100%; background: rgb(222, 239, 255); height: 97px; cursor: not-allowed;" disabled>'.$address.'</textarea>
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=address" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            if ($ch == 'nbhood')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Neighbourhood :</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 65%;">
                                        <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                    </div>
                                </div>
                                <p style="cursor: context-menu; color: #3737378c; margin: 10px 0 35px 0; font-size: 0.7rem; text-align: start;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Neighbourhood :</label>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 65%;">
                                        <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=nbhood" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                                <p style="cursor: context-menu; color: #3737378c; margin: 10px 0 35px 0; font-size: 0.7rem; text-align: start;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>
                            </div>
                        </form>
                    </div>';
            }
            if ($ch == 'pcode')
            {
                echo '<div style="display: flex; justify-content: center; margin: 0 0 25px 0;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div style="width: 67.5%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Pin Code :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pincode.'" required="" autocomplete="off" title="Enter Your Pincode" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                    </div>
                                </div>
                                <div style="display: flex; width: 65%; justify-content: center;">
                                    <a onclick="cancl()" class="sub btn" style="border-radius: 0px; border: none; width: 100px; height: 40px; padding: 10px; background: #ff6767; text-transform: none; max-width: 100px; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;">Cancel</a>
                                    <input type="submit" value="Submit" style=" border: none; width: 100px; height: 40px; margin: 0 0 0 3%; padding: 10px; text-transform: none; max-width: 100px; background: #677eff; color: #fff; cursor: pointer; font-size: 14px; font-weight: 500; letter-spacing: 1px;" />
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            else
            {
                echo '<div style="display: flex; justify-content: center;">
                        <form name="form" method="POST" enctype="multipart/form-data" style="width: 75%;">
                            <div style="width: 90%;margin: auto;text-align: center;font-size: 18px;font-weight: 600;text-transform: uppercase;letter-spacing: 2px;">';

                            echo '<label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Pin Code :</label>
                                <div style="display: flex; justify-content: space-between; margin: 0 0 35px 0;">
                                    <div style="width: 65%;">
                                        <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pincode.'" required="" autocomplete="off" title="Enter Your Pincode" style="width: 100%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; font-size: 14px; letter-spacing: 1px; font-weight: 300; cursor: not-allowed;" disabled>
                                    </div>

                                    <div style="display: flex; align-items: center;">
                                        <a href="umain.php?q=1&ch=pcode" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit Details</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>';
            }
            echo '<div style="display: flex; margin: 40px 0 0 0; justify-content: center;">
                    <a href="umain.php?q=1&ch=all" class="btn" style="color: #fff; background: #ffb102; text-transform: none; letter-spacing: 0;">Edit All Details</a>
                </div>';
        }
        echo '</div>';
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 2 && !(@$_GET['step']))
{
    $c = 0;
    $tyy = 1;
    $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($qa4))
    {
        $pcde = $row['pincode'];
        $city = $row['city'];
        $address = $row['address'];
    }
    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0; display: flex; justify-content: space-between;">
            <p style="margin: auto 0;">Deliver To:  '.$city.' - '.$pcde.'</p>
            <a onclick="toggle()" class="btn" style="display: flex; cursor: pointer; justify-content: center; color: #FFFFFF; background: #5eff0c;">Change Pin Code</a>
        </div>
        <div class="pin tq">
            <form name="form" action="uupdate.php?q=cpin&uid='.$uuid.'&cust='.$cust.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                    <div style="width: 90%; margin: auto; text-align: center;">
                        <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                        <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address:</label>
                        <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Address" autocomplete="off" title="Enter Your Address" style="width: 396px; background: rgb(222, 239, 255); height: 97px;">'.$address.'</textarea>
                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Neighbourhood:</label>
                        <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 10px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                        <p style="cursor: context-menu; color: #3737378c; font-size: 0.8rem; text-align: start; padding: 0 4% 6% 4%; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>
                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Pincode:</label>
                        <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pcde.'" required="" autocomplete="off" title="Enter Your Pincode"  style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                        <input class="sub btn" type="submit" value="Submit">
                    </div>
                </div>
            </form>
            <img src="images/close.png" class="clsb" onclick="toggle();">
        </div>';

    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';
    $q4 = mysqli_query($conn, "select * from adcart where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q4))
    {
        $fid = $row['fid'];
        $qty = $row['qty'];
        $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($q485))
        {
            $afid = $row['fid'];
            $afitno = $row['fitno'];
            $atype = $row['type'];
            $adesc = $row['description'];
            $anetwt = $row['netwt'];
            $aimage = $row['image'];
            $ahid = $row['hid'];
            $ahname = $row['hname'];
            $afname = $row['fname'];
            $amrp = $row['mrp'];
            $adisc = $row['discount'];
            $aavi = $row['availability'];
            $aditm = $row['ditm'];

            $atamrp = $amrp - $adisc;
            
            $qk4 = mysqli_query($conn, "select * from sinfo where hid='$ahid'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($qk4))
            {
                $sstatus = $row['sstatus'];
            }

            $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($qa4))
            {
                $pcde = $row['pincode'];
                $q485 = mysqli_query($conn, "select count(pcode) as ty from dpcode where hid='$ahid' and pcode='$pcde'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($q485))
                {
                    $ty = $row['ty'];

                    if ($ty < '1' || $aavi != 'Available' || $sstatus != 'online')
                    {
                        echo '<div style="position: relative; display: flex; filter: grayscale(1); box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                <div style="display: flex;">
                                    <div class="ima" style="height: 120px; width: 180px;">
                                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                    </div>
                                    <div class="vdd">
                                        <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                        <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                        <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                        <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                        if ($adisc == 0)
                                        {
                                            echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                            <p style="height: 21px;">&nbsp;</p>';
                                            
                                        }
                                        else
                                        {
                                            echo '<div style="display: flex;">
                                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                </div>
                                            <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                        }

                                        $tyy = 0;
                                        echo '</div>
                                        </div>
                                        <p style="color: #9b9b9b; font-size: 1.5rem;">Items Unable to Deliver from this Hotel</p>';
                    }
                    else
                    {
                        echo '<div style="position: relative; display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                <div style="display: flex;">
                                    <div class="ima" style="height: 120px; width: 180px;">
                                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                    </div>
                                    <div class="vdd">
                                        <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                        <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                        <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                        <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                        if ($adisc == 0)
                                        {
                                            echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                            <p style="height: 21px;">&nbsp;</p>';                
                                        }
                                        else
                                        {
                                            echo '<div style="display: flex;">
                                                    <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                    <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                </div>
                                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                        }
        
                                        if ($tyy == 0)
                                        {
                                            $tyy = 0;
                                        }
                                        else
                                        {                                            
                                            $tyy = $ty;
                                        }
                                        echo '</div>
                                        </div>';
                                    
                    }
                }
            }            
                        echo '<div style="display: flex; margin: auto 0; height: 35px; text-align: center; background: #fafafa; border: 1px solid #efeaea;">
                            <a href="uupdate.php?q=rqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=2page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 50px; font-weight: 600; font-size: 25px;">-</a>
                            <form action="uupdate.php?q=uqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=2page" method="POST">
                                <input id="qtyy" name="qtyy" placeholder="Enter Your Hotel Name" type="text" required="" autocomplete="off" value="'.$qty.'" title="Enter Your Hotel Name" style="text-align: center; width: 70px; height: 33px; background: #fff; padding: 3px; border: 1px solid #efeaea;"  onchange="this.form.submit()">
                            </form>
                            <!-- <p style="text-align: center; width: 70px; background: #fff; padding: 3px; border: 1px solid #efeaea;">'.$qty.'</p> -->
                            <a href="uupdate.php?q=aqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=2page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 50px; font-weight: 600; font-size: 25px;">+</a>
                        </div>
                    </div>';
                    }
                }
                // $dev = 0;
            $qrp = 0;
            $tota = 0;
            $c = 0;
            $q5 = mysqli_query($conn, "Select * from adcart where uid='$uuid'") or die('Error');
            while ($row = mysqli_fetch_array($q5))
            {
                $fid = $row['fid'];
                $qty = $row['qty'];
                $q6 = mysqli_query($conn, "Select * from items where `fid`='$fid' and `availability`='available'") or die('Error');
                while ($row = mysqli_fetch_array($q6))
                {
                    $fmrp = $row['mrp'];
                    $fdisc = $row['discount'];
                    $favi = $row['availability'];
                    if ($favi == 'Available')
                    {
                        $c++;
                    }
                    
                    if ($fdisc != 0)
                    {
                        $famrp = ($fmrp - $fdisc) * $qty;
                        $qrp = $qrp + $famrp;
                        // echo $famrp.'<br>'.$qrp;
                    }
                    else
                    {
                        // $afamrp = 0;
                        $qrp = $qrp + ($fmrp * $qty);
                        // echo $qrp;
                    }
                    // echo $qrp;
                }
            }

            if ($c >= 1)
            {
                echo '<div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; box-shadow: 0px 0px 0px, 0px -10px 20px rgb(0 0 0 / 7%); justify-content: space-between;">';
                    echo '<div style="display: flex;">
                            <p style="font-size: 20px; padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto;">Total</p>
                            <p style="padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">=</p>
                            <p style="text-align: center; width: 100px; font-size: 13px; display: block;">'.$c.' Item<br>
                            <span style=" font-size: 20px;"> ₹ '.$qrp.'</span></p>
                        </div>';
                if ($tyy != 0)
                {
                    echo '<a href="umain.php?q=2&step=1" class="btn" style="margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
                else
                {
                    echo '<a class="btn" style="cursor: not-allowed; margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
            }

            echo'</div>';
        echo '</div>
    </div>';
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->
<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 2 && (@$_GET['step'] == 1))
{
    $fid = @$_GET['fid'];
    $tryt = "";

    echo '<h1 style="font-size: 2rem; text-align: center; padding: 0 0 20px 0;">Order Summary</h1>';
    if ($fid == '')
    {
        $c = 0;
        $tyy = 1;
        $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qa4))
        {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $pcde = $row['pincode'];
            $city = $row['city'];
            $address = $row['address'];
        }
        echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h1>Delivery Address</h1>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <p style="font-size: 20px; font-weight: 600;">'.$fname.' '.$lname.'</p>
                        <p style="padding: 10px 0 0 0; width: 30%; font-size: 15px;">'.$address.'</p>
                    </div>
                </div>
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h1>Pincode</h1>
                    </div>
                    <div style="display: flex; justify-content: space-between; box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <p style="margin: auto 0;">Deliver To:  '.$city.' - '.$pcde.'</p>
                        <a onclick="toggle()" class="btn" style="display: flex; cursor: pointer; justify-content: center; color: #FFFFFF; background: #5eff0c;">Change Address & Pin code</a>
                    </div>
                </div>
            </div>
            <div class="pin tq">
                <form name="form" action="uupdate.php?q=cpin&uid='.$uuid.'&cust='.$cust.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                    <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                        <div style="width: 90%; margin: auto; text-align: center;">
                            <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address:</label>
                            <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Address" autocomplete="off" title="Enter Your Address" style="width: 396px; background: rgb(222, 239, 255); height: 97px;">'.$address.'</textarea>
                            <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Neighbourhood:</label>
                            <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 10px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                            <p style="cursor: context-menu; color: #3737378c; font-size: 0.8rem; text-align: start; padding: 0 4% 6% 4%; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>
                            <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Pincode:</label>
                            <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pcde.'" required="" autocomplete="off" title="Enter Your Pincode"  style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                            <input class="sub btn" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                <img src="images/close.png" class="clsb" onclick="toggle();">
            </div>';
    
        echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';
        $q4 = mysqli_query($conn, "select * from adcart where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($q4))
        {
            $fid = $row['fid'];
            $qty = $row['qty'];
            $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($q485))
            {
                $afid = $row['fid'];
                $afitno = $row['fitno'];
                $atype = $row['type'];
                $adesc = $row['description'];
                $anetwt = $row['netwt'];
                $aimage = $row['image'];
                $ahid = $row['hid'];
                $ahname = $row['hname'];
                $afname = $row['fname'];
                $amrp = $row['mrp'];
                $adisc = $row['discount'];
                $aavi = $row['availability'];
                $aditm = $row['ditm'];
    
                $atamrp = $amrp - $adisc;
    
                $tryt = $tryt.','.$afid;
                $qk4 = mysqli_query($conn, "select * from sinfo where hid='$ahid'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qk4))
                {
                    $sstatus = $row['sstatus'];
                }

                $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qa4))
                {
                    $pcde = $row['pincode'];
                    $q485 = mysqli_query($conn, "select count(pcode) as ty from dpcode where hid='$ahid' and pcode='$pcde'") or die("No Items Details Fetched, Error Ask Sagar");
                    while ($row = mysqli_fetch_array($q485))
                    {
                        $ty = $row['ty'];
    
                        if ($ty < '1' || $aavi != 'Available' || $sstatus != 'online')
                        {
                            echo '<div style="position: relative; display: flex; filter: grayscale(1); box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                    <div style="display: flex;">
                                        <div class="ima" style="height: 120px; width: 180px;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <div class="vdd">
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                            if ($adisc == 0)
                                            {
                                                echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';
                                                
                                            }
                                            else
                                            {
                                                echo '<div style="display: flex;">
                                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                    </div>
                                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                            }
    
                                            $tyy = 0;
                                            echo '</div>
                                            </div>
                                            <p style="color: #9b9b9b; font-size: 1.5rem;">Items Unable to Deliver from this Hotel</p>';
                        }
                        else
                        {
                            echo '<div style="position: relative; display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                    <div style="display: flex;">
                                        <div class="ima" style="height: 120px; width: 180px;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <div class="vdd">
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                            if ($adisc == 0)
                                            {
                                                echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';                
                                            }
                                            else
                                            {
                                                echo '<div style="display: flex;">
                                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                    </div>
                                                    <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                            }
            
                                            if ($tyy == 0)
                                            {
                                                $tyy = 0;
                                            }
                                            else
                                            {                                            
                                                $tyy = $ty;
                                            }
                                            echo '</div>
                                            </div>';
                                        
                        }
                    }
                }            
                            echo '<div style="display: flex; margin: auto 0; height: 35px; text-align: center; background: #fafafa; border: 1px solid #efeaea;">
                                    <a href="uupdate.php?q=rqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=3page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 50px; font-weight: 600; font-size: 25px;">-</a>
                                    <form action="uupdate.php?q=uqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=3page" method="POST">
                                        <input id="qtyy" name="qtyy" placeholder="Enter Your Hotel Name" type="text" required="" autocomplete="off" value="'.$qty.'" title="Enter Your Hotel Name" style="text-align: center; width: 70px; height: 33px; background: #fff; padding: 3px; border: 1px solid #efeaea;"  onchange="this.form.submit()">
                                    </form>
                                    <!-- <p style="text-align: center; width: 70px; background: #fff; padding: 3px; border: 1px solid #efeaea;">'.$qty.'</p> -->
                                    <a href="uupdate.php?q=aqty&uid='.$uuid.'&hid='.$ahid.'&fid='.$afid.'&qty='.$qty.'&ditm='.$aditm.'&rtn=3page" style="cursor: pointer; color: #2874f0; padding: 0; text-align: center; width: 50px; font-weight: 600; font-size: 25px;">+</a>
                                </div>
                        </div>';
                        }
                    }
                    // $dev = 0;
            echo '</div>';
            $qrp = 0;
            $qkrp = 0;
            $qdisc = 0;
            $tota = 0;
            $c = 0;
            $q5 = mysqli_query($conn, "Select * from adcart where uid='$uuid'") or die('Error');
            while ($row = mysqli_fetch_array($q5))
            {
                $fid = $row['fid'];
                $qty = $row['qty'];
                $q6 = mysqli_query($conn, "Select * from items where `fid`='$fid' and `availability`='available'") or die('Error');
                while ($row = mysqli_fetch_array($q6))
                {
                    $fmrp = $row['mrp'];
                    $fdisc = $row['discount'];
                    $favi = $row['availability'];
                    if ($favi == 'Available')
                    {
                        $c++;
                    }
                    $qkrp = $qkrp + ($fmrp * $qty);
                    // echo $qkrp.'<br>';
                    $qdisc = $qdisc + ($fdisc * $qty);
                    $qtrp = ($qkrp - $qdisc) + 30;
                    if ($fdisc != 0)
                    {
                        $famrp = ($fmrp - $fdisc) * $qty;
                        $qrp = $qrp + $famrp;
                        // echo $famrp.'<br>'.$qrp;
                    }
                    else
                    {
                        // $afamrp = 0;
                        $qrp = $qrp + ($fmrp * $qty);
                        // echo $qrp;
                    }
                    // echo $qrp;
                }
            }
            echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h2>Price Details</h2>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px 25px 15px; border-bottom: 1px solid #ddd; width: 40%;">
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                            <p style="font-size: 20px;">Price ('.$c.' Item)</p>
                            <p style="font-size: 20px;"> ₹ '.$qkrp.'</p>
                        </div>
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                            <p style="font-size: 20px;">Discount</p>
                            <div style="font-size: 20px; display: flex;">
                                <p style="font-size: 30px; color: #ff0a0a; line-height: 3px; width: 20px; margin: auto 0;">-</p>
                                <p style="font-size: 20px; padding: 0 0 0 3px; "> ₹ '.$qdisc.'</p>
                            </div>
                        </div>
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                            <p style="font-size: 20px;">Delivery Charges</p>
                            <div style="font-size: 20px; display: flex;">
                                <p style="font-size: 30px; color: #22db00; line-height: 3px; width: 20px; margin: auto 0;">+</p>
                                <p style="font-size: 20px; padding: 0 0 0 5px; "> ₹ 30</p>
                            </div>
                        </div>
                        <div style="font-weight: 500; padding: 20px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                            <p style="font-size: 20px;">Amount Payable</p>
                            <p style="font-size: 20px;"> ₹ '.$qtrp.'</p>
                        </div>
                    </div>
                </div>';
            echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';

            if ($c >= 1)
            {
                echo '<div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; justify-content: space-between;">';
                    echo '<div style="display: flex;">
                            <p style="font-size: 20px; padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto;">Total</p>
                            <p style="padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">=</p>
                            <p style="text-align: center; width: 100px; font-size: 13px; display: block;">'.$c.' Item<br>
                            <span style=" font-size: 20px;"> ₹ '.$qtrp.'</span></p>
                        </div>';
                if ($tyy != 0)
                {
                    $custid = base64_encode('cust'.rand(1000,99999));
                    $amount = base64_encode($qtrp);
                    $fik = base64_encode($tryt);
                    echo '<a href="umain.php?q=2&step=2&custid='.$custid.'&am='.$amount.'&fid='.$fik.'&ofrm=Cart" class="btn" style="margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
                else
                {
                    echo '<a class="btn" style="cursor: not-allowed; margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
            }

            echo'</div>';
            echo'</div>';

        echo '</div>';
    }
    else
    {
        $c = 0;
        $tyy = 1;
        $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qa4))
        {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $pcde = $row['pincode'];
            $city = $row['city'];
            $address = $row['address'];
        }
        echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h1>Delivery Address</h1>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <p style="font-size: 20px; font-weight: 600;">'.$fname.' '.$lname.'</p>
                        <p style="padding: 10px 0 0 0; width: 30%; font-size: 15px;">'.$address.'</p>
                    </div>
                </div>
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h1>Pincode</h1>
                    </div>
                    <div style="display: flex; justify-content: space-between; box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <p style="margin: auto 0;">Deliver To:  '.$city.' - '.$pcde.'</p>
                        <a onclick="toggle()" class="btn" style="display: flex; cursor: pointer; justify-content: center; color: #FFFFFF; background: #5eff0c;">Change Address & Pin code</a>
                    </div>
                </div>
            </div>
            <div class="pin tq">
                <form name="form" action="uupdate.php?q=cpin&uid='.$uuid.'&cust='.$cust.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                    <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                        <div style="width: 90%; margin: auto; text-align: center;">
                            <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Address:</label>
                            <textarea rows="3" cols="5" name="addrs" placeholder="Enter Your Address" autocomplete="off" title="Enter Your Address" style="width: 396px; background: rgb(222, 239, 255); height: 97px;">'.$address.'</textarea>
                            <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Neighbourhood:</label>
                            <input id="nhod" name="nhod" placeholder="Enter Your Neighbourhood" type="text" value="'.$city.'" required="" autocomplete="off" title="Enter Your Neighbourhood" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 10px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                            <p style="cursor: context-menu; color: #3737378c; font-size: 0.8rem; text-align: start; padding: 0 4% 6% 4%; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;" title="Write Using Approx if the weight is not Knowned">*Eg Santacruz, Bandra, Virar, Dombivli</p>
                            <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Pincode:</label>
                            <input id="pcde" name="pcde" placeholder="Enter Your Pincode" type="number" value="'.$pcde.'" required="" autocomplete="off" title="Enter Your Pincode"  style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                            <input class="sub btn" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                <img src="images/close.png" class="clsb" onclick="toggle();">
            </div>';
    
        echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';
            $qty = 1;
            $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($q485))
            {
                $afid = $row['fid'];
                $afitno = $row['fitno'];
                $atype = $row['type'];
                $adesc = $row['description'];
                $anetwt = $row['netwt'];
                $aimage = $row['image'];
                $ahid = $row['hid'];
                $ahname = $row['hname'];
                $afname = $row['fname'];
                $amrp = $row['mrp'];
                $adisc = $row['discount'];
                $aavi = $row['availability'];
                $aditm = $row['ditm'];
    
                $atamrp = $amrp - $adisc;
    
                // $tryt = $tryt.','.$afid;
                $qk4 = mysqli_query($conn, "select * from sinfo where hid='$ahid'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qk4))
                {
                    $sstatus = $row['sstatus'];
                }

                $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qa4))
                {
                    $pcde = $row['pincode'];
                    $q485 = mysqli_query($conn, "select count(pcode) as ty from dpcode where hid='$ahid' and pcode='$pcde'") or die("No Items Details Fetched, Error Ask Sagar");
                    while ($row = mysqli_fetch_array($q485))
                    {
                        $ty = $row['ty'];
    
                        if ($ty < '1' || $aavi != 'Available' || $sstatus != 'online')
                        {
                            echo '<div style="position: relative; display: flex; filter: grayscale(1); box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                    <div style="display: flex;">
                                        <div class="ima" style="height: 120px; width: 180px;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <div class="vdd">
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                            if ($adisc == 0)
                                            {
                                                echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';
                                                
                                            }
                                            else
                                            {
                                                echo '<div style="display: flex;">
                                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                    </div>
                                                <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                            }
    
                                            $tyy = 0;
                                            echo '</div>
                                            </div>
                                            <p style="color: #9b9b9b; font-size: 1.5rem;">Items Unable to Deliver from this Hotel</p>';
                        }
                        else
                        {
                            echo '<div style="position: relative; display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                                    <div style="display: flex;">
                                        <div class="ima" style="height: 120px; width: 180px;">
                                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                        </div>
                                        <div class="vdd">
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                                            if ($adisc == 0)
                                            {
                                                echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                                <p style="height: 21px;">&nbsp;</p>';                
                                            }
                                            else
                                            {
                                                echo '<div style="display: flex;">
                                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                                    </div>
                                                    <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                                            }
            
                                            if ($tyy == 0)
                                            {
                                                $tyy = 0;
                                            }
                                            else
                                            {                                            
                                                $tyy = $ty;
                                            }
                                            echo '</div>
                                            </div>';
                                        
                        }
                }            
                            echo '
                        </div>';
                        }
                    }
                    // $dev = 0;
            echo '</div>';
            $qrp = 0;
            $qkrp = 0;
            $qdisc = 0;
            $tota = 0;
            $c = 0;
                $q6 = mysqli_query($conn, "Select * from items where `fid`='$fid' and `availability`='available'") or die('Error');
                while ($row = mysqli_fetch_array($q6))
                {
                    $fmrp = $row['mrp'];
                    $fdisc = $row['discount'];
                    $favi = $row['availability'];
                    if ($favi == 'Available')
                    {
                        $c++;
                    }
                    $qkrp = $qkrp + ($fmrp * $qty);
                    // echo $qkrp.'<br>';
                    $qdisc = $qdisc + ($fdisc * $qty);
                    $qtrp = ($qkrp - $qdisc) + 30;
                    if ($fdisc != 0)
                    {
                        $famrp = ($fmrp - $fdisc) * $qty;
                        $qrp = $qrp + $famrp;
                        // echo $famrp.'<br>'.$qrp;
                    }
                    else
                    {
                        // $afamrp = 0;
                        $qrp = $qrp + ($fmrp * $qty);
                        // echo $qrp;
                    }
                    // echo $qrp;
                }
            echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                        <h2>Price Details</h2>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px 25px 15px; border-bottom: 1px solid #ddd; width: 40%;">
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                            <p style="font-size: 20px;">Price ('.$c.' Item)</p>
                            <p style="font-size: 20px;"> ₹ '.$qkrp.'</p>
                        </div>
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                            <p style="font-size: 20px;">Discount</p>
                            <div style="font-size: 20px; display: flex;">
                                <p style="font-size: 30px; color: #ff0a0a; line-height: 3px; width: 20px; margin: auto 0;">-</p>
                                <p style="font-size: 20px; padding: 0 0 0 3px; "> ₹ '.$qdisc.'</p>
                            </div>
                        </div>
                        <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                            <p style="font-size: 20px;">Delivery Charges</p>
                            <div style="font-size: 20px; display: flex;">
                                <p style="font-size: 30px; color: #22db00; line-height: 3px; width: 20px; margin: auto 0;">+</p>
                                <p style="font-size: 20px; padding: 0 0 0 5px; "> ₹ 30</p>
                            </div>
                        </div>
                        <div style="font-weight: 500; padding: 20px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                            <p style="font-size: 20px;">Amount Payable</p>
                            <p style="font-size: 20px;"> ₹ '.$qtrp.'</p>
                        </div>
                    </div>
                </div>';
            echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';

            if ($c >= 1)
            {
                echo '<div style="display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; justify-content: space-between;">';
                    echo '<div style="display: flex;">
                            <p style="font-size: 20px; padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto;">Total</p>
                            <p style="padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">=</p>
                            <p style="text-align: center; width: 100px; font-size: 13px; display: block;">'.$c.' Item<br>
                            <span style=" font-size: 20px;"> ₹ '.$qtrp.'</span></p>
                        </div>';
                if ($tyy != 0)
                {
                    $custid = base64_encode('cust'.rand(1000,99999));
                    $amount = base64_encode($qtrp);
                    $fik = base64_encode($afid);
                    echo '<a href="umain.php?q=2&step=2&custid='.$custid.'&am='.$amount.'&fid='.$fik.'&ofrm=Buy Now" class="btn" style="margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
                else
                {
                    echo '<a class="btn" style="cursor: not-allowed; margin-top: 10px; width: 200px; color: #FFFFFF; background: #ff0f0f;">Buy Now</a>';
                }
            }

            echo'</div>';
            echo'</div>';

        echo '</div>';
    }
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->
<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php 
if (@$_GET['q'] == 2 && (@$_GET['step']== 2) && (@$_GET['custid']) && (@$_GET['am']) && (@$_GET['fid']))
{
    $custid = base64_decode(@$_GET['custid']);
    $amount = base64_decode(@$_GET['am']);
    $ofrm = @$_GET['ofrm'];
    $orderid = "ORDS" . rand(10000,99999999);

    echo '<div style="background-color: #fff; padding: 20px 20px 40px 20px; margin: 0 0 30px 0;">
            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                    <h2>Payment Options</h2>
                </div>
                <div style="box-sizing: border-box; border-radius: 2px; margin: 20px; border: 1px solid #ddd;">
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 2px dotted #ddd;">
                        <a href="uupdate.php?q=paytm&uid='.$uuid.'&custid='.@$_GET['custid'].'&am='.@$_GET['am'].'&fid='.@$_GET['fid'].'&oid='.$orderid.'&ofrm='.base64_encode($ofrm).'" style="color: #000; cursor: pointer; font-size: 20px;">Cards (Credit and Debit Card)</a>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 2px dotted #ddd;">
                        <a style="color: #000; font-size: 20px;" title="Unable at the Moment">UPI</a>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 2px dotted #ddd;">
                        <a href="uupdate.php?q=paytm&uid='.$uuid.'&custid='.@$_GET['custid'].'&am='.@$_GET['am'].'&fid='.@$_GET['fid'].'&oid='.$orderid.'&ofrm='.base64_encode($ofrm).'" style="color: #000; cursor: pointer; font-size: 20px;">Net banking</a>
                    </div>
                    <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 0px dotted #ddd;">
                        <a href="uupdate.php?q=cod&uid='.$uuid.'&custid='.@$_GET['custid'].'&am='.@$_GET['am'].'&fid='.@$_GET['fid'].'&oid='.$orderid.'&ofrm='.base64_encode($ofrm).'" style="color: #000; cursor: pointer; font-size: 20px;">Cash on Delivery</a>
                    </div>
                </div>
            </div>
        </div>';
}

?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php 
if (@$_GET['q'] == 2 && (@$_GET['step']== 3) && (@$_GET['oid']) && (@$_GET['ostat']))
{
    $oid = base64_decode(@$_GET['oid']);
    // echo @$_GET['oid'];
    // $oid = @$_GET['oid'];
    // $ostat = base64_decode(@$_GET['ostat']);
    // echo $oid.'<br>'.$ostat;
    $qa4 = mysqli_query($conn, "select * from buynow where oid='$oid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($qa4))
    {
        $ptype = $row['ptype'];
        $ostat = $row['ostat'];
    }
    $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uuid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($qa4))
    {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $pcde = $row['pincode'];
        $city = $row['city'];
        $address = $row['address'];
    }
    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">';
    if ($ptype == 'Online Payment')
    {
        if ($ostat == 'Ordered')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment Successfull !! Order Placed !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
        elseif ($ostat == 'Delivered')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Order Delivered Successfully !!</h1>';
        }
        elseif ($ostat == 'Order Ready')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment Successfull !! Order Ready !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
        else
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment Successfull !! '.$ostat.' !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
    }
    else
    {
        if ($ostat == 'Ordered')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment To Be Done In Cash !! Order Placed !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
        elseif ($ostat == 'Delivered')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Order Delivered Successfully !!</h1>';
        }
        elseif ($ostat == 'Order Ready')
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment To Be Done In Cash !! Order Ready !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
        else
        {
            echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center;">!! Payment To Be Done In Cash !! '.$ostat.' !!<h2 style="padding: 10px 0 0 0; text-align: center;">!! Order will be Delivered Shortly !!</h2></h1>';
        }
    }
    echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
            <h1>Delivery Address</h1>
        </div>
        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
            <p style="font-size: 20px; font-weight: 600;">'.$fname.' '.$lname.'</p>
            <p style="padding: 10px 0 0 0; width: 30%; font-size: 15px;">'.$address.'</p>
        </div>
    </div>
    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
        <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
            <h1>Order Details</h1>
        </div>';
    
    $q4 = mysqli_query($conn, "select * from buynow where oid='$oid' and status='TXN_SUCCESS'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q4))
    {
        $fid = $row['fid'];
        $qty = $row['qty'];
        $amount = $row['amount'];
        // echo 'Sagar';
        // echo $fid;
        // $pattern = "/[,\s:]/";
        // $components = preg_split($pattern, $fid);
        // foreach($components as $item)
        // {
        $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($q485))
        {
            // echo 'Sagar';
            $afid = $row['fid'];
            $afitno = $row['fitno'];
            $atype = $row['type'];
            $adesc = $row['description'];
            $anetwt = $row['netwt'];
            $aimage = $row['image'];
            $ahid = $row['hid'];
            $ahname = $row['hname'];
            $afname = $row['fname'];
            $amrp = $row['mrp'];
            $adisc = $row['discount'];
            $aavi = $row['availability'];
            $aditm = $row['ditm'];

            $atamrp = $amrp - $adisc;

            echo '<div style="position: relative; display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">';
                echo'<div style="display: flex;">
                        <div class="ima" style="height: 120px; width: 180px;">
                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                        </div>
                        <div class="vdd">
                            <p style="color: #9b9b9b; font-size: 0.9rem;">From '.$ahname.'</p>
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$atype.'</p>
                            <h1><a href="umain.php?q=0&step=1&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
                            <p style="font-weight: 600; color: #0703ff; font-size: 0.9rem;">'.$anetwt.' * '.$qty.'</p>';
                            if ($adisc == 0)
                            {
                                echo '<h3 style="color: #ff0000;">₹'.$amrp*$qty.'</h3>
                                <p style="height: 21px;">&nbsp;</p>';                
                            }
                            else
                            {
                                echo '<div style="display: flex;">
                                        <h3 style="text-decoration: line-through 1.8px;">₹'.$amrp*$qty.'</h3>
                                        <h3 style="color: #ff0000; padding: 0 0 0 5px;">₹'.$atamrp*$qty.'</h3>
                                    </div>
                                    <p style="font-weight: 700; color: #ff00a5; font-size: 0.9rem;">₹'.$adisc*$qty.' Off</p>';
                            }
        }
    // }
                    echo '</div>';
                echo '</div>';
            echo '<div style="display: block;">Quantity<p style="text-align: center; width: 70px; height: fit-content; background: #fff; padding: 3px; border: 1px solid #efeaea;">'.$qty.'</p></div>
            </div>';
    }
    $qrp = 0;
    $qkrp = 0;
    $qdisc = 0;
    $tota = 0;
    $c = 0;
    $q5 = mysqli_query($conn, "Select * from buynow where ostat='$ostat' and oid='$oid'") or die('Error');
    while ($row = mysqli_fetch_array($q5))
    {
        $fid = $row['fid'];
        $qty = $row['qty'];
        $ptype = $row['ptype'];
        // echo 'Sagar';
        // echo $ptype;
        // echo $fid;

        $q6 = mysqli_query($conn, "Select * from items where `fid`='$fid'") or die('Error');
        while ($row = mysqli_fetch_array($q6))
        {
            $fmrp = $row['mrp'];
            $fdisc = $row['discount'];
            $favi = $row['availability'];
            $c++;
            // echo $c;
            $qkrp = $qkrp + ($fmrp * $qty);
            // echo $qkrp.'<br>';
            $qdisc = $qdisc + ($fdisc * $qty);
            $qtrp = ($qkrp - $qdisc) + 30;
            if ($fdisc != 0)
            {
                $famrp = ($fmrp - $fdisc) * $qty;
                $qrp = $qrp + $famrp;
                // echo $famrp.'<br>'.$qrp;
            }
            else
            {
                // $afamrp = 0;
                $qrp = $qrp + ($fmrp * $qty);
                // echo $qrp;\
            }
            // echo $qrp;
        }
    }
    echo '</div>';
    echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
            <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                <h2>Price Details • '.$ptype.'</h2>
            </div>
            <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px 25px 15px; border-bottom: 1px solid #ddd; width: 40%;">
                <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                    <p style="font-size: 20px;">Price ('.$c.' Item)</p>
                    <p style="font-size: 20px;"> ₹ '.$qkrp.'</p>
                </div>
                <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; justify-content: space-between;">
                    <p style="font-size: 20px;">Discount</p>
                    <div style="font-size: 20px; display: flex;">
                        <p style="font-size: 30px; color: #ff0a0a; line-height: 3px; width: 20px; margin: auto 0;">-</p>
                        <p style="font-size: 20px; padding: 0 0 0 3px; "> ₹ '.$qdisc.'</p>
                    </div>
                </div>
                <div style="font-weight: 500; padding: 5px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                    <p style="font-size: 20px;">Delivery Charges</p>
                    <div style="font-size: 20px; display: flex;">
                        <p style="font-size: 30px; color: #22db00; line-height: 3px; width: 20px; margin: auto 0;">+</p>
                        <p style="font-size: 20px; padding: 0 0 0 5px; "> ₹ 30</p>
                    </div>
                </div>
                <div style="font-weight: 500; padding: 20px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                    <p style="font-size: 20px;">Amount Payable</p>
                    <p style="font-size: 20px;"> ₹ '.$qtrp.'</p>
                </div>
            </div>
        </div>';
    echo '</div>';

}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top:0px;">
<div class="rew">
<div class="ds">
<?php 
if (@$_GET['q'] == 4 && !(@$_GET['step']))
{
    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
    <h1 style="font-size: 30px; font-weight: 600; text-align: center;">Order History</h1>
    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';
    
    $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and uid='$uuid' group by oid order by Serial_no") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q4))
    {
        $fid = $row['fid'];
        $oid = $row['oid'];
        $ostat = $row['ostat'];
        $kostat = base64_encode($ostat);
        $koid = base64_encode($oid);
        $amount = $row['amount'];
        $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($q485))
        {
            $aimage = $row['image'];
            $fnam = $row['fname'];
            $try = $fnam;
            $c = 1;
            $q49 = mysqli_query($conn, "select * from buynow where oid='$oid' and status='TXN_SUCCESS'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($q49))
            {    
                $fikd = $row['fid'];
                // $amount = $row['amount'];
                $q490 = mysqli_query($conn, "select * from items where fid='$fikd'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($q490))
                {
                    $afid = $row['fid'];
                    $afitno = $row['fitno'];
                    $atype = $row['type'];
                    $adesc = $row['description'];
                    $anetwt = $row['netwt'];
                    // $aimage = $row['image'];
                    $ahid = $row['hid'];
                    $ahname = $row['hname'];
                    $afname = $row['fname'];
                    $amrp = $row['mrp'];
                    $adisc = $row['discount'];
                    $aavi = $row['availability'];
                    $aditm = $row['ditm'];
        
                    $atamrp = $amrp - $adisc;

                    if ($c >= 2 && $c <= 3)
                    {
                        $try = $try.', '.$afname;
                    }
                    elseif ($c >= 4)
                    {
                        $try = $try.' +'.($c - 3);
                    }
                    $c++;
                }
            }
            // echo $try;
            echo '<div style="position: relative; display: flex; box-sizing: border-box; border-radius: 2px; padding: 25px 15px; border-bottom: 1px solid #ddd; justify-content: space-between;">
                    <div style="display: block;">
                        <h1 style="font-size: 15px; font-weight: 600; color: #d532d5bb; text-transform: capitalize;">'.base64_decode($kostat).'</h1>                
                        <a href="umain.php?q=2&step=3&oid='.$koid.'&ostat='.$kostat.'" class="link" style="font-size: 20px; font-weight: 600;"><span class="wlink"></span>'.$try.'</a>
                        <p style="font-size: 20px; font-weight: 500; padding: 60px 0 0 0;">Amount: ₹ '.$amount.'</p>
                    </div>
                    <div style="display: flex;">
                        <div class="ima" style="height: 120px; width: 180px;">
                            <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                        </div>';
                echo '</div>';
                echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

</section>

<?php include 'nav/_footer.php';?>
</body>
<script>
function myFunction()
{
  var x = document.getElementById("myTopnav");
  if (x.className == "topnav nv")
  {
    x.className += " nv responsive";
  }
  else
  {
    x.className = "topnav nv";
  }
}
function toggle()
{
	var trailer = document.querySelector(".pin");
	trailer.classList.toggle("active");
}
function togggle()
{
	var trailer = document.querySelector(".uvitm");
	trailer.classList.toggle("active");
}
function foggle()
{
	var trailer = document.querySelector(".quest");
	trailer.classList.toggle("active");
}
</script>
<script>
function cancl()
{
    var data = prompt("Are You Sure You Want to go Back\nNo Details Will Be Changed if you Click on Ok", "Yes");
    if (data == "yes" || data == "Yes" || data == "YES")
    {
        window.location ="umain.php?q=1";
    }
}
</script>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
</html>