<?php include 'nav/_dbconnect.php'; ?>
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['admin']))
{
	header("location: login.php");
	exit;
}
else
{
    $uid = $_SESSION['uid'];
    $r = mysqli_query($conn, "update sinfo set sstatus='online' WHERE hid='$uid'") or die('Error');    
}
?>
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
    <?php
        $uid = $_SESSION['uid'];
        $store = $_SESSION['store'];
        // echo $uid;
    ?>

    <nav>
        <ul class="kp">
            <li class="t">Snack Store</li>
                <?php
                    $store = $_SESSION['store'];
                    echo '<li class="tu" style="padding-left: 0px;"><a href="/snacks/logout.php?q=store&uid='.$uid.'" style="color: white;">Logout</a></li><li class="tu" style="padding-right: 5px;"> Hello,&nbsp;'. $store .'&nbsp;|</li>' ;
                ?>
        </ul>
    </nav>
    <div class="topnav" id="myTopnav">
        <a href="/snacks"><b>Dashboard</b></a>
        <a <?php
            if (@$_GET['q'] == 0)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=0">Home</a>
        <a <?php
            if (@$_GET['q'] == 1)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=1">Add Item</a>
        <a <?php
            if (@$_GET['q'] == 2)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=2">Edit Item</a>
        <a <?php
            if (@$_GET['q'] == 4)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=4">Remove Item</a>
        <!-- <a <?php
            if (@$_GET['q'] == 4)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=4">Maintain Bills</a> -->
        <a <?php
            if (@$_GET['q'] == 8)
            {
                echo 'style="background-color: #fe4949; color: #fff;"';
            }
            ?> href="main.php?q=8">See Records</a>
        <?php 
            echo '<div onload="cable();">
            <script type="text/javascript">
              function cable(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                  document.getElementById("cable").innerHTML = this.responseText;
                }
                xhttp.open("GET", "update.php?q=bell&uid='.$uid.'");
                xhttp.send();
              }
        
              setInterval(function(){
                cable();
              }, 5000);
            </script>
            <div id="cable">
            <a style="cursor: pointer;">🔔</a>
            </div>
            </div>';
        ?>
        <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

    <!-- &#128269; -->
<section class="tip">
<div class="cont">
<div class="rew">
<div class="ds">
<?php

