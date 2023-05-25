<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/user.png" type="image/icon" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Welcome</title>
</head>
<body style="background:#eee;">
<?php include 'nav/_dbconnect.php'; ?>
<?php include 'loading.php'; ?>
<section class="tip">
<div class="cont">
<div class="rew">
<div class="ds">
<?php

if (@$_GET['q'] == 4 && !(@$_GET['step']))
{
    $q3      = mysqli_query($conn, "select * from company") or die("No Duty Details Added, Error Ask Sagar");
    echo '<div class="panel" style="margin: 30px 0 0 0;">
            <div class="fl" style="padding: 20px 30px; color: #000;;">';
    while ($row = mysqli_fetch_array($q3))
    {
                            
        $cmname   = $row['cname'];
        $kid      = $row['eid'];
        
        echo '<button class="collapsible cap">'.$cmname.'</button>
            <div class="content" style="min-height: fit-content;">';
            $result = mysqli_query($conn, "Select * from bills where cname='$cmname' and status='UnPaid'") or die('Error');
            echo '<div class="search" style="position:relative; display:flex; transition:0.5s; padding:20px 0 0 0;">
                    <div class="fl" style="padding:0 30px; width:13.5cm;">
                        <button class="collapsible" style="background:linear-gradient(267deg,#E91E63,#03A9F4);">Search by Date</button>
                        <div class="content">
                            <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                                <form name="form" action="try.php?q=4&step=1&cname='.$cmname.'" method="POST" style="width:100%;">
                                    <input id="sdate" name="sdate" placeholder="Enter the Start Date"  type="date" required="" autocomplete="off" title="Enter the Start Date">
                                    <input id="cdate" name="cdate" placeholder="Enter the End Date"  type="date" required="" autocomplete="off" title="Enter the End Date">
                                    <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="fl" style="padding:0 30px; width:13.5cm;">
                        <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Client Name</button>
                        <div class="content">
                            <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                                <form name="form" action="try.php?q=4&step=2&cname='.$cmname.'" method="POST" style="width:100%;">
                                    <input id="gname" name="gname" placeholder="Search By Client Name"  type="text" required="" autocomplete="off" title="Search By Client Name">
                                    <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="panel" style="margin:30px 0 20px 0;">
                    <div style="display: block; width:98.6%; overflow-x: auto;">
                        <table class="tap tap-string" style="vertical-align:middle; min-width: max-content; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
                            <tr>
                                <td style="vertical-align:middle"><b>Date</b></td>
                                <td style="vertical-align:middle"><b>Company Name</b></td>
                                <td style="vertical-align:middle"><b>Duty Type</b></td>
                                <td style="vertical-align:middle"><b>Car Name</b></td>
                                <td style="vertical-align:middle"><b>Starting Km</b></td>
                                <td style="vertical-align:middle"><b>Closing Km</b></td>
                                <td style="vertical-align:middle"><b>Starting Time</b></td>
                                <td style="vertical-align:middle"><b>Closing Time</b></td>
                                <td style="vertical-align:middle"><b>Total Km</b></td>
                                <td style="vertical-align:middle"><b>Total Time</b></td>
                                <td style="vertical-align:middle"><b>Extra Km</b></td>
                                <td style="vertical-align:middle"><b>Extra Time</b></td>
                                <td style="vertical-align:middle"><b>Driver</b></td>
                                <td style="vertical-align:middle"><b>Toll & Parking</b></td>
                                <td style="vertical-align:middle"><b>Guest Name</b></td>
                                <td style="vertical-align:middle"><b>Amount</b></td>
                                <td style="vertical-align:middle"><b></b></td>
                                <td style="vertical-align:middle"><b></b></td>
                                <td style="vertical-align:middle"><b></b></td>
                                <td style="vertical-align:middle"><b></b></td>';

                                while ($row = mysqli_fetch_array($result))
                                {
                                                        
                                    $eid     = $row['eid'];
                                    $date    = $row['date'];
                                    $cname   = $row['cname'];
                                    $dtype   = $row['type'];
                                    $bno   = $row['bno'];
                                    $carname = $row['carname'];
                                    $carno   = $row['carno'];
                                    $skm     = $row['skm'];
                                    $ckm     = $row['ckm'];
                                    $stime   = $row['stime'];
                                    $ctime   = $row['ctime'];
                                    $tkm     = $row['tkm'];
                                    $ttime   = $row['ttime'];
                                    $ekm     = $row['ekm'];
                                    $etime   = $row['etime'];
                                    $toll    = $row['toll'];
                                    $park    = $row['parking'];
                                    $dname   = $row['dname'];
                                    $gname   = $row['gname'];
                                    $amount  = $row['amount'];
                                    $tamount = $row['tamount'];
                                    // $just = $row['uid'];
                                    
                                    // if ($just == $_SESSION['uid'])
                                    // {
                                        // <td style="vertical-align:middle">' . $c++ . '</td>
                                        
                                        $date = strtotime($date);
                                        $date = date("d-m-Y", $date);

                                        echo '<tr>
                                                <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                                                <td style="vertical-align:middle;">' . $cname . '</td>
                                                <td style="vertical-align:middle;">' . $dtype . '</td>
                                                <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                                                <td style="vertical-align:middle;">' . $skm . '</td>
                                                <td style="vertical-align:middle;">' . $ckm . '</td>
                                                <td style="vertical-align:middle;">' . $stime . '</td>
                                                <td style="vertical-align:middle;">' . $ctime . '</td>
                                                <td style="vertical-align:middle;">' . $tkm . '</td>
                                                <td style="vertical-align:middle;">' . $ttime . '</td>
                                                <td style="vertical-align:middle;">' . $ekm . '</td>
                                                <td style="vertical-align:middle;">' . $etime . '</td>
                                                <td style="vertical-align:middle;">' . $dname . '</td>
                                                <td style="vertical-align:middle;">'.$toll .'Toll</br>' . $park.'Parking</td>
                                                <td style="vertical-align:middle;">' . $gname . '</td>
                                                <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                                                <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid='. $eid .'&sign=unsigned" class="btn" style="margin: 0px; background: #c90027; color: #fff; text-decoration: none;">View Bill</a></td>
                                                <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid=616573af03a8d&sign=signed" class="btn" style="margin: 0px; background: #ff6a00; color: #fff; text-decoration: none;">View Signed Bill</a></td>
                                                <td style="vertical-align:middle"><a href="update.php?q=bpaid&bno='.$bno.'" class="btn" style="margin: 0px; background: #d2f801; color: #fff; text-decoration: none;">Paid</a></td>
                                                <td style="vertical-align:middle"><a href="try.php?q=6&step=0&cid='. $kid .'" class="btn" style="margin: 0px; background: #23005b; color: #fff; text-decoration: none;">Log Sheet</a></td>'; 
                                            echo '</tr>';
                                    }
                            echo '</table>
                        </div>';
                        
                        $resu = mysqli_query($conn, "SELECT *,SUM(tamount) FROM bills where status='UnPaid' GROUP BY cname") or die('Error');
                        while ($row = mysqli_fetch_array($resu))
                        {
                            if ($row['cname'] == $cname)
                            {
                                $s = $row['SUM(tamount)'];
                                echo '<div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rup.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$s.'</h3></div></div>';
                            }
                        }
                    echo'</div>
                </div>';

    }
    echo' <div style="font-size: 18px;font-weight: 600;text-transform: uppercase;text-align: center;margin-bottom: 10px; padding: 15px 0 0 0;">
        <a onclick="mbill()" class="sub btn" style="border-radius:0px;border:none;padding:10px;height:40px;color:#fff;font-size:14px;letter-spacing:1px;font-weight:500;background:#5eff0c;text-transform:none;max-width:150px;margin-left:5px;">Make an Bill</a>
        <script>
            function mbill()
            {
                var data = prompt("By Making A Bill Like This The Records Will Not Be Saved In The Database\nAlthough You Can Download The Bill Or Print It", "Ok");
                if (data == "Ok" || data == "ok" || data == "OK")
                {
                    window.location ="try.php?q=4&step=3";
                }
            }
        </script>
    </div>';
}
?>
</div>
</div>
</div>
</div>
<!-- </div> -->