if (@$_GET['q'] == 0 && !(@$_GET['step']))
{
    $result = mysqli_query($conn, "Select * from items") or die('Error');
    $q = mysqli_query($conn, "Select * from store where uid='$uid'") or die('Error');
    
    while ($row = mysqli_fetch_array($q))
    {
        $info = $row['sinfo'];
        if ($info == 'Unentered')
        {
            echo '<div class="uvitm active" style="overflow: auto;">
                    <div class="ainfo" style="position: inherit; top: 40px;">
                        <div class="info" style="background-color: #fff; border-radius: 10px;">
                            <h2 style="text-align: center; font-size: 30px; padding-top: 20px;">Enter Your Hotel Details</h2>
                            <div class="formBx" style="margin: 0 0 40px 0;">
                                <form name="form" action="update.php?q=addsinfo&uid='. $uid .'" method="POST" enctype="multipart/form-data" style="width: 100%;">

                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Hotel Name :</label>

                                        <input id="hname" name="hname" placeholder="Enter Your Hotel Name" type="text" required="" autocomplete="off" title="Enter Your Hotel Name" style="width:93%; background:#deefff;">

                                    </div>
                            
                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">
                                    
                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Phone No :</label>

                                        <input id="phno" name="phno" placeholder="Enter Your Hotel Phone Number" type="text" required="" autocomplete="off" title="Enter Your Hotel Phone Number" style="width: 93%; background:#deefff;">

                                        <p style="cursor: context-menu; color: #3737378c; font-size: 0.7rem; text-align: start; padding: 0 4%;">*Enter Another Number Using a ( / )<br>&nbsp;&nbsp;i.e XXXXXXXXXX / XXXXXXXXXX / &nbsp;&nbsp;XXXXXXXXXX</p>

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

                                    <div class="panel" style="padding:15px 0 15px 0; background-color: #e1e1e142;">

                                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Delivery Pin Code\'s</label>

                                        <input id="dpcde" name="dpcde" placeholder="Enter Your Pincode Where You Can Deliver" type="text" required="" autocomplete="off" title="Enter Your Pincode" style="width:93%; background:#deefff;">

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
                <img src="images/close.png" onclick="toggle();">
            </div>';
        }
        else
        {
            echo '<div onload="table();">
            <script type="text/javascript">
              function table(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function(){
                  document.getElementById("table").innerHTML = this.responseText;
                }
                xhttp.open("GET", "update.php?q=odet&uid='.$uid.'");
                xhttp.send();
              }
        
              setInterval(function(){
                table();
              }, 5000);
            </script>
            <div id="table">
        
            </div>
            </div>';
            $q68 = mysqli_query($conn, "Select * from questions where qans='Unanswered'") or die('Error');
            while ($row = mysqli_fetch_array($q68))
            {
                $hid = $row['hid'];
                $fid = $row['fid'];
            }
            if ($uid == $hid)
            {
                echo '<div id="questrem" class="questrem" style="display: flex; margin: 0px 25px 40px 25px;">
                        <h4 style="width: 97%;">Sir You Have Some New Questions To Be Answered</h4>
                        <span onclick="questrem();" style="margin-left: 15px; color: white; float: right; font-size: 40px; line-height: 30px; cursor: pointer; transition: 0.3s; font-weight: 600;">&times;</span>
                    </div>';
            }
            // echo $uid;
            echo '<div class="search" style="position:relative; display:flex; transition:0.5s;">
                    <div class="fl" style="padding: 0 30px; width: 600px;">
                        <button class="collapsible" style="background:linear-gradient(90deg,#FFC107,#E91E63);">Search by Food Name</button>
                        <div class="content">
                            <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                                <form name="form" action="main.php?q=0&step=1" method="POST" style="width:100%;">
                                    <input id="fname" name="fname" placeholder="Search by Food Name"  type="text" required="" autocomplete="off" title="Enter the Food Name">
                                    <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="fl" style="padding: 0 30px; width: 600px;">
                        <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Food Item No</button>
                        <div class="content">
                            <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                                <form name="form" action="main.php?q=0&step=2" method="POST" style="width:100%;">
                                    <input id="fitno" name="fitno" placeholder="Search by Food Item No"  type="text" required="" autocomplete="off" title="Enter the Food Item No">
                                    <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>';

            $c = 1;
            echo '<div style="display: inline-block; width: 1190px;">';
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
                // $ = $row[''];
                
                
                if ($hid == $_SESSION['uid'])
                {
                    $amrp = $mrp - $disc;
                    $q68 = mysqli_query($conn, "Select count(fid) as tot from questions where fid='$fid' and qans='Unanswered'") or die('Error');
                    while ($row = mysqli_fetch_array($q68))
                    {
                        $tot = $row['tot'];
                    }
                    echo '<div class="itm" style="position: relative;">';
                            if ($tot != 0)
                            {
                                echo '<p class="tot">'.$tot.'<span>Question</span></p>';
                            }
                            else
                            {
                                echo '<p></p>';
                            }
                            

                        echo'<div class="ima">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div> 
                            <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                            <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                            <h1><a href="main.php?q=0&step=4&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
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
                            if ($avi == "Available")
                            {
                                echo '<a href="update.php?q=unavi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:#ff0000;text-transform: uppercase;text-align: center; width: 100%;" title="It is Unavailable">Unavailable</a>';
                            }
                            else
                            {
                                echo '<a href="update.php?q=avi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:darkgreen;text-transform: uppercase;text-align: center; width: 100%;" title="Make it Available">Available</a>';
                            }
                            echo '<div class="fl">
                                    <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                                    <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                                </div>
                                <a href="main.php?q=0&step=3&fid='.$fid.'&type='.$type.'&netwt='.$netwt.'&fname='.$fname.'&fitno='.$fitno.'&desc='.$desc.'&mrp='.$mrp.'" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff3478;">Edit Details</a>
                            </div>';
                }
                // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
                // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
                // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
                // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>

            }

?>
</div>
<div style="font-size: 18px;font-weight: 600;text-transform: uppercase;text-align: center;margin-bottom: 10px; padding: 15px 0 0 0;">
    <a href="main.php?q=1" class="sub btn" style="border-radius:0px;border:none;padding:10px;height:40px;color:#fff;font-size:14px;letter-spacing:1px;font-weight:500;background:#ff890f;text-transform:none;max-width:150px;">Add Items</a>
    <a href="main.php?q=2" class="sub btn" style="border-radius:0px;border:none;padding:10px;height:40px;color:#fff;font-size:14px;letter-spacing:1px;font-weight:500;background:#5eff0c;text-transform:none;max-width:150px;margin-left:5px;">Edit Items</a>
</div>

<?php
}}}?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<!-- Search by Food Name -->
<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 1))
{
    $fname   = $_POST['fname'];
    $uid = $_SESSION['uid'];
    $q3      = mysqli_query($conn, "select * from `items` where fname='$fname' and hid='$uid'") or die("No Duty Details Added, Error Ask Sagar");
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
        $fname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        // $ = $row[''];
        
        
        if ($hid == $_SESSION['uid'])
        {
            $amrp = $mrp - $disc;
            $q68 = mysqli_query($conn, "Select count(fid) as tot from questions where fid='$fid' and qans='Unanswered'") or die('Error');
            while ($row = mysqli_fetch_array($q68))
            {
                $tot = $row['tot'];
            }
            echo '<div class="itm" style="position: relative;">';
                    if ($tot != 0)
                    {
                        echo '<p class="tot">'.$tot.'<span>Question</span></p>';
                    }
                    else
                    {
                        echo '<p></p>';
                    }
                    

                echo'<div class="ima">
                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                    </div> 
                    <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                    <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                    <h1><a href="main.php?q=0&step=4&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
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
                    if ($avi == "Available")
                    {
                        echo '<a href="update.php?q=unavi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:#ff0000;text-transform: uppercase;text-align: center; width: 100%;" title="It is Unavailable">Unavailable</a>';
                    }
                    else
                    {
                        echo '<a href="update.php?q=avi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:darkgreen;text-transform: uppercase;text-align: center; width: 100%;" title="Make it Available">Available</a>';
                    }
                    echo '<div class="fl">
                            <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                        </div>
                        <a href="main.php?q=0&step=3&fid='.$fid.'&type='.$type.'&netwt='.$netwt.'&fname='.$fname.'&fitno='.$fitno.'&desc='.$desc.'&mrp='.$mrp.'" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff3478;">Edit Details</a>
                    </div>';
        }
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
        // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
        // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>

    }
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<!-- Search by Food No -->
<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 2))
{
    $fitno   = $_POST['fitno'];
    $uid = $_SESSION['uid'];
    $q3      = mysqli_query($conn, "select * from `items` where fitno='$fitno' and hid='$uid'") or die("No Duty Details Added, Error Ask Sagar");
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
        $fname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        // $ = $row[''];
        
        
        if ($hid == $_SESSION['uid'])
        {
            $amrp = $mrp - $disc;
            $q68 = mysqli_query($conn, "Select count(fid) as tot from questions where fid='$fid' and qans='Unanswered'") or die('Error');
            while ($row = mysqli_fetch_array($q68))
            {
                $tot = $row['tot'];
            }
            echo '<div class="itm" style="position: relative;">';
                    if ($tot != 0)
                    {
                        echo '<p class="tot">'.$tot.'<span>Question</span></p>';
                    }
                    else
                    {
                        echo '<p></p>';
                    }
                    

                echo'<div class="ima">
                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                    </div> 
                    <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                    <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                    <h1><a href="main.php?q=0&step=4&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
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
                    if ($avi == "Available")
                    {
                        echo '<a href="update.php?q=unavi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:#ff0000;text-transform: uppercase;text-align: center; width: 100%;" title="It is Unavailable">Unavailable</a>';
                    }
                    else
                    {
                        echo '<a href="update.php?q=avi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:darkgreen;text-transform: uppercase;text-align: center; width: 100%;" title="Make it Available">Available</a>';
                    }
                    echo '<div class="fl">
                            <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                        </div>
                        <a href="main.php?q=0&step=3&fid='.$fid.'&type='.$type.'&netwt='.$netwt.'&fname='.$fname.'&fitno='.$fitno.'&desc='.$desc.'&mrp='.$mrp.'" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff3478;">Edit Details</a>
                    </div>';
        }
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
        // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
        // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>

    }
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<?php
if (@$_GET['q'] == 0 && (@$_GET['step']) == 3 && (@$_GET['fid']) && (@$_GET['type']) && (@$_GET['netwt']) && (@$_GET['fname']) && (@$_GET['fitno']) && (@$_GET['desc']) && (@$_GET['mrp']))
{
    // echo 'Sagar';
    $fid   = @$_GET['fid'];
    $type  = @$_GET['type'];
    $fitno = @$_GET['fitno'];
    $fname = @$_GET['fname'];
    $desc  = @$_GET['desc'];
    $netwt = @$_GET['netwt'];
    $mrp   = @$_GET['mrp'];

    // echo $fid.'<br>'.$type.'<br>'.$fitno.'<br>'.$fname.'<br>'.$desc.'<br>'.$netwt.'<br>'.$mrp;
    $q3      = mysqli_query($conn, "select * from `items` where fid='$fid'") or die("No Duty Details Added, Error Ask Sagar");
    $c = 1;
    while ($row = mysqli_fetch_array($q3))
    {
                            
        $disc = $row['discount'];
        $inote = $row['inote'];
        $ibox = $row['ibox'];
        $ingden = $row['ingden'];
        $ditm = $row['ditm'];
        // echo $disc;
    
        echo '<h2 style="text-align: center;font-size: 30px; margin-top: 0; position:relative;">Edit Food Item Details</h2>
                <div class="formBx" style="padding-top:3%; padding-bottom:5%; padding-right:0; padding-left:0;">
                    <form name="form" action="update.php?q=upitm&uid='. $uid .'&store='. $store .'&fid='.$fid.'" method="POST" enctype="multipart/form-data">

                        <div class="panel" style="padding:15px 0 25px 0;">

                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Type</label>

                            <select id="type" name="type" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">

                                <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>

                                <option value="Snack" style="background:#fff;color:#000;font-size:16px;">Snack</option>
                                
                                <option value="Munchies" style="background:#fff;color:#000;font-size:16px;">Munchies</option>

                                <option value="Dairy, Bread and Eggs" style="background:#fff;color:#000;font-size:16px;">Dairy, Bread and Eggs</option>
                                
                                <option value="Tea, Coffee and Health Drinks" style="background:#fff;color:#000;font-size:16px;">Tea, Coffee and Health Drinks</option>
                                
                                <option value="Cold Drinks and Juices" style="background:#fff;color:#000;font-size:16px;">Cold Drinks and Juices</option>
                                
                                <option value="Sauces and Spreads" style="background:#fff;color:#000;font-size:16px;">Sauces and Spreads</option>

                            </select>

                        </div>

                        <div class="panel" style="padding:15px 0 25px 0;">

                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Select Image File: </label>
                            
                            <input type="file" name="image"  style="width:93%; background:#deefff; padding:15px;">
                        
                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Food Item No :</label>

                            <input id="fitno" name="fitno" placeholder="Enter the Food Item No" value="'.$fitno.'" type="text" required="" autocomplete="off" title="Enter the Food Item No" style="width:93%; background:#deefff;">

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Name of Food</label>

                            <input id="fname" name="fname" placeholder="Enter the Name of The Food" value="'.$fname.'" type="text" required="" autocomplete="off" title="Enter the Name of The Food" style="width:93%; background:#deefff;">

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Description</label>

                            <textarea rows="3" cols="5" name="desc" placeholder="Enter the Description" autocomplete="off" title="Enter the Description" style="width:93%; background:#deefff;">'.$desc.'</textarea>

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Net Weight :</label>

                            <input id="netwt" name="netwt" placeholder="Enter the Net Weight of the Food" value="'.$netwt.'" type="text" required="" autocomplete="off" title="Enter the Net Weight of the Food" style="width:93%; background:#deefff;">

                            <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Write Using Approx if the weight is not Knowned">*Write Using Approx if the weight is not Knowned</p>

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">M.R.P</label>

                            <input id="mrp" name="mrp" placeholder="Enter the Price of Food in Rupees" value="'.$mrp.'" type="number" required="" autocomplete="off" title="Enter the Price of Food in Rupees" style="width:93%; background:#deefff;">

                            <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Enter the Actual MRP of the Product it means if you have a product of 100rs and 10rs off on that product than enter 100 in the box abovs">*Enter the Actual MRP</p>

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Discount</label>

                            <input id="dis" name="dis" placeholder="Enter the Discount in Rupees" value="'.$disc.'" type="number" required="" autocomplete="off" title="Enter the Discount in Rupees" style="width:93%; background:#deefff;">

                            <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Enter the Amount Off on the Product it means if you have a product of 100rs and 10rs off on that product than enter 10 in the box above">*Enter the Amount OFF on the Product</p>

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                    
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Important Note</label>

                            <input id="inote" name="inote" placeholder="Enter the Important Note About This Food Item" value="'.$inote.'" type="text" required="" autocomplete="off" title="Enter Anything About The Food Item That May Be Allergic To People Or Anything That Is Good To Have With This Food Item" style="width:93%; background:#deefff;">

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Ingredients</label>

                            <input id="ingden" name="ingden" placeholder="Enter the Ingredients" type="text" value="'.$ingden.'" required="" autocomplete="off" title="Enter the Ingredients" style="width:93%; background:#deefff;">

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">In The Box</label>

                            <input id="ibox" name="ibox" placeholder="Enter the Items Inside Box" type="text" value="'.$ibox.'" required="" autocomplete="off" title="Enter the Items Inside Box" style="width:93%; background:#deefff;">

                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">No. Of Items Deliverable</label>

                            <input id="ditm" name="ditm" placeholder="Enter the Items That Can Be Delivered At Once" value="'.$ditm.'" type="number" required="" autocomplete="off" title="Enter the Items That Can Be Delivered At Once" style="width:93%; background:#deefff;">

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

                        <input class="sub" type="submit" value="Submit" style="margin-top: 20px;"/>
                    </form>
                </div>';
    }
}
?>
<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 4) && (@$_GET['fid']))
{
    $fid = @$_GET['fid'];

    // echo 'Sagar';
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
            
            $amrp = $mrp - $disc;
            echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
                    <div style="display: flex;">
                        <div style="position: -webkit-sticky; position: sticky; top: 20px; bottom: 0; z-index: 2; -webkit-align-self: flex-start; -ms-flex-item-align: start; align-self: flex-start;">
                            <div class="vdima">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto; height: 370px;"/>
                            </div>
                            <div style="display: flex; padding: 7px 10px;">
                                <a onclick="toggle()" class="btn" style="display: flex; cursor: pointer; justify-content: center; margin: 10px 0 0 0; width: 100%; color: #FFFFFF; background: #5eff0c;"><span style="display: block; transform: rotate(267deg);">&#10162;</span><p style="padding: 0 0 0 5px;">Change Image</p></a>
                            </div>
                            <div class="cima tq">
                                <form name="form" action="update.php?q=uimag&hid='.$uid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                                    <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                        <div style="width: 90%; margin: auto; text-align: center;">
                                            <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Select Image File: </label>
                                            <input type="file" name="image" required="" style="width:93%; background:#deefff; position: relative; padding: 15px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                            <input class="sub btn" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                <img src="images/close.png" class="clsb" onclick="toggle();">
                            </div>
                        </div>
                        <div class="vdd" style="width: -webkit-fill-available;">
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

                        echo '<div style="display: flex; justify-content: space-between;">
                                <div style="display: flex;">
                                    <p style="color: #9b9b9b;">Important Note : </p>
                                    <p style="color: #3a3a3a; padding: 0 0 0 10px;"> '.$inote.'</p>
                                </div>
                                <div style="color: #9b9b9b; padding: 0 5px 0 0; display: flex; font-size: 18px; font-weight: 600;">
                                    <a onclick="foggle()" style="color: #9b9b9b; cursor: pointer; text-decoration: underline; display: flex;"><span style="display: block; transform: scaleX(-1);">&#9998;</span>Edit</a>
                                </div>
                            </div>
                            <div class="inote tq">
                                <form name="form" action="update.php?q=uinote&hid='.$uid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                                    <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                        <div style="width: 90%; margin: auto; text-align: center;">
                                        <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                                            <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">Information Note:</label>
                                            <input id="inote" name="inote" placeholder="Enter the Information Note" type="text" value="'.$inote.'" required="" autocomplete="off" title="Enter the Information Note" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                            <input class="sub btn" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                <img src="images/close.png" onclick="foggle();">
                            </div>
                            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                <div style="display: flex;box-sizing: border-box;justify-content: space-between;border-radius: 2px;padding: 10px 15px;border-bottom: 1px solid #ddd;">
                                    <h1>Specifications</h1>
                                    <div style="color: #9b9b9b; padding: 0 5px 0 0; display: flex; font-size: 18px; font-weight: 600;">
                                        <a onclick="fogggle()" style="color: #9b9b9b; cursor: pointer; text-decoration: underline; display: flex;"><span style="display: block; transform: scaleX(-1);">&#9998;</span>Edit</a>
                                    </div>
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
                            <div class="spec tq">
                            <form name="form" action="update.php?q=uspec&hid='.$uid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                                <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                    <div style="width: 90%; margin: auto; text-align: center;">
                                        <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                                        <label style="display: flex; margin: 1rem 0rem; color:#000; padding: 0 0 0 1%;">In the Box:</label>
                                        <input id="inbx" name="inbx" placeholder="Enter Contents In the Box" type="text" value="'.$ibox.'" required="" autocomplete="off" title="Enter the Information Note" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Ingredients:</label>
                                        <input id="ingden" name="ingden" placeholder="Enter the Ingredients in the Item" type="text" value="'.$ingden.'" required="" autocomplete="off" title="Enter the Information Note" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 0 0 25px 0; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                        <input class="sub btn" type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                            <img src="images/close.png" onclick="fogggle();">
                        </div>
                        
                        <div style="margin: 20px 0 0 0; display: grid; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                        <div style="display: flex;box-sizing: border-box;justify-content: space-between;border-radius: 2px;padding: 10px 15px;border-bottom: 1px solid #ddd;">
                            <h1>Frequently Bought Together</h1>
                            <div style="color: #9b9b9b; padding: 0 5px 0 0; display: flex; font-size: 18px; font-weight: 600;">
                                <a onclick="togggle()" style="color: #9b9b9b; cursor: pointer; text-decoration: underline; display: flex;">+Add</a>
                            </div>
                        </div>';
                        echo '<div class="fbou" style="border-bottom: 1px solid #ddd;">';
                        $amrp = $mrp - $disc;
                        echo '<div style="width: 33.5%; position: relative; padding: 30px 5px 30px 30px;">
                                <div class="ima" style="height: 80px; width: 121px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                    <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                </div>
                                <a href="" class="link"><span class="wlink"></span>'.$foname.'</a>
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
                        echo '</div>';
                    $q5 = mysqli_query($conn, "Select * from fbought where fid='$fid'") or die('Error');
                    while ($row = mysqli_fetch_array($q5))
                    {
                        $fbfid = $row['fbfid'];
                        $q6 = mysqli_query($conn, "Select * from items where `fid`='$fbfid'") or die('Error');
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
                            if ($favi == 'Available')
                            {
                                echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p>
                                    <div style="width: 33.5%; position: relative; padding: 30px 5px 30px 30px;">
                                    <div class="ima" style="height: 80px; width: 121px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($fimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                    </div>
                                    <a href="main.php?q=0&step=4&fid='.$ffid.'&fname='.$ffname.'" target="_blank" class="link"><span class="wlink" style="height: 77%;"></span>'.$ffname.'</a>
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
                                    echo '<a href="" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Remove</a>';
                                    echo '</div>';
                            }
                            else
                            {
                                echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p>
                                <div style="width: 33.5%; position: relative; padding: 30px 5px 30px 30px; filter: grayscale(1);" title="Unavailable">
                                <div class="ima" style="height: 80px; width: 121px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                    <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($fimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                </div>
                                <a href="main.php?q=0&step=4&fid='.$ffid.'&fname='.$ffname.'" target="_blank" class="link"><span class="wlink" style="height: 77%;"></span>'.$ffname.'</a>
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
                                echo '<a href="" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Remove</a>';
                                echo '</div>';
                            }
                        }
                    }
                    echo '</div>
                            </div>
                            <div class="addfb tq">
                                <form name="form" action="update.php?q=addfb&hid='.$uid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                                    <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                        <div style="width: 90%; margin: auto; text-align: center;">
                                        <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                                            <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Frequently Bought Together Foods:</label>
                                            <select id="type" name="type" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin: 0 0 25px 0; font-size:14px; letter-spacing:1px;">
                                                <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>';
                                                $q6 = mysqli_query($conn, "Select * from items where hid='$uid'") or die('Error');
                                                while ($row = mysqli_fetch_array($q6))
                                                {
                                                    $fname = $row['fname'];
                                                    $fidd = $row['fid'];
                                                    $fitno = $row['fitno'];
                                                    if ($fidd != $fid)
                                                    {
                                                        echo '<option value="'.$fidd.'" style="background:#fff;color:#000;font-size:16px;">'.$fname.'</option>';
                                                    }
                                                }
                                                echo '</select>
                                            <input class="sub btn" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                                <img src="images/close.png" onclick="togggle();">
                            </div>
                            <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                    <h1>Ratings and Reviews</h1>
                                </div>';
                                $q65 = mysqli_query($conn, "Select * from reviews where fid='$fid' and hid='$uid'") or die('Error');
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
                                }
                                                        
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
                            $rate = round($tstar);
                            echo '<div style="display: flex;">
                                <div class="rating act" style="margin: auto;">';
                                    if ($rate == 5)
                                    {
                                        $five = "checked";

                                        echo '<label>
                                                <input type="radio" name="stars"/>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                            </label>';
                                    }
                                    elseif ($rate == 4)
                                    {
                                        $four = "checked";
                                        // <span class="icon" style="padding: 0 0 0 20px; background: -webkit-linear-gradient(181deg,#000 35%, #ff3b00 0%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">★</span>   

                                        echo '<label>
                                                <input type="radio" name="stars"/>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                            </label>';
                                    }
                                    elseif ($rate == 3)
                                    {
                                        $three = "checked";

                                        echo '<label>
                                                <input type="radio" name="stars"/>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>   
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                            </label>';
                                    }
                                    elseif ($rate == 2)
                                    {
                                        $two = "checked";

                                        echo '<label>
                                                <input type="radio" name="stars"/>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                            </label>';
                                    }
                                    elseif ($rate == 1)
                                    {
                                        $one = "checked";

                                        echo '<label>
                                                <input type="radio" name="stars"/>
                                                <span class="icon" style="padding: 0 0 0 20px;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                                <span class="icon" style="padding: 0 0 0 20px; color: #000;">★</span>
                                            </label>';
                                    }
                                echo '</div>
                            </div>';

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
                            echo '<p style="font-size: 18px; font-weight: 500; text-align: center; padding: 30px 0;">No Ratings Yet</p>
                                <div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
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
                        '<h3 style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px;">Reviews</h3>';
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
                                echo '</div>';

                        echo '<div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
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
                                    echo '<p style="padding: 10px;">No Questions Asked Yet</p>';    
                                }
                                else
                                {
                                    $q6 = mysqli_query($conn, "Select * from questions where fid='$fid'") or die('Error');
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
                                                        <div style="display: flex;">
                                                            <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                            <p style=" font-size: 20px; width: 68%; font-weight: 600;">'.$ques.'</p>
                                                            <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                        </div>
                                                        <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                        <form name="form" action="update.php?q=ansque&qid='.$qid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="height: unset;">
                                                            <input id="qans" name="qans" placeholder="Enter Your Answer For this Question" type="text" required="" autocomplete="off" title="Enter Your Answer For this Question" style="width:93%; background:#deefff; position: relative; padding: 10px; color: #000; border: none; outline: none; box-shadow: none; margin: 5px 0 25px 10px; font-size: 14px; letter-spacing: 1px; font-weight: 300;">
                                                            <div style="display: flex; justify-content: center;">
                                                                <input class="sub btn" type="submit" value="Submit" style="margin: 0 0 0 10px;">
                                                            </div>
                                                        </form>
                                                    </div>';

                                            }
                                            else
                                            {
                                                echo '<div style="box-sizing: border-box; border-radius: 2px; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                                                        <div style="display: flex;">
                                                            <p style="font-size: 20px; padding: 0 5px 0 0; font-weight: 600;">Q'.$a.'.</p>
                                                            <p style=" font-size: 20px; width: 68%; font-weight: 600;">'.$ques.'</p>
                                                            <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$qdate.'</p>
                                                        </div>
                                                        <p style="font-size: 20px; padding: 10px 0 0 10px; font-weight: 600;">Answer: </p>
                                                        <div style="display: flex;">
                                                            <p style="padding: 5px 10px 10px 10px; width: 74.5%;">'.$ans.'</p>
                                                            <div>
                                                                <p style="font-size: 12px; font-weight: 700; color: #8b8b8b;">'.$adate.'</p>
                                                                <a href="update.php?q=eque&qid='.$qid.'&fid='.$fid.'" style="color: #9b9b9b; justify-content: end; cursor: pointer; text-decoration: underline; display: flex;"><span style="display: block; transform: scaleX(-1);">&#9998;</span>Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>';

                                            }
                                        }
                                    }
                                }
                        echo '</div>
                        </div><!--Flex Display -->                        
                    </div>
                    <div style="margin: 20px 0 0 0; display: grid; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">
                    <div style="display: flex;box-sizing: border-box;justify-content: space-between;border-radius: 2px;padding: 10px 15px;border-bottom: 1px solid #ddd;">
                        <h1>Bought Together</h1>
                        <div style="color: #9b9b9b; padding: 0 5px 0 0; display: flex; font-size: 18px; font-weight: 600;">
                            <a onclick="fogle()" style="color: #9b9b9b; cursor: pointer; text-decoration: underline; display: flex;">+Add</a>
                        </div>
                    </div>';
                    echo '<div class="fbou" style="border-bottom: 1px solid #ddd;">';
                    $amrp = $mrp - $disc;
                    echo '<div style="width: 20.5%; position: relative; padding: 30px 5px 30px 30px;">
                            <div class="ima" style="height: 120px; width: 180px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div>
                            <a href="" class="link"><span class="wlink"></span>'.$foname.'</a>
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
                    echo '</div>';
                $q5 = mysqli_query($conn, "Select * from boughtogh where fid='$fid'") or die('Error');
                while ($row = mysqli_fetch_array($q5))
                {
                    $btfid = $row['btfid'];
                    $q6 = mysqli_query($conn, "Select * from items where `fid`='$btfid'") or die('Error');
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
                        if ($favi == 'Available')
                        {
                            echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p>
                                <div style="width: 20.5%; position: relative; padding: 30px 5px 30px 30px;">
                                <div class="ima" style="height: 120px; width: 180px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                    <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($fimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                                </div>
                                <a href="main.php?q=0&step=4&fid='.$ffid.'&fname='.$ffname.'" target="_blank" class="link"><span class="wlink" style="height: 77%;"></span>'.$ffname.'</a>
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
                                echo '<a href="" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Remove</a>';
                                echo '</div>';
                        }
                        else
                        {
                            echo '<p style="padding-right: 10px; padding-left: 10px; margin-top: auto; margin-bottom: auto; font-size: 34px; color: #919191;">+</p>
                            <div style="width: 20.5%; position: relative; padding: 30px 5px 30px 30px; filter: grayscale(1);" title="Unavailable">
                            <div class="ima" style="height: 120px; width: 180px; margin: 0 0 10px 0; margin-left: auto; margin-right: auto;">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($fimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div>
                            <a href="main.php?q=0&step=4&fid='.$ffid.'&fname='.$ffname.'" target="_blank" class="link"><span class="wlink" style="height: 77%;"></span>'.$ffname.'</a>
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
                            echo '<a href="" class="btn" style="margin-top: 10px; width: 100%; color: #FFFFFF; background: #ff0f0f;">Remove</a>';
                            echo '</div>';
                        }
                    }
                }
                echo '</div>
                        </div>
                        <div class="addbt tq">
                            <form name="form" action="update.php?q=addbt&hid='.$uid.'&fid='.$fid.'" method="POST" enctype="multipart/form-data" style="width: 35%; height: unset;">
                                <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; height: 100%;">
                                    <div style="width: 90%; margin: auto; text-align: center;">
                                    <h2 style="text-align: center; font-size: 30px; padding-top: 10px;">Edit</h2>
                                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 1%;">Bought Together Foods:</label>
                                        <select id="type" name="type" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin: 0 0 25px 0; font-size:14px; letter-spacing:1px;">
                                            <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>';
                                            $q6 = mysqli_query($conn, "Select * from items where hid='$uid'") or die('Error');
                                            while ($row = mysqli_fetch_array($q6))
                                            {
                                                $fname = $row['fname'];
                                                $fidd = $row['fid'];
                                                $fitno = $row['fitno'];
                                                if ($fidd != $fid)
                                                {
                                                    echo '<option value="'.$fidd.'" style="background:#fff;color:#000;font-size:16px;">'.$fname.'</option>';
                                                }
                                            }
                                            echo '</select>
                                        <input class="sub btn" type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                            <img src="images/close.png" onclick="fogle();">
                        </div>
                        <div style="font-size: 18px;font-weight: 600;text-transform: uppercase;text-align: center;margin-bottom: 10px; padding: 15px 0 0 0;">
                            <a href="" class="sub btn" style="border-radius:0px;border:none;padding:10px;height:40px;color:#fff;font-size:14px;letter-spacing:1px;font-weight:500;background:#ff890f;text-transform:none;max-width:150px;">Check Sale</a>
                            <a href="main.php?q=2" class="sub btn" style="border-radius:0px;border:none;padding:10px;height:40px;color:#fff;font-size:14px;letter-spacing:1px;font-weight:500;background:#5eff0c;text-transform:none;max-width:150px;margin-left:5px;">Edit Item</a>
                        </div>
                        </div>';
    }
}
?>