<div class="cont" style="margin-top:-3.0vh;">
<div class="rew">
<div class="ds">
<?php
if (@$_GET['q'] == 4 && (@$_GET['step']== 1) && (@$_GET['cname']))
{
    $sdate = $_POST['sdate'];
    $cdate = $_POST['cdate'];
    $cname = @$_GET['cname'];

    $q3 = mysqli_query($conn, "select * from `bills` where date between '$sdate' and '$cdate' and cname ='$cname'") or die("No Duty Details Added, Error Ask Sagar");

    echo '<div class="panel" style="margin:30px 0 0 0;">
    <div style="display: block; width:98.6%; overflow-x: auto;">
        <table class="tap tap-string" style="vertical-align:middle; min-width: max-content; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
            <tr>
                <td style="vertical-align:middle"><b>Date</b></td>
                <td style="vertical-align:middle"><b>Company Name</b></td>
                <td style="vertical-align:middle"><b>Duty Type</b></td>
                <td style="vertical-align:middle"><b>Car Name</b></td>
                <td style="vertical-align:middle"><b>Starting Km</b></td>
                <td style="vertical-align:middle"><b>Closing Km</b></td>
                <td style="vertical-align:middle"><b>Starting Time</b></td>
                <td style="vertical-align:middle"><b>Closing Time</b></td>
                <td style="vertical-align:middle"><b>Total Km</b></td>
                <td style="vertical-align:middle"><b>Total Time</b></td>
                <td style="vertical-align:middle"><b>Extra Km</b></td>
                <td style="vertical-align:middle"><b>Extra Time</b></td>
                <td style="vertical-align:middle"><b>Driver</b></td>
                <td style="vertical-align:middle"><b>Toll & Parking</b></td>
                <td style="vertical-align:middle"><b>Guest Name</b></td>
                <td style="vertical-align:middle"><b>Amount</b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>';

            while ($row = mysqli_fetch_array($q3))
            {
                                    
                $eid     = $row['eid'];
                $date    = $row['date'];
                $cname   = $row['cname'];
                $dtype   = $row['type'];
                $bno     = $row['bno'];
                $carname = $row['carname'];
                $carno   = $row['carno'];
                $skm     = $row['skm'];
                $ckm     = $row['ckm'];
                $stime   = $row['stime'];
                $ctime   = $row['ctime'];
                $tkm     = $row['tkm'];
                $ttime   = $row['ttime'];
                $ekm     = $row['ekm'];
                $etime   = $row['etime'];
                $toll    = $row['toll'];
                $park    = $row['parking'];
                $dname   = $row['dname'];
                $gname   = $row['gname'];
                $amount  = $row['amount'];
                $tamount = $row['tamount'];
                $status  = $row['status'];
                // $just = $row['uid'];
                
                // if ($just == $_SESSION['uid'])
                // {
                    // <td style="vertical-align:middle">' . $c++ . '</td>
                   
                   $date = strtotime($date);
                   $date = date("d-m-Y", $date);

                    echo '<tr>
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">' . $cname . '</td>
                            <td style="vertical-align:middle;">' . $dtype . '</td>
                            <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                            <td style="vertical-align:middle;">' . $skm . '</td>
                            <td style="vertical-align:middle;">' . $ckm . '</td>
                            <td style="vertical-align:middle;">' . $stime . '</td>
                            <td style="vertical-align:middle;">' . $ctime . '</td>
                            <td style="vertical-align:middle;">' . $tkm . '</td>
                            <td style="vertical-align:middle;">' . $ttime . '</td>
                            <td style="vertical-align:middle;">' . $ekm . '</td>
                            <td style="vertical-align:middle;">' . $etime . '</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">'.$toll .'Toll</br>' . $park.'Parking</td>
                            <td style="vertical-align:middle;">' . $gname . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                            <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid='. $eid .'&sign=unsigned" class="btn" style="margin: 0px; background: #c90027; color: #fff; text-decoration: none;">View Bill</a></td>
                            <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid='. $eid .'&sign=signed" class="btn" style="margin: 0px; background: #ff6a00; color: #fff; text-decoration: none;">View Signed Bill</a></td>';
                            if ($status == 'Paid')
                            {
                               echo'<td style="vertical-align:middle"><a href="#" class="btn" style="margin: 0px; background: #d2f801; color: #fff; text-decoration: none;">Paid</a></td>';
                            }
                            else
                            {
                               echo'<td style="vertical-align:middle"><a href="update.php?q=bpaid&bno='.$bno.'" class="btn" style="margin: 0px; background: #d2f801; color: #fff; text-decoration: none;">Paid</a></td>';   
                            }
                           echo'<td style="vertical-align:middle"><a href="try.php?q=6&step=0&eid='. $eid .'" class="btn" style="margin: 0px; background: #23005b; color: #fff; text-decoration: none;">Log Sheet</a></td>'; 
                       echo '</tr>';
            }
            echo '</table>
            </div>';
            
            $resu = mysqli_query($conn, "SELECT *,SUM(tamount) FROM bills where status='UnPaid' GROUP BY cname") or die('Error');
            while ($row = mysqli_fetch_array($resu))
            {
                if ($row['cname'] == $cname)
                {
                    $s = $row['SUM(tamount)'];
                    echo '<div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rup.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$s.'</h3></div></div>';
                }
            }
            echo'</div>
            </div>';
}


if (@$_GET['q'] == 4 && (@$_GET['step'] == 2) && (@$_GET['cname']))
{
    $gname = $_POST['gname'];
    $cname = @$_GET['cname'];

    $q3 = mysqli_query($conn, "select * from `bills` where gname ='$gname' and cname ='$cname'") or die("No Duty Details Added, Error Ask Sagar");

    echo '<div class="panel" style="margin:30px 0 0 0;">
    <div style="display: block; width:98.6%; overflow-x: auto;">
        <table class="tap tap-string" style="vertical-align:middle; min-width: max-content; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
            <tr>
                <td style="vertical-align:middle"><b>Date</b></td>
                <td style="vertical-align:middle"><b>Company Name</b></td>
                <td style="vertical-align:middle"><b>Duty Type</b></td>
                <td style="vertical-align:middle"><b>Car Name</b></td>
                <td style="vertical-align:middle"><b>Starting Km</b></td>
                <td style="vertical-align:middle"><b>Closing Km</b></td>
                <td style="vertical-align:middle"><b>Starting Time</b></td>
                <td style="vertical-align:middle"><b>Closing Time</b></td>
                <td style="vertical-align:middle"><b>Total Km</b></td>
                <td style="vertical-align:middle"><b>Total Time</b></td>
                <td style="vertical-align:middle"><b>Extra Km</b></td>
                <td style="vertical-align:middle"><b>Extra Time</b></td>
                <td style="vertical-align:middle"><b>Driver</b></td>
                <td style="vertical-align:middle"><b>Toll & Parking</b></td>
                <td style="vertical-align:middle"><b>Guest Name</b></td>
                <td style="vertical-align:middle"><b>Amount</b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>
                <td style="vertical-align:middle"><b></b></td>';

            while ($row = mysqli_fetch_array($q3))
            {
                                    
                $eid     = $row['eid'];
                $date    = $row['date'];
                $cname   = $row['cname'];
                $dtype   = $row['type'];
                $bno     = $row['bno'];
                $carname = $row['carname'];
                $carno   = $row['carno'];
                $skm     = $row['skm'];
                $ckm     = $row['ckm'];
                $stime   = $row['stime'];
                $ctime   = $row['ctime'];
                $tkm     = $row['tkm'];
                $ttime   = $row['ttime'];
                $ekm     = $row['ekm'];
                $etime   = $row['etime'];
                $toll    = $row['toll'];
                $park    = $row['parking'];
                $dname   = $row['dname'];
                $gname   = $row['gname'];
                $amount  = $row['amount'];
                $tamount = $row['tamount'];
                $status  = $row['status'];
                // $just = $row['uid'];
                
                // if ($just == $_SESSION['uid'])
                // {
                    // <td style="vertical-align:middle">' . $c++ . '</td>
                   
                   $date = strtotime($date);
                   $date = date("d-m-Y", $date);

                    echo '<tr>
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">' . $cname . '</td>
                            <td style="vertical-align:middle;">' . $dtype . '</td>
                            <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                            <td style="vertical-align:middle;">' . $skm . '</td>
                            <td style="vertical-align:middle;">' . $ckm . '</td>
                            <td style="vertical-align:middle;">' . $stime . '</td>
                            <td style="vertical-align:middle;">' . $ctime . '</td>
                            <td style="vertical-align:middle;">' . $tkm . '</td>
                            <td style="vertical-align:middle;">' . $ttime . '</td>
                            <td style="vertical-align:middle;">' . $ekm . '</td>
                            <td style="vertical-align:middle;">' . $etime . '</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">'.$toll .'Toll</br>' . $park.'Parking</td>
                            <td style="vertical-align:middle;">' . $gname . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                            <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid='. $eid .'&sign=unsigned" class="btn" style="margin: 0px; background: #c90027; color: #fff; text-decoration: none;">View Bill</a></td>
                            <td style="vertical-align:middle"><a href="try.php?q=5&step=0&eid='. $eid .'&sign=signed" class="btn" style="margin: 0px; background: #ff6a00; color: #fff; text-decoration: none;">View Signed Bill</a></td>';
                            if ($status == 'Paid')
                            {
                               echo'<td style="vertical-align:middle"><a href="#" class="btn" style="margin: 0px; background: #d2f801; color: #fff; text-decoration: none;">Paid</a></td>';
                            }
                            else
                            {
                               echo'<td style="vertical-align:middle"><a href="update.php?q=bpaid&bno='.$bno.'" class="btn" style="margin: 0px; background: #d2f801; color: #fff; text-decoration: none;">Paid</a></td>';   
                            }
                           echo'<td style="vertical-align:middle"><a href="try.php?q=6&step=0&eid='. $eid .'" class="btn" style="margin: 0px; background: #23005b; color: #fff; text-decoration: none;">Log Sheet</a></td>'; 
                       echo '</tr>';
            }
            echo '</table>
            </div>';
            
            $resu = mysqli_query($conn, "SELECT *,SUM(tamount) FROM bills where status='UnPaid' GROUP BY cname") or die('Error');
            while ($row = mysqli_fetch_array($resu))
            {
                if ($row['cname'] == $cname)
                {
                    $s = $row['SUM(tamount)'];
                    echo '<div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rup.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$s.'</h3></div></div>';
                }
            }
            echo'</div>
            </div>';
            
}
?>
</div>
</div>
</div>
<?php
if (@$_GET['q'] == 5 && !(@$_GET['step']) && @$_GET['sign'])
{
    $eid  = @$_GET['eid'];
    $sign = @$_GET['sign'];

    echo '<div style="background-color:#fff; margin: auto; width:22cm; height: 35.1cm;">
            <div class="ofl" style="display:flex; margin-top:-3vh; padding: 50px 20px 10px 20px;">
                <div class="ol" style="display:block;">
                    <h1 style="color: #ff0000;font-size: 40px;">Sai Darshan</h1>
                    <h2>Car Rental</h2>
                </div>
                <div class="om">
                    <h1>SD</h1>
                </div>
                <div class="ort">
                    <h5>A1/119 Sai Shraddha CHS,<br>I-Plot, Linking Road Extn, Near Best Quarterz,<br>Santacruz(West), Mumbai-400 054.<br>Mob : 9821215835/9222270130</h5>
                </div>
            </div>
            <hr class="less">
            <hr class="thicker">
            <div class="st" style="display: block; padding: 20px; font-size: large;">';
            $result = mysqli_query($conn, "Select * from bills where eid='$eid'") or die('Error');
            while ($row = mysqli_fetch_array($result))
            {
                                        
                $date     = $row['date'];
                $bno      = $row['bno'];
                $cname    = $row['cname'];
                $type     = $row['type'];
                $emoney   = $row['emoney'];
                $carname  = $row['carname'];
                $carno    = $row['carno'];
                $skm      = $row['skm'];
                $ckm      = $row['ckm'];
                $pkm      = $row['pkm'];
                $phour    = $row['phour'];
                $nda      = $row['nda'];
                $da       = $row['da'];
                $dacharge = $row['dacharge'];
                $stime    = $row['stime'];
                $ctime    = $row['ctime'];
                $tkm      = $row['tkm'];
                $ttime    = $row['ttime'];
                $ekm      = $row['ekm'];
                $etime    = $row['etime'];
                $book     = $row['bookedby'];
                $toll     = $row['toll'];
                $park     = $row['parking'];
                $dname    = $row['dname'];
                $gname    = $row['gname'];
                $amount   = $row['amount'];
                $tamount  = $row['tamount'];

                $date = strtotime($date);
                $date = date("d-m-Y", $date);

            }
            echo '<div style="display: flex; float: left;">Invoice No. <p style="padding: 0 10px 0 0; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$bno.'</p></div>
            <div style="display: flex; float: right;">Date: <p style="padding: 0 10px 0 0; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.date("d-m-Y").'</p></div><br>
            <div style="display: flex; padding-top: 20px;"> M/s : <p style="padding: 0 10px 0 0; color: #0024cf; width: 19.56cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$cname.'</p></div>
            <div style="display: flex; padding-top: 20px;"> Used By : <p style="padding: 0 10px 0 0; color: #0024cf; width: 18.56cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$gname.'</p></div>
            <div style="display: flex; padding-top: 20px; float: left;">Driver Name : <p style="padding: 0 10px 0 0; width: 8.5cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$dname.'</p></div>
            <div style="display: flex; padding-top: 20px; float: right;">Booked By: <p style="padding: 0 10px 0 0;  width: 6cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$book.'</p></div><br>
            <div style="display: flex; padding-top: 20px; float: left;">Car No : <p style="padding: 0 10px 0 0; width: 7.6cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$carname.' '.$carno.'</p></div>
            <div style="display: flex; padding-top: 20px; float: right;">Used From : <p style="padding: 0 10px 0 0;  width: 8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.$date.'</p></div><br>
            </div>';
            if($type == 'Local')
            {
                echo '<div style="display: block; padding: 20px;">
                        <table style="border: 1px solid black; vertical-align:middle; min-width: fit-content; margin-top: 2.5vh;margin-bottom:4.5vh;">
                            <tr style="border: 1px solid black;">
                                <td style="text-align: left; width: 9.9cm; padding: 3px 5px; border: 1px solid black;"><b>Type of Car /</b><b style="color: #0024cf; font-family: cursive;"> '.$carname.'</b></td>
                                <td style="vertical-align:middle; width: 4cm; border: 1px solid black;" colspan="2"><b>No. / Kms. Hrs</b></td>
                                <td style="vertical-align:middle; width: 3cm; border: 1px solid black;"><b>Rate</b></td>
                                <td style="vertical-align:middle; width: 4cm; border: 1px solid black;" colspan="2"><b>Amount</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Closing Reading <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$ckm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$ctime.'</b> Time</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Opening Reading <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$skm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$stime.'</b> Time</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Total <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$tkm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$ttime.'</b> Hours</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">1<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -8px;">&#10003;</b>Minimum 8hrs / 8Km. (A.C. /<b style="color:red; text-decoration:line-through;"><b style="color:black; font-weight: 400;"> Non A.C.</b></b> ) </td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">1</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$amount.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'. 1 * $amount.'</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                            </tr>';
                            
                            if($ekm != '00')
                            {
                                echo'<tr>
                                        <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">2<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Extra Kilo Meter</td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ekm.'</p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$pkm.'</p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ekm * $pkm.'</p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                    </tr>';
                            
                            }
                            else
                            {
                                echo'<tr>
                                        <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">2 Extra Kilo Meter</td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    </tr>';
                            }

                            if($etime != '00:00')
                            {
                                $eam = $tamount - ($toll + ($ekm * $pkm) + $amount); 
                                echo'<tr>
                                        <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">3<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Extra Hours</td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$etime.'</p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$phour.'</p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$emoney.'</p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                    </tr>';
                            
                            }
                            else
                            {
                                echo'<tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">3<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Extra Hours</td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$etime.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$phour.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$emoney.'</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                            </tr>';
                            }
                            echo '<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">4 Out Station (A.C. / Non A.C. ) </td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>';
                            if($da != '00')
                            {
                                echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">5<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Driver Allowance</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da.'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$dacharge.'</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da * $dacharge .'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;">~</td>
                                </tr>';
                            }
                            else
                            {
                                echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">5<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Driver Allowance</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da.'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$dacharge.'</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da * $dacharge .'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;">~</td>
                                </tr>';
                            }
                            echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">6 Overnight Detention Charges</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">7 Airport Transfer 4 Hrs. 40 Km</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>';

                                if($toll != '00' || $park != '00')
                                {
                                    echo'<tr>
                                            <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">8<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Parking Charges / Toll Tax</td>
                                            <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                            <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                            <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                            <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.($toll + $park).'</p></td>
                                            <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                        </tr>';
                                
                                }
                                else
                                {
                                    echo'<tr>
                                            <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">8 Parking Charges / Toll Tax</td>
                                            <td style="vertical-align:middle; border: 1px solid black;"></td>
                                            <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                            <td style="vertical-align:middle; border: 1px solid black;"></td>
                                            <td style="vertical-align:middle; border: 1px solid black;"></td>
                                            <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                        </tr>';
                                }
                                // <tr>
                                //     <td style="text-align: left; border: 1px solid black; padding: 3px 5px;"></td>
                                //     <td style="vertical-align:middle; border: 1px solid black;"></td>
                                //     <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                //     <td style="vertical-align:middle; border: 1px solid black;"></td>
                                //     <td style="vertical-align:middle; border: 1px solid black;"></td>
                                //     <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                // </tr>
                                echo '<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">9 Cancellation Charges</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">10 Lunch Allowance</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>';
                                $amount = AmountInWords($tamount);
                                echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;" rowspan="2">Rupees  <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '. $amount.' Only.</b></td>
                                    <td style="text-align: right; border: 1px solid black; padding: 3px 10px; height:32px;" colspan="2">Total</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tamount.'</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                </tr>

                                <tr>
                                    <td style="text-align: right; border: 1px solid black; padding: 3px 10px; height: 32px;" colspan="2">Service Tax</td>
                                    <td style="vertical-align:middle; border: 1px solid black;" colspan="1"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                    <td style="text-align: right; padding: 3px 10px; border: 1px solid black;" colspan="2">Net Total</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tamount.'</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                </tr>';

                    echo '</table>
                <div class="ofl" style="display:flex; margin-top:-3vh; padding: 10px 0;">
                <div class="ort">
                    <h5 style="width: 534px;">Terms:<br>(1) Interest @ 18% p.a will be charged on account not setteled within 15 days.<br>(2) No dispute or objection will be entertained if not brought out in notice within 7 days from the date of hereof.<br>(3) All Dispute subject to Mumbai Jurisdiction.<br>(4) All Cheques to be in the name of <b style="color: #ff0000; text-transform: uppercase;">Sai Darshan</b></h5>
                </div>

                <div class="ort" style="float: right; padding: 0 0 0 80px">
                    <h5 style="text-align: right;">E. O. & E.</h5>
                    <h3 style="color: #ff0000; letter-spacing: 1px;">For SAI DARSHAN</h3>';
                    if ($sign == 'signed')
                    {
                        echo '<img style="width: 150px;height: 75px; transform: rotate(5deg); margin: -10px 0px 0px 27px;" src="images/sign1.png" />
                            <h5 style="text-align: right; margin: -20px 0 0 0;">Proprietor</h5>';
                    }
                    else
                    {
                        echo '<h5 style="text-align: right; margin: 52px 0 0 0;">Proprietor</h5>';
                    }
                    echo'</div>
                        </div>
                            </div>';
            }

            else
            {
                echo '<div style="display: block; padding: 20px;">
                        <table style="border: 1px solid black; vertical-align:middle; min-width: fit-content; margin-top: 2.5vh;margin-bottom:4.5vh;">
                            <tr style="border: 1px solid black;">
                                <td style="text-align: left; width: 9.9cm; padding: 3px 5px; border: 1px solid black;"><b>Type of Car /</b><b style="color: #0024cf; font-family: cursive;"> '.$carname.'</b></td>
                                <td style="vertical-align:middle; width: 4cm; border: 1px solid black;" colspan="2"><b>No. / Kms. Hrs</b></td>
                                <td style="vertical-align:middle; width: 3cm; border: 1px solid black;"><b>Rate</b></td>
                                <td style="vertical-align:middle; width: 4cm; border: 1px solid black;" colspan="2"><b>Amount</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Closing Reading <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$ckm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$ctime.'</b> Time</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Opening Reading <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$skm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$stime.'</b> Time</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">Total <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '.$tkm.'</b> Kms. <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 5px 0 5px;"> '.$ttime.'</b> Hours</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">1 Minimum 8hrs / 8Km. (A.C. / Non A.C. ) </td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">2 Extra Kilo Meter</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">3 Extra Hours</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">4 <b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -16px;">&#10003;</b>Out Station (A.C. /<b style="color:red; text-decoration:line-through;"><b style="color:black; font-weight: 400;"> Non A.C.</b></b> ) </td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tkm.'</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$pkm.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'. $tkm * $pkm.'</p></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                            </tr>';
                            if($da != '00')
                            {
                                echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">5<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Driver Allowance</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da.'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">X</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$dacharge.'</p></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$da * $dacharge .'</p></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;">~</td>
                                </tr>';
                            }
                            else
                            {
                                echo'<tr>
                                    <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">5 Driver Allowance</td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; border: 1px solid black;"></td>
                                    <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                </tr>';
                            }
                            echo '<tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">6 Overnight Detention Charges</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">7 Airport Transfer 4 Hrs. 40 Km</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>';
                            if($toll != '00' || $park != '00')
                            {
                                echo'<tr>
                                        <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">8<b style="color: #ff0000; font-size: 20px; font-family: cursive; margin: 0 0 0 -10px;">&#10003;</b>Parking Charges / Toll Tax</td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.($toll + $park).'</p></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                                    </tr>';
                            
                            }
                            else
                            {
                                echo'<tr>
                                        <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">8 Parking Charges / Toll Tax</td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; border: 1px solid black;"></td>
                                        <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                    </tr>';
                            }
                            echo'<tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">9 Cancellation Charges</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;">10 Lunch Allowance</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; width: 1cm; border: 1px solid black;"></td>
                            </tr>';
                            $amount = AmountInWords($tamount);
                            echo'<tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px;" rowspan="2">Rupees  <b style="border-bottom: 2px dotted black;color: #0024cf; font-family: cursive; margin: 0 10px 0 5px;"> '. $amount.' Only.</b></td>
                                <td style="text-align: right; border: 1px solid black; padding: 3px 10px; height:32px;" colspan="2">Total</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tamount.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                            </tr>

                            <tr>
                                <td style="text-align: right; border: 1px solid black; padding: 3px 10px; height: 32px;" colspan="2">Service Tax</td>
                                <td style="vertical-align:middle; border: 1px solid black;" colspan="1"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px solid black; padding: 3px 5px; height: 32px;"></td>
                                <td style="text-align: right; border: 1px solid black; padding: 3px 10px;" colspan="2">Net Total</td>
                                <td style="vertical-align:middle; border: 1px solid black;"></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tamount.'</p></td>
                                <td style="vertical-align:middle; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">~</p></td>
                            </tr>';
                            
                    echo '</table>
                <div class="ofl" style="display:flex; margin-top:-3vh; padding: 10px 0;">
                <div class="ort">
                    <h5 style="width: 534px;">Terms:<br>(1) Interest @ 18% p.a will be charged on account not setteled within 15 days.<br>(2) No dispute or objection will be entertained if not brought out in notice within 7 days from the date of hereof.<br>(3) All Dispute subject to Mumbai Jurisdiction.<br>(4) All Cheques to be in the name of <b style="color: #ff0000; text-transform: uppercase;">Sai Darshan</b></h5>
                </div>

                <div class="ort" style="float: right; padding: 0 0 0 80px">
                    <h5 style="text-align: right;">E. O. & E.</h5>
                    <h3 style="color: #ff0000; letter-spacing: 1px;">For SAI DARSHAN</h3>';
                    if ($sign == 'signed')
                    {
                        echo '<img style="width: 150px;height: 75px; transform: rotate(5deg); margin: -10px 0px 0px 27px;" src="images/sign1.png" />
                            <h5 style="text-align: right; margin: -20px 0 0 0;">Proprietor</h5>';
                    }
                    else
                    {
                        echo '<h5 style="text-align: right; margin: 52px 0 0 0;">Proprietor</h5>';
                    }
                    echo'</div>
                        </div>
                            </div>';
                }
            // <p class="less"></p>
            // <p class="thicker"></p>
}
?>
</div>
</div>
</div>
</div>