</div>
</div>
</div>

<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 0 && (@$_GET['step']== 5) && (@$_GET['hid']) && (@$_GET['oid']))
{
    $hid = @$_GET['hid'];
    $oid = @$_GET['oid'];
    
        
    echo '<h1 style="font-size: 30px; font-weight: 600; text-align: center; padding: 0 0 20px 0;">Order Summary</h1>';
    $q4 = mysqli_query($conn, "select * from buynow where hid='$hid' and status='TXN_SUCCESS' and oid='$oid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q4))
    {
        $uid = $row['uid'];
        $qa4 = mysqli_query($conn, "select * from uinfo where uid='$uid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qa4))
        {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $pcde = $row['pincode'];
            $city = $row['city'];
            $address = $row['address'];
        }
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
        </div>';

    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
        <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';

    $q4 = mysqli_query($conn, "select * from buynow where hid='$hid' and status='TXN_SUCCESS' and oid='$oid'") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q4))
    {
        $fid = $row['fid'];
        $qty = $row['qty'];
        $amount = $row['amount'];

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
                            <h1><a href="main.php?q=0&step=4&fid='.$fid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="width: 83%;"></span>'.$afname.'</a></h1>
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
        echo '</div>';
        echo '</div>';
        echo '<div style="display: block;">Quantity<p style="text-align: center; width: 70px; height: fit-content; background: #fff; padding: 3px; border: 1px solid #efeaea;">'.$qty.'</p></div>
        </div>';
    }
    echo '</div>';
    $qrp = 0;
    $qkrp = 0;
    $qdisc = 0;
    $tota = 0;
    $c = 0;
    // echo $hid;
    $q5 = mysqli_query($conn, "Select * from buynow where hid='$hid' and status='TXN_SUCCESS' and oid='$oid'") or die('Error');
    while ($row = mysqli_fetch_array($q5))
    {
        // echo 'Sagar';
        $fid = $row['fid'];
        $qty = $row['qty'];
        $q6 = mysqli_query($conn, "Select * from items where `fid`='$fid'") or die('Error');
        while ($row = mysqli_fetch_array($q6))
        {
            $fmrp = $row['mrp'];
            $fdisc = $row['discount'];
            $c++;
            // echo $fmrp.'<br>';

            $qkrp = $qkrp + ($fmrp * $qty);
            // echo $qkrp.'<br>';
            // echo $fmrp.'<br>'.$qty.'<br><br>';
            $qdisc = $qdisc + ($fdisc * $qty);
            $qtrp = ($qkrp - $qdisc) + 20;
            if ($fdisc != 0)
            {
                $famrp = ($fmrp - $fdisc) * $qty;
                $qrp = $qrp + $famrp;
                // echo $famrp.'<br>'.$qrp;
            }
            else
            {
                $afamrp = 0;
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
                        <p style="font-size: 20px; padding: 0 0 0 5px; "> ₹ 20</p>
                    </div>
                </div>
                <div style="font-weight: 500; padding: 20px 0 15px 0; display: flex; border-bottom: 2.9px dotted #ddd; justify-content: space-between;">
                    <p style="font-size: 20px;">Amount Payable</p>
                    <p style="font-size: 20px;"> ₹ '.$qtrp.'</p>
                </div>
            </div>
        </div>';
    echo '</div>';
    echo '</div>';


}
?>
</div>
</div>
</div>

<?php
if (@$_GET['q'] == 1  && !(@$_GET['step']))
{
    echo '<h2 style="text-align: center;font-size: 30px; margin-top: 0; position:relative;">Enter Food Item</h2>
            <div class="formBx" style="padding-top:3%; padding-bottom:5%; padding-right:0; padding-left:0;">
                <form name="form" action="update.php?q=additem&uid='. $uid .'&store='. $store .'" method="POST" enctype="multipart/form-data">

                    <div class="panel" style="padding:15px 0 25px 0;">

                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Type</label>

                        <select id="type" name="type" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">

                            <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>

                            <option value="Snack" style="background:#fff;color:#000;font-size:16px;">Snack</option>
                            
                            <option value="Munchies" style="background:#fff;color:#000;font-size:16px;">Munchies</option>

                            <option value="Dairy, Bread and Eggs" style="background:#fff;color:#000;font-size:16px;">Dairy, Bread and Eggs</option>
                            
                            <option value="Tea, Coffee and Health Drinks" style="background:#fff;color:#000;font-size:16px;">Tea, Coffee and Health Drinks</option>
                            
                            <option value="Cold Drinks and Juices" style="background:#fff;color:#000;font-size:16px;">Cold Drinks and Juices</option>
                            
                            <option value="Sauces and Spreads" style="background:#fff;color:#000;font-size:16px;">Sauces and Spreads</option>

                        </select>

                    </div>

                    <div class="panel" style="padding:15px 0 25px 0;">

                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Select Image File: </label>
                        
                        <input type="file" name="image" required=""  style="width:93%; background:#deefff; padding:15px;">
                    
                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Food Item No :</label>

                        <input id="fitno" name="fitno" placeholder="Enter the Food Item No" type="text" required="" autocomplete="off" title="Enter the Food Item No" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Name of Food</label>

                        <input id="fname" name="fname" placeholder="Enter the Name of The Food" type="text" required="" autocomplete="off" title="Enter the Name of The Food" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Description</label>

                        <textarea rows="3" cols="5" name="desc" placeholder="Enter the Description" autocomplete="off" title="Enter the Description" style="width:93%; background:#deefff;"></textarea>

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Net Weight :</label>

                        <input id="netwt" name="netwt" placeholder="Enter the Net Weight of the Food" type="text" required="" autocomplete="off" title="Enter the Net Weight of the Food" style="width:93%; background:#deefff;">

                        <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Write Using Approx if the weight is not Knowned">*Write Using Approx if the weight is not Knowned</p>

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">M.R.P</label>

                        <input id="mrp" name="mrp" placeholder="Enter the Price of Food in Rupees" type="number" required="" autocomplete="off" title="Enter the Price of Food in Rupees" style="width:93%; background:#deefff;">

                        <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Enter the Actual MRP of the Product it means if you have a product of 100rs and 10rs off on that product than enter 100 in the box abovs">*Enter the Actual MRP</p>

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Discount</label>

                        <input id="dis" name="dis" placeholder="Enter the Discount in Rupees" type="number" required="" autocomplete="off" title="Enter the Discount in Rupees" style="width:93%; background:#deefff;">

                        <p style="cursor: context-menu; color: #ff0000; font-size: 0.8rem; text-align: start; padding: 0 4%;" title="Enter the Amount Off on the Product it means if you have a product of 100rs and 10rs off on that product than enter 10 in the box above">*Enter the Amount OFF on the Product</p>

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Important Note</label>

                        <input id="inote" name="inote" placeholder="Enter the Important Note About This Food Item" type="text" required="" autocomplete="off" title="Enter Anything About The Food Item That May Be Allergic To People Or Anything That Is Good To Have With This Food Item" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Ingredients</label>

                        <input id="ingden" name="ingden" placeholder="Enter the Ingredients" type="text" required="" autocomplete="off" title="Enter the Ingredients" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">In The Box</label>

                        <input id="ibox" name="ibox" placeholder="Enter the Items Inside Box" type="text" required="" autocomplete="off" title="Enter the Items Inside Box" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">No. Of Items Deliverable</label>

                        <input id="ditm" name="ditm" placeholder="Enter the Items That Can Be Delivered At Once" type="number" required="" autocomplete="off" title="Enter the Items That Can Be Delivered At Once" style="width:93%; background:#deefff;">

                    </div>

                    <div class="panel" style="padding:15px 0 15px 0;">

                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 4%;">Frequently Bought Together Foods:</label>
    
                        <select id="ftype" name="ftype" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin: 0 0 25px 0; font-size:14px; letter-spacing:1px;">
    
                            <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>';

                            $q6 = mysqli_query($conn, "Select * from items where hid='$uid'") or die('Error');
                            while ($row = mysqli_fetch_array($q6))
                            {
                                $fname = $row['fname'];
                                $fidd = $row['fid'];
                                $fitno = $row['fitno'];
                                if ($fidd != $fid)
                                {
                                    echo '<option value="'.$fidd.'" style="background:#fff;color:#000;font-size:16px;">'.$fname.'</option>';
                                }
                            }

                        echo '</select>

                    </div>
                    <div class="panel" style="padding:15px 0 15px 0;">

                        <label style="display: flex; margin: 0 0 1rem 0; color:#000; padding: 0 0 0 4%;">Bought Together Foods:</label>
    
                        <select id="btype" name="btype" placeholder="Choose the Type of Food" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin: 0 0 25px 0; font-size:14px; letter-spacing:1px;">
    
                            <option value="Snack" style="background:#fff;color:#000;font-size:16px  ;">Select the Type of Food</option>';

                            $q6 = mysqli_query($conn, "Select * from items where hid='$uid'") or die('Error');
                            while ($row = mysqli_fetch_array($q6))
                            {
                                $fname = $row['fname'];
                                $fidd = $row['fid'];
                                $fitno = $row['fitno'];
                                if ($fidd != $fid)
                                {
                                    echo '<option value="'.$fidd.'" style="background:#fff;color:#000;font-size:16px;">'.$fname.'</option>';
                                }
                            }

                        echo '</select>

                    </div>

                    <a onclick="cancel()" class="sub btn" style="border-radius:0px;border:none;width:100px;height:40px;padding:10px;background:#ff6767;text-transform:none;">Cancel</a>
                    <script>
                        function cancel()
                        {
                            var data = prompt("Are You Sure You Want to go Back\nNo Food Item will be Added if you Click on Ok", "Yes");
                            if (data == "yes" || data == "Yes" || data == "YES")
                            {
                                window.location ="main.php?q=2";
                            }
                        }
                    </script>

                    <input class="sub" type="submit" value="Submit" style="margin-top: 20px;"/>
                </form>
            </div>';
}
?>
<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 2 && !(@$_GET['step']))
{
    // $fname   = $_POST['fname'];
    $uid = $_SESSION['uid'];
    $q3      = mysqli_query($conn, "select * from `items`") or die("No Duty Details Added, Error Ask Sagar");
    $c = 1;
    echo '<h2 style="padding: 10px 0;">Select the Item: </h2>';
    echo '<div style="display: inline-block; width: 1190px;">';
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
        $fname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        // $ = $row[''];
        
        
        if ($hid == $_SESSION['uid'])
        {
            $amrp = $mrp - $disc;
            $q68 = mysqli_query($conn, "Select count(fid) as tot from questions where fid='$fid' and qans='Unanswered'") or die('Error');
            while ($row = mysqli_fetch_array($q68))
            {
                $tot = $row['tot'];
            }
            echo '<div class="itm" style="position: relative;">';
                    if ($tot != 0)
                    {
                        echo '<p class="tot">'.$tot.'<span>Question</span></p>';
                    }
                    else
                    {
                        echo '<p></p>';
                    }
                    

                echo'<div class="ima">
                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                    </div> 
                    <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                    <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                    <h1><a href="main.php?q=0&step=3&fid='.$fid.'&type='.$type.'&netwt='.$netwt.'&fname='.$fname.'&fitno='.$fitno.'&desc='.$desc.'&mrp='.$mrp.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
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
                    if ($avi == "Available")
                    {
                        echo '<a href="update.php?q=unavi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:#ff0000;text-transform: uppercase;text-align: center; width: 100%;" title="It is Unavailable">Unavailable</a>';
                    }
                    else
                    {
                        echo '<a href="update.php?q=avi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:darkgreen;text-transform: uppercase;text-align: center; width: 100%;" title="Make it Available">Available</a>';
                    }
                    echo '<div class="fl">
                            <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                        </div>
                        <a href="main.php?q=0&step=4&fid='.$fid.'" class="btn" style="margin-top: 10px; width: 100%; color: #000; background: #ffd334;">View Item</a>
                    </div>';
        }
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
        // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
        // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>

    }
    echo '</div';
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 4 && !(@$_GET['step']))
{
    // $fname   = $_POST['fname'];
    $uid = $_SESSION['uid'];
    $q3      = mysqli_query($conn, "select * from `items`") or die("No Duty Details Added, Error Ask Sagar");
    $c = 1;
    echo '<h2 style="padding: 10px 0;">Select The Item To Remove: </h2>';
    echo '<div style="display: inline-block; width: 1190px;">';
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
        $fname = $row['fname'];
        $mrp = $row['mrp'];
        $disc = $row['discount'];
        $avi = $row['availability'];
        // $ = $row[''];
        
        
        if ($hid == $_SESSION['uid'])
        {
            $amrp = $mrp - $disc;
            $q68 = mysqli_query($conn, "Select count(fid) as tot from questions where fid='$fid' and qans='Unanswered'") or die('Error');
            while ($row = mysqli_fetch_array($q68))
            {
                $tot = $row['tot'];
            }
            echo '<div class="itm" style="position: relative;">';
                    if ($tot != 0)
                    {
                        echo '<p class="tot">'.$tot.'<span>Question</span></p>';
                    }
                    else
                    {
                        echo '<p></p>';
                    }
                    

                echo'<div class="ima">
                        <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($image); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                    </div> 
                    <p style="padding-top: 10px; color: #9b9b9b; font-size: 0.68rem;">From '.$hname.'</p>
                    <p style="color: #9b9b9b; font-size: 0.9rem;">'.$type.'</p>
                    <h1><a href="update.php?q=rem&fid='.base64_encode($fid).'&uid='.base64_encode($uid).'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 66%;"></span>'.$fname.'</a></h1>
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
                    if ($avi == "Available")
                    {
                        echo '<a href="update.php?q=unavi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:#ff0000;text-transform: uppercase;text-align: center; width: 100%;" title="It is Unavailable">Unavailable</a>';
                    }
                    else
                    {
                        echo '<a href="update.php?q=avi&fid='.$fid.'" class="btn" style="margin-top: 10px;color:#FFFFFF;background:darkgreen;text-transform: uppercase;text-align: center; width: 100%;" title="Make it Available">Available</a>';
                    }
                    echo '<div class="fl">
                            <button class="collapsible btn" style="background: #2700ff; padding: 9px 12px; margin: 10px 0 0 0;">View Details</button>
                            <div class="content"><p style="padding: 10px 0 10px 0;">'.$desc.'</p></div>
                        </div>
                        <a href="main.php?q=0&step=3&fid='.$fid.'&type='.$type.'&netwt='.$netwt.'&fname='.$fname.'&fitno='.$fitno.'&desc='.$desc.'&mrp='.$mrp.'" class="btn" style="margin-top: 10px; width: 100%; color: #000; background: #ffd334;">View Item</a>
                    </div>';
        }
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:darkgreen;">&nbsp;Enable</a>
        // <a class="btn" style="margin:0px;color:#FFFFFF;background:#ff8c00;">Show Result</a>
        // <a class="btn" style="margin:0px;color:#000000;background:greenyellow;">Hide Result</a>
        // <a class="btn" style="margin:0px;background: #2700ff;color:white;text-decoration:none;">View Questions</a>

    }
    echo '</div';
}
?>
</div><!-- "ds" -->
</div><!-- "rew" -->
</div><!--"cont"-->

<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 8 && !(@$_GET['step']))
{
    echo '<div style="background-color: #fff; padding: 20px; margin: 0 0 30px 0;">
    <h1 style="font-size: 30px; font-weight: 600; text-align: center;">Order History</h1>
    <div style="margin: 20px 0 0 0; box-sizing: border-box; border-radius: 2px; border: 1px solid #ddd;">';
    
    $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid order by Serial_no") or die("No Items Details Fetched, Error Ask Sagar");
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
            $fhid = $row['hid'];
            $try = $fnam;
            $c = 1;
            $q49 = mysqli_query($conn, "select * from buynow where oid='$oid' and status='TXN_SUCCESS' and hid='$uid'") or die("No Items Details Fetched, Error Ask Sagar");
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
                        <h1><a href="main.php?q=0&step=5&hid='.$fhid.'&oid='.$oid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 50%;"></span>'.$try.'</a></h1>
                        <form name="form" id="formbv" action="update.php?q=costat&oid='.$koid.'" method="POST" enctype="multipart/form-data" style="width: 100%; padding: 40px 0 0 0;">
                            <div class="panel" style="margin: 0;">
                                <label style="display: flex; margin: 8px 0 0 0; color: #000;">Order Status</label>
                                <select id="type" name="type" placeholder="Choose the Type of Food" required="" style="position:relative; width: 100%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;" onchange="this.form.submit()">
                                    <option value="Being ready" style="background:#fff;color:#000;font-size:16px  ;">Select the Status of Order</option>
                                    <option value="Ordered" style="background:#fff;color:#000;font-size:16px;">Ordered</option>
                                    <option value="Being Ready" style="background:#fff;color:#000;font-size:16px;">Being Ready</option>
                                    <option value="Order Ready" style="background:#fff;color:#000;font-size:16px;">Order Ready</option>
                                    <option value="Out For Delivery" style="background:#fff;color:#000;font-size:16px;">Out for Delivery</option>
                                    <option value="Delivered" style="background:#fff;color:#000;font-size:16px;">Delivered</option>
                                </select>
                            </div>
                        </form>
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
</div>
</div>
</div>

<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 9 && !(@$_GET['step']))
{
    echo'<form action="update.php?q=catg" method="post" enctype="multipart/form-data">
        <input type="text" name="cagt">
        <label>Select Image File:</label>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload">
        </form>';
}
?>
</div>
</div>
</div>
<div class="cont" style="margin-top: 0;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 11 && !(@$_GET['step']))
{
    echo '<div onload="table();">
    <script type="text/javascript">
      function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "update.php?q=try");
        xhttp.send();
      }

      setInterval(function(){
        table();
      }, 5000);
    </script>
    <div id="table">

    </div>
    </div>';
}
?>
</div>
</div>
</div>
</section>