<?php
if (@$_GET['q'] == 6 && !(@$_GET['step']))
{
    $kid  = @$_GET['cid'];

    echo '<div style="background-color:#fff; color: #23005b; margin: auto; width:22cm; height: 35.1cm;">
            <div class="ofl" style="display:flex; margin-top:-3vh; padding: 50px 20px 10px 20px;">
                <div class="ol" style="display:block; padding: 0 70px 0 0;">
                    <h1 style="font-size: 40px;">Sai Darshan</h1>
                    <h2>Car Rental</h2>
                </div>
                <div style="padding: 0 70px 0 0;">
                    <img src="images/sai.png" style="width: 2cm; padding: 0 0 0 0;">
                </div>
                <div class="ort">
                    <h5>A1/119 Sai Shraddha CHS,<br>I-Plot, Linking Road Extn, Near Best Quarterz,<br>Santacruz(West), Mumbai-400 054.<br>Mob : 9821215835/9222270130</h5>
                </div>
            </div>
            <hr class="less">
            <hr class="thicker">
            <div class="st" style="display: block; padding: 20px; font-size: large;">
            <div><h2 style="display: block; text-align: center; width: fit-content; margin-left: auto; margin-right: auto; padding: 10px 10px; font-family: times new roman; border: 3px solid; text-transform: uppercase; margin-bottom: 15px;">Log Sheet</h2></div>
            <div style="display: flex;">
                <div style="width: 10.5cm;">
                    <div style="display: flex;"><span style="margin:0 39px 0 0;">Name</span> : <p style="color: #0024cf; width: 7.4cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 10px;">Reporting : <p style="color: #0024cf; width: 7.4cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 10px;"><span style="margin:0 19px 0 0;">Address</span> : <p style="color: #0024cf; width: 7.4cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 32px; margin: 0 0 0 2.52cm;"><p style="color: #0024cf; width: 7.4cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 32px; margin: 0 0 0 2.52cm;"><p style="color: #0024cf; width: 7.4cm; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                </div>

                <div style="width: 10.5cm">
                    <div style="display: flex;"><span style="margin:0 86px 0 0">Date</span>: <p style="padding: 0 10px 0 0; width: 6.8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;">'.date("d-m-Y").'</p></div>
                    <div style="display: flex; padding-top: 10px;"><span style="margin:0 53px 0 0;">Non A/C</span>: <p style="padding: 0 10px 0 0;  width: 6.8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 10px;"><span style="margin:0 19px 0 0;">To Report At</span>: <p style="padding: 0 10px 0 0; width: 6.8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 10px;"><span style="margin:0 62px 0 0;">Car No.</span>: <p style="padding: 0 10px 0 0;  width: 6.8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                    <div style="display: flex; padding-top: 10px;">Driver\'s Name : <p style="padding: 0 10px 0 0;  width: 6.8cm; color: #0024cf; margin: 0 0 0 6px; border-bottom: 2px solid black; font-weight: 600; font-family: cursive;"></p></div>
                </div>
            </div>
        </div>';

        echo '<div style="display: block; padding: 0 20px 20px 20px;">
                <table style="border: 1px solid black; vertical-align:middle; min-width: fit-content; margin-top: 2.5vh;margin-bottom:0.5vh;">
                <tr style="border: 1px solid black;">
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" rowspan="2"><b>Date</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" colspan="2"><b>Kilometers At Garage</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" colspan="2"><b>Time At Garage</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" colspan="2"><b>Total</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" colspan="2"><b>Extra</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;" rowspan="2"><b>CAR NO.</b></td>
                </tr>
                <tr style="border: 1px solid black;">
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Opening</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Closing</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Out</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>In</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Kilo Meters</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Hours</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Kilo Meters</b></td>
                    <td style="vertical-align:middle; width: fit-content; border: 1px solid black; text-transform: uppercase;"><b>Hours</b></td>
                </tr>';
                
            $sql = "Select * from bills where cid='$kid' and status='UnPaid'";
                
            if ($result = mysqli_query($conn, $sql))
            {
                $rcount = mysqli_num_rows( $result );
                $n =  16 - $rcount;
            }

            $result = mysqli_query($conn, "Select * from bills where cid='$kid' and status='UnPaid'") or die('Error');

            while ($row = mysqli_fetch_array($result))
            {
                $date    = $row['date'];
                $carname = $row['carname'];
                $carno   = $row['carno'];
                $skm     = $row['skm'];
                $ckm     = $row['ckm'];
                $stime   = $row['stime'];
                $ctime   = $row['ctime'];
                $tkm     = $row['tkm'];
                $ttime   = $row['ttime'];
                $ekm     = $row['ekm'];
                $etime   = $row['etime'];
 
                $date = strtotime($date);
                $date = date("d-m-Y", $date);



                echo'<tr style="border: 1px solid black;">
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$date.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$skm.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ckm.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$stime.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ctime.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$tkm.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ttime.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$ekm.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$etime.'</p></td>
                        <td style="vertical-align:middle; width: fit-content; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;">'.$carname.' '.$carno.'</p></td>
                    </tr>';
            }
            for ($i=1; $i < $n; $i++)
            {
                echo'<tr style="border: 1px solid black;">
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                            <td style="vertical-align:middle; width: fit-content; height: 45px; border: 1px solid black;"><p style="color: #0024cf; font-family: cursive;"></p></td>
                        </tr>';
            }
        echo '</table>
            <div style="display: flex;"><h4 style="width: fit-content; display: block;">Note </h4> : Time & Distance Will Be Calculated From Garage To Garage</div>';
}
?>
<div class="cont">
<div class="rew">
<div class="ds">
<?php

if (@$_GET['q'] == 8 && !(@$_GET['step']))
{
    $q3 = mysqli_query($conn, "select * from driver") or die("No Duty Details Added, Error Ask Sagar");
    echo '<div class="panel" style="margin: 30px 0 0 0;">
            <div class="fl" style="padding: 20px 30px; color: #000;;">';
    while ($row = mysqli_fetch_array($q3))
    {
        $dmname   = $row['dname'];
        $kid      = $row['did'];
        
        echo '<button class="collapsible cap">'.$dmname.'</button>
            <div class="content" style="min-height: fit-content;">';
            echo '<div class="search" style="position:relative; display:flex; transition:0.5s; padding:20px 0 0 0;">
            <div class="fl" style="padding:0 30px; width:13.5cm;">
                <button class="collapsible" style="background:linear-gradient(267deg,#E91E63,#03A9F4);">Search by Date</button>
                <div class="content">
                    <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                        <form name="form" action="try.php?q=4&step=1&cname='.$dmname.'" method="POST" style="width:100%;">
                            <input id="sdate" name="sdate" placeholder="Enter the Start Date"  type="date" required="" autocomplete="off" title="Enter the Start Date">
                            <input id="cdate" name="cdate" placeholder="Enter the End Date"  type="date" required="" autocomplete="off" title="Enter the End Date">
                            <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                        </form>
                    </div>
                </div>
            </div>

            <div class="fl" style="padding:0 30px; width:13.5cm;">
                <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Client Name</button>
                <div class="content">
                    <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                        <form name="form" action="try.php?q=4&step=2&cname='.$dmname.'" method="POST" style="width:100%;">
                            <input id="gname" name="gname" placeholder="Search By Client Name"  type="text" required="" autocomplete="off" title="Search By Client Name">
                            <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                        </form>
                    </div>  
                </div>
            </div>
        </div>';
        echo '<div class="panel" style="margin:30px 0 20px 0;">
        <div style="display: block; width:98.6%; overflow-x: auto;">
            <table class="tap tap-string" style="vertical-align:middle; min-width: max-content; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
                <tr>
                    <td style="vertical-align:middle"><b>Date</b></td>
                    <td style="vertical-align:middle"><b>Company Name</b></td>
                    <td style="vertical-align:middle"><b>Car Name</b></td>
                    <td style="vertical-align:middle"><b>Extra Time</b></td>
                    <td style="vertical-align:middle"><b>Driver</b></td>
                    <td style="vertical-align:middle"><b>Guest Name</b></td>
                    <td style="vertical-align:middle"><b>Advance</b></td>
                    <td style="vertical-align:middle"><b>Given Back</b></td>
                    <td style="vertical-align:middle"><b>Amount</b></td>';

                $res = mysqli_query($conn, "Select * from bdriver where dname='$dmname' order by date asc") or die('Error');

                while ($row = mysqli_fetch_array($res))
                {
                    $date     = $row['date'];
                    $cname    = $row['cname'];
                    $carname  = $row['carname'];
                    $carno    = $row['carno'];
                    $gname    = $row['gname'];
                    $date     = $row['date'];
                    $duty     = $row['dtype'];
                    $dname    = $row['dname'];
                    $etime    = $row['etime'];
                    $emoney   = $row['emoney'];
                    $damo     = $row['damo'];
                    $days     = $row['days'];
                    $advance  = $row['advance'];
                    $tadvance = $row['tadvance'];
                    $amount   = $row['amount'];
                    $gb       = $row['gb'];
                    $tamount  = $row['tamount'];
                    // $just     = $row['uid'];

                // if ($just == $_SESSION['uid'])
                    // {
                    // <td style="vertical-align:middle">' . $c++ . '</td>
                                        
                    $date = strtotime($date);
                    $date = date("d-m-Y", $date);
                    
                    if ($duty == 'Duty')
                    {
                        echo '<tr>
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">' . $cname . '</td>
                            <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                            <td style="vertical-align:middle;">' . $etime . '</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">' . $gname . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $advance . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $gb . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                        </tr>';
                    }
                    else
                    {
                        echo '<tr style="background-color:#ff9999;">
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">-</td>
                            <td style="vertical-align:middle;">-</td>
                            <td style="vertical-align:middle;">-</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">-</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tadvance . '</td>
                            <td style="vertical-align:middle;">-</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tadvance . '</td>
                        </tr>';
                    }
                }
            echo '</table>
            </div>';
            
            $resu = mysqli_query($conn, "SELECT *,SUM(tamount),SUM(tadvance),SUM(gb) FROM bdriver where dname='$dmname'") or die('Error');
            while ($row = mysqli_fetch_array($resu))
            {
                if ($row['dname'] == $dmname)
                {
                    $s = $row['SUM(tamount)'];
                    $sy = $row['SUM(tadvance)'];
                    // $sp = $row['SUM(gb)'];
                    
                    // echo $s;
                    // echo $sy;
                    
                    $sp = $s - $sy;
                    // echo $sp;
                    echo '<div style="display: flex;"><div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rup.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$s.'</h3></div></div>';
                    echo '<div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rdown.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$sy.'</h3></div></div></div>';
                }
            }
        echo'</div>
    </div>';

    }
}
?>