<?php include 'nav/_footer.php';?>
<!-- <script>
function table()
{
    const xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        document.getElementById("table").innerHTML = this.responseText;
    }

    xhttp.open("GET", "system.php");
    xhttp.send();
}
</script> -->
<script>
function myFunction()
{
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function questrem()
{
    document.getElementById("questrem").style.display = 'none';
}

function toggle()
{
	var trailer = document.querySelector(".cima");
	trailer.classList.toggle("active");
}
function foggle()
{
	var trailer = document.querySelector(".inote");
	trailer.classList.toggle("active");
}
function fogggle()
{
	var trailer = document.querySelector(".spec");
	trailer.classList.toggle("active");
}
function togggle()
{
	var trailer = document.querySelector(".addfb");
	trailer.classList.toggle("active");
}
function togle()
{
	var trailer = document.querySelector(".eque");
	trailer.classList.toggle("active");
}
function fogle()
{
	var trailer = document.querySelector(".addbt");
	trailer.classList.toggle("active");
}
function myfunk()
{
  document.getElementById("formbv").submit();
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
<?php
// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>

</body>
</html>

<!-- Main Duty Details Page -->
<!-- <h2 style="text-align: center;font-size: 30px; margin-top: 0; position:relative;">Enter Duty Details</h2>
                <div class="formBx" style="padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                    <form name="form" action="update.php?q=addduty" method="POST">
                        
                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">General Information</label>
                            
                            <input id="date" name="date" placeholder="Enter the Date"  type="date" required="" autocomplete="off" title="Enter the Date" style="width:93%; background:#deefff;">

                            <input id="cname" name="cname" placeholder="Enter Company Name"  type="text" required="" autocomplete="off" title="Enter the Company Name" style="width:93%; background:#deefff;">

                            <input id="carname" name="carname" placeholder="Enter the Car Name, Car Number"  type="text" required="" autocomplete="off" title="Enter the Car Name, Car Number" style="width:93%; background:#deefff;">
                            
                            <input id="gname" name="gname" placeholder="Enter the Guest Name"  type="text" required="" autocomplete="off" title="Enter the Guest Name" style="width:93%; background:#deefff;">                        

                        </div>
                        
                        <div class="panel" style="padding:15px 0 15px 0;">
    
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Local / Out Station</label>

                            <select id="ans" name="ans" placeholder="Choose correct answer " required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">

                                <option value="local" style="background:#fff;color:#000;font-size:16px;">Select the Type of Duty</option>
                                
                                <option value="local" style="background:#fff;color:#000;font-size:16px;">Local</option>

                                <option value="out" style="background:#fff;color:#000;font-size:16px;">Out Station</option>
                            
                            </select>
                        </div>

                        <div class="panel" style="padding:15px 0 15px 0;">

                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Kilometers</label>

                            <input id="skm" name="skm" placeholder="Enter the Starting Kilometers"  type="number" required="" autocomplete="off" title="Enter the Starting Kilometers" style="width:93%; background:#deefff;">

                            <input id="ckm" name="ckm" placeholder="Enter the Closing Kilometers"  type="number" required="" autocomplete="off" title="Enter the Closing Kilometers" style="width:93%; background:#deefff;">

                            <input id="tkm" name="tkm" placeholder="Enter Total Kilometers"  type="number" required="" autocomplete="off" title="Enter the Total Kilometers" style="width:93%; background:#deefff;">

                            <input id="ekm" name="ekm" placeholder="Enter the Extra Kilometers"  type="number" required="" autocomplete="off" title="Enter the Extra Kilometers" style="width:93%; background:#deefff;">

                        </div>
                
                        <div class="panel" style="padding:15px 0 15px 0;">
                        
                            <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Time</label>

                            <input id="stime" name="stime" placeholder="Enter the Starting Time"  type="number" required="" autocomplete="off" title="Enter the Starting Time" style="width:93%; background:#deefff;">

                            <input id="ctime" name="ctime" placeholder="Enter the Closing Time"  type="number" required="" autocomplete="off" title="Enter the Closing Time" style="width:93%; background:#deefff;">

                            <input id="ttime" name="ttime" placeholder="Enter the Total Time"  type="number" required="" autocomplete="off" title="Enter the Total Time" style="width:93%; background:#deefff;">

                            <input id="etime" name="etime" placeholder="Enter the Extra Hours"  type="number" required="" autocomplete="off" title="Enter the Extra Hours" style="width:93%; background:#deefff;">

                        </div> -->


<!-- day by day record for local if booked for one day and for many days recor in one single for local -->
<!-- and outstataion sathi alag -->