<?php

if (@$_GET['q'] == 10 && !(@$_GET['step']))
{
    $q3 = mysqli_query($conn, "select * from driver") or die("No Duty Details Added, Error Ask Sagar");
    echo '<div class="panel" style="margin: 30px 0 0 0;">
            <div class="fl" style="padding: 20px 30px; color: #000;;">';
    while ($row = mysqli_fetch_array($q3))
    {
        $dmname   = $row['dname'];
        $kid      = $row['did'];
        
        echo '<button class="collapsible cap">'.$dmname.'</button>
            <div class="content" style="min-height: fit-content;">';
            echo '<div class="search" style="position:relative; display:flex; transition:0.5s; padding:20px 0 0 0;">
            <div class="fl" style="padding:0 30px; width:13.5cm;">
                <button class="collapsible" style="background:linear-gradient(267deg,#E91E63,#03A9F4);">Search by Date</button>
                <div class="content">
                    <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                        <form name="form" action="try.php?q=4&step=1&cname='.$dmname.'" method="POST" style="width:100%;">
                            <input id="sdate" name="sdate" placeholder="Enter the Start Date"  type="date" required="" autocomplete="off" title="Enter the Start Date">
                            <input id="cdate" name="cdate" placeholder="Enter the End Date"  type="date" required="" autocomplete="off" title="Enter the End Date">
                            <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                        </form>
                    </div>
                </div>
            </div>

            <div class="fl" style="padding:0 30px; width:13.5cm;">
                <button class="collapsible" style="background:linear-gradient(90deg,#17ff08,#0f3959);">Search by Client Name</button>
                <div class="content">
                    <div class="formBx" style="height:auto; padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                        <form name="form" action="try.php?q=4&step=2&cname='.$dmname.'" method="POST" style="width:100%;">
                            <input id="gname" name="gname" placeholder="Search By Client Name"  type="text" required="" autocomplete="off" title="Search By Client Name">
                            <input class="sub" type="submit" value="Submit" style="margin-top: 10px;" />
                        </form>
                    </div>  
                </div>
            </div>
        </div>';
        echo '<div class="panel" style="margin:30px 0 20px 0;">
        <div style="display: block; width:98.6%; overflow-x: auto;">
            <table class="tap tap-string" style="vertical-align:middle; min-width: max-content; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
                <tr>
                    <td style="vertical-align:middle"><b>Date</b></td>
                    <td style="vertical-align:middle"><b>Company Name</b></td>
                    <td style="vertical-align:middle"><b>Car Name</b></td>
                    <td style="vertical-align:middle"><b>Extra Time</b></td>
                    <td style="vertical-align:middle"><b>Driver</b></td>
                    <td style="vertical-align:middle"><b>Guest Name</b></td>
                    <td style="vertical-align:middle"><b>Amount</b></td>';
            $result = mysqli_query($conn, "Select * from bills where dname='$dmname'") or die('Error');
            while ($row = mysqli_fetch_array($result))
            {
                
                $date    = $row['date'];
                $cname   = $row['cname'];
                $carname = $row['carname'];
                $carno   = $row['carno'];
                $gname   = $row['gname'];
                $res = mysqli_query($conn, "Select * from bdriver where dname='$dmname' order by date asc") or die('Error');

                while ($row = mysqli_fetch_array($res))
                {
                    $date    = $row['date'];
                    $duty    = $row['dtype'];
                    $dname   = $row['dname'];
                    $etime   = $row['etime'];
                    $emoney  = $row['emoney'];
                    $damo    = $row['damo'];
                    $days    = $row['days'];
                    $advance = $row['advance'];
                    $amount  = $row['amount'];
                    $gb      = $row['gb'];
                    $tamount = $row['tamount'];
                    // $just = $row['uid'];

                // if ($just == $_SESSION['uid'])
                    // {
                    // <td style="vertical-align:middle">' . $c++ . '</td>
                                        
                    $date = strtotime($date);
                    $date = date("d-m-Y", $date);

                    if ($duty == 'Duty')
                    {
                        echo '<tr>
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">' . $cname . '</td>
                            <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                            <td style="vertical-align:middle;">' . $etime . '</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">' . $gname . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                        </tr>';
                    }
                    else
                    {
                        echo '<tr style="background-color:#ff9999;">
                            <td style="vertical-align:middle; width: fit-content;">' . $date . '</td>
                            <td style="vertical-align:middle;">' . $cname . '</td>
                            <td style="vertical-align:middle;">' . $carname . ' ' . $carno . '</td>
                            <td style="vertical-align:middle;">' . $etime . '</td>
                            <td style="vertical-align:middle;">' . $dname . '</td>
                            <td style="vertical-align:middle;">' . $gname . '</td>
                            <td style="vertical-align:middle;">&#8377;  ' . $tamount . '</td>
                        </tr>';
                    }
                }
            }
            echo '</table>
            </div>';
                        
            $resu = mysqli_query($conn, "SELECT *,SUM(tamount) FROM bdriver where dname='$dmname'") or die('Error');
            while ($row = mysqli_fetch_array($resu))
            {
                if ($row['dname'] == $dmname)
                {
                    $s = $row['SUM(tamount)'];
                    echo '<div style="display:table; margin-left:auto; margin-right:auto;"><div style="display:flex; padding: 10px;"><img src="images/rup.png" style="width: 40px; height: 40px; display:block;" alt="Amount To Be Paid"><h3 style="padding: 8px;">'.$s.'</h3></div></div>';
                }
            }
        echo'</div>
    </div>';

    }
}
?>
</div>
</div>
</div>
</div>
<?php
if (@$_GET['q'] == 7 && !(@$_GET['step']))
{
    echo '<h2 style="text-align: center;font-size: 30px; margin-top: 0; position:relative;">Enter Driver Advance Details</h2>
            <div class="formBx" style="padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
                <form name="form" action="update.php?q=dadv" method="POST">

                    <div class="panel" style="padding:15px 0 15px 0;">

                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Date</label>

                        <input id="date" name="date" placeholder="Enter the Date"  type="date" required="" autocomplete="off" title="Enter the Date" style="width:93%; background:#deefff;">

                    </div>
                    <div class="panel" style="padding:15px 0 15px 0;">

                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Driver</label>

                        <select id="dname" name="dname" placeholder="Select The Driver Name" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:8px 0; font-size:14px; letter-spacing:1px;">
                            <option value="" style="background:#fff;color:#000;font-size:16px;">Select the Driver Name</option>';

                            $result = mysqli_query($conn, "select * from driver") or die('Error');
                            while ($row = mysqli_fetch_array($result))
                            {
                                $dname = $row['dname'];
                                echo '<option style="background:#fff;color:#000;font-size:16px;">'.$dname.'</option>';
                            }
                            // <option style="background:#fff;color:#000;font-size:16px;">Same Day</option>

                        echo '</select>

                    </div>


                    <div class="panel" style="padding:15px 0 15px 0;">
                    
                        <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Advance Amount</label>

                        <input id="adv" name="adv" placeholder="Enter the Toll Rs"  type="number" required="" autocomplete="off" title="Enter the Toll Rs" style="width:93%; background:#deefff;">

                    </div>


                    <a onclick="cancel()" class="sub btn" style="border-radius:0px;border:none;width:100px;height:40px;padding:10px;background:#ff6767;text-transform:none;">Cancel</a>
                    <script>
                        function cancel()
                        {
                            var data = prompt("Are You Sure You Want to go Back\nNo Companies will be Added if you Click on Ok", "Yes");
                            if (data == "yes" || data == "Yes" || data == "YES")
                            {
                                window.location ="try.php?q=2";
                            }
                        }
                    </script>

                    <input class="sub" type="submit" value="Submit" style="margin-top: 20px;"/>
                </form>
            </div>';
}
?>

<?php
if (@$_GET['q'] == 4 && (@$_GET['step']) == 3)
{
    echo 'This Feature is Under Development Process Please add the Duty and then Print the bill';
    // echo '<h2 style="text-align: center;font-size: 30px; margin-top: 0; position:relative;">Enter Duty Details</h2>
    //         <div class="formBx" style="padding-top:3%; padding-bottom:0; padding-right:0; padding-left:0;">
    //             <form name="form" action="update.php?q=lorout" method="POST">

    //                 <div class="panel" style="padding:15px 0 25px 0;">

    //                     <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Local / Out Station</label>

    //                     <select id="lout" name="lout" placeholder="Choose correct answer " required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">

    //                         <option value="Local" style="background:#fff;color:#000;font-size:16px;">Select the Type of Duty</option>

    //                         <option value="Local" style="background:#fff;color:#000;font-size:16px;">Local</option>

    //                         <option value="Out Station" style="background:#fff;color:#000;font-size:16px;">Out Station</option>

    //                     </select>

    //                 </div>
                    
                    
    //                 <div class="panel" style="padding:15px 0 15px 0;">
    //                     <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Company Name</label>

    //                     <select id="cname" name="cname" placeholder="Choose The Company Name" required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">
    //                         <option style="background:#fff;color:#000;font-size:16px;">Select the Company Name</option>';
                        
    //                         $result = mysqli_query($conn, "select * from company") or die('Error');
    //                         while ($row = mysqli_fetch_array($result))
    //                         {
    //                             $cname = $row['cname'];
    //                             echo '<option style="background:#fff;color:#000;font-size:16px;">'.$cname.'</option>';
    //                         }
    //                         // <option style="background:#fff;color:#000;font-size:16px;">Same Day</option>

    //                         echo '</select>

    //                 </div>

    //                 <div class="panel" style="padding:15px 0 25px 0;">

    //                     <label style="display:flex; margin:1rem 0rem; color:#000; padding:0 0 0 4%;">Same Day / Continue</label>

    //                     <select id="ncon" name="ncon" placeholder="Choose correct answer " required="" style="position:relative; width:93%; padding:10px; background:#deefff; color:#7e7e7e; border:none; outline:none; box-shadow:none; margin:0; font-size:14px; letter-spacing:1px;">

    //                         <option value="Same Day" style="background:#fff;color:#000;font-size:16px;">Select the Type of Duty</option>

    //                         <option value="Same Day" style="background:#fff;color:#000;font-size:16px;">Same Day</option>

    //                         <option value="Continue" style="background:#fff;color:#000;font-size:16px;">Continue</option>

    //                     </select>
                    
    //                 </div>

    //                 <a onclick="cancel()" class="sub btn" style="border-radius:0px;border:none;width:100px;height:40px;padding:10px;background:#ff6767;text-transform:none;">Cancel</a>
    //                 <script>
    //                     function cancel()
    //                     {
    //                         var data = prompt("Are You Sure You Want to go Back\nNo Companies will be Added if you Click on Ok", "Yes");
    //                         if (data == "yes" || data == "Yes" || data == "YES")
    //                         {
    //                             window.location ="try.php?q=2";
    //                         }
    //                     }
    //                 </script>

    //                 <input class="sub" type="submit" value="Submit" style="margin-top: 20px;"/>
    //             </form>
    //         </div>';
}
?>
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
</section>
</body>
</html>