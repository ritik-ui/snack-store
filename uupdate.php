<?php
include 'nav/_dbconnect.php';

session_start();
if(!isset($_SESSION['uloggedin']) || $_SESSION['uloggedin'] != true || !isset($_SESSION['user']))
{
	header("location: ulogin.php");
	exit;
}

if (@$_GET['q'] == 'addinfo' && @$_GET['uid'])
{
    $uid = @$_GET['uid'];
    echo 'Sagar';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phno  = $_POST['phno'];
    $emid  = $_POST['emid'];
    $addrs = $_POST['addrs'];
    $nhod  = $_POST['nhod'];
    $pcde  = $_POST['pcde'];
 
    echo $fname.'<br>'.$lname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde;
    
    $q = mysqli_query($conn, "insert into uinfo VALUES  (NULL,'$uid','$fname','$lname','$phno','$emid','$addrs','$nhod','$pcde')") or die('User Data Not Added');
    $r = mysqli_query($conn, "update users set pinfo='Entered' WHERE uid='$uid'") or die('Error');

    header("location:umain.php?q=0");
}

if (@$_GET['q'] == 'star' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['fid'])
{
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $st = @$_GET['st'];
    $stars = $_POST['stars'];
    $review = $_POST['review'];
     
    echo $stars.'<br>'.$review.'<br>'.$hid.'<br>'.$fid.'<br>'.$uid;
    if ($st == 'resp')
    {
        $q = mysqli_query($conn, "update reviews set ratings='$stars', review='$review' where hid='$hid' and uid='$uid' and fid='$fid'") or die('User Data Not Add');
    }
    else
    {
        $q = mysqli_query($conn, "insert into reviews values (NULL,'$hid','$uid','$fid','$stars','$review',NULL)") or die('User Data Not Added');
    }
    header("location:umain.php?q=0&step=1&fid=$fid");
}

if (@$_GET['q'] == 'pcdcheck')
{
    // echo 'Sagar';
    $pcde = $_POST['pcde'];
     
    header("location:umain.php?q=0&step=1&fid=$fid");
}
if (@$_GET['q'] == 'equest' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'])
{
    // echo 'Sagar';
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $qid = uniqid();
    $quest = $_POST['quest'];

    $q68 = mysqli_query($conn, "Select * from uinfo where uid='$uid'") or die('Error');
    while ($row = mysqli_fetch_array($q68))
    {
        $fname = $row['fname'];
        echo $fname;
    }
     
    $q = mysqli_query($conn, "insert into questions values (NULL,'$hid','$uid','$fname','$fid','$qid','$quest',NULL,'Unanswered')") or die('User Data Not Added');
    $q2 = mysqli_query($conn, "insert into ans values (NULL,'$hid','$fid','$uid','$qid','',NULL)") or die('User Data Not Added');
    header("location:umain.php?q=0&step=1&fid=$fid");
}
if (@$_GET['q'] == 'adcart' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['rtn'])
{
    // echo 'Sagar';
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $rtn = @$_GET['rtn'];

    $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$fid','$uid','1')") or die('User Data Not Added');

    if ($rtn == 'main')
    {
        header("location:umain.php?q=0");
    }
    elseif ($rtn == '1page')
    {
        header("location:umain.php?q=0&step=1&fid=$fid");
    }
}
if (@$_GET['q'] == 'aldcart' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['rtn'])
{
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $rtn = @$_GET['rtn'];
    
    $pattern = "/[,\s:]/";
    $components = preg_split($pattern, $fid);
    foreach($components as $item)
    {
        $qq3 = mysqli_query($conn, "select * from items where fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qq3))
        {
            $ditm = $row['ditm'];
        }
        $qq4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uid' and fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qq4))
        {
            $qaty = $row['qty'];
            $fit = $row['fit'];

            if ($fit < 1)
            {
                $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$item','$uid','1')") or die('User Data Not Added');
                echo $ditm.','.$qaty.','.$item . "<br>";
            }
            else
            {
                if ($qaty < $ditm)
                {
                    // echo 'add cannot be done';
                    $qty = $qaty + 1;
                    echo $qty. "<br>";
                    echo $qaty. "<br>";
                    echo $ditm. "<br>";
                    // $status = 'false';
                    $r = mysqli_query($conn, "update adcart set qty='$qty' WHERE uid='$uid' and hid='$hid' and fid='$item'") or die('Error');
                }
                echo $qty.','.$ditm.','.$qaty.','.$item . "<br>";
            }
        }

    }

    header("location:umain.php?q=0&step=1&fid=$rtn");
    // echo 'Sagar';
    // // $qaty = @$_GET['qty'];
    // $ditm = @$_GET['ditm'];


    // $qq4 = mysqli_query($conn, "select *,count(fid) as fit from adcart where uid='$uuid' and fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
    // while ($row = mysqli_fetch_array($qq4))
    // {
    //     $qaty = $row['qty'];
    //     $fit = $row['fit'];
        
    //     if ($fit < 1)
    //     {
    //         $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$fid','$uid','1')") or die('User Data Not Added');
        
    //         if ($rtn == 'main')
    //         {
    //             header("location:umain.php?q=0");
    //         }
    //         elseif ($rtn == '1page')
    //         {
    //             header("location:umain.php?q=0&step=1&fid=$fid");
    //         }
    //     }
        
    //     else
    //     {
    //         if ($qaty < $ditm)
    //         {
    //             // echo 'add cannot be done';
    //             $qty = $qaty + 1;
    //             echo $qty;
    //             // $status = 'false';
    //             $r = mysqli_query($conn, "update adcart set qty='$qty' WHERE uid='$uid' and hid='$hid' and fid='$fid'") or die('Error');
    //             if ($rtn == '2page')
    //             {
    //                 header("location:umain.php?q=2");
    //             }
    //             elseif ($rtn == '1page')
    //             {
    //                 header("location:umain.php?q=0&step=1&fid=$fid");
    //             }
    //         }
    //     }
    // }
}
if (@$_GET['q'] == 'rqty' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['qty'] && @$_GET['rtn'])
{
    // echo 'Sagar';
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $qaty = @$_GET['qty'];
    $rtn = @$_GET['rtn'];

    if ($qaty > 1)
    {
        $qty = $qaty - 1;

        $r = mysqli_query($conn, "update adcart set qty='$qty' WHERE uid='$uid' and hid='$hid' and fid='$fid'") or die('Error');
    }
    else
    {
        $r = mysqli_query($conn, "delete from adcart WHERE uid='$uid' and hid='$hid' and fid='$fid'") or die('Error');
    }
    // $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$fid','$uid')") or die('User Data Not Added');
    if ($rtn == '2page')
    {
        header("location:umain.php?q=2");
    }
    elseif ($rtn == '1page')
    {
        header("location:umain.php?q=0&step=1&fid=$fid");
    }
    elseif ($rtn == '3page')
    {
        header("location:umain.php?q=2&step=1");
    }
}
if (@$_GET['q'] == 'aqty' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['qty'] && @$_GET['ditm'] && @$_GET['rtn'])
{
    // echo 'Sagar';
    $uid = @$_GET['uid'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $qaty = @$_GET['qty'];
    $ditm = @$_GET['ditm'];
    $rtn = @$_GET['rtn'];

    if ($qaty < $ditm)
    {
        // echo 'add cannot be done';
        $qty = $qaty + 1;
        echo $qty;
        // $status = 'false';
        $r = mysqli_query($conn, "update adcart set qty='$qty' WHERE uid='$uid' and hid='$hid' and fid='$fid'") or die('Error');
        if ($rtn == '2page')
        {
            header("location:umain.php?q=2");
        }
        elseif ($rtn == '1page')
        {
            header("location:umain.php?q=0&step=1&fid=$fid");
        }
        elseif ($rtn == '3page')
        {
            header("location:umain.php?q=2&step=1");
        }
    }
    else
    {
        // $status = 'true';
        if ($rtn == '2page')
        {
            header("location:umain.php?q=2");
        }
        elseif ($rtn == '1page')
        {
            header("location:umain.php?q=0&step=1&fid=$fid");
        }
        elseif ($rtn == '3page')
        {
            header("location:umain.php?q=2&step=1");
        }
    }

    // $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$fid','$uid')") or die('User Data Not Added');
}
if (@$_GET['q'] == 'uqty' && @$_GET['uid'] && @$_GET['hid'] && @$_GET['fid'] && @$_GET['qty'] && @$_GET['ditm'] && @$_GET['rtn'])
{
    // echo 'Sagar';
    $uid = @$_GET['uid'];
    $qaty = $_POST['qtyy'];
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    // $qaty = @$_GET['qty'];
    $ditm = @$_GET['ditm'];
    $rtn = @$_GET['rtn'];
    echo $rtn;

    if ($qaty <= $ditm)
    {
        // echo 'add cannot be done';
        $qty = $qaty + 1;
        echo $qaty;
        // $status = 'false';
        $r = mysqli_query($conn, "update adcart set qty='$qaty' WHERE uid='$uid' and hid='$hid' and fid='$fid'") or die('Error');
        if ($rtn == '2page')
        {
            header("location:umain.php?q=2");
        }
        elseif ($rtn == '1page')
        {
            header("location:umain.php?q=0&step=1&fid=$fid");
        }
        elseif ($rtn == '3page')
        {
            header("location:umain.php?q=2&step=1");
        }
    }
    else
    {
        if ($rtn == '2page')
        {
            header("location:umain.php?q=2");
        }
        elseif ($rtn == '1page')
        {
            header("location:umain.php?q=0&step=1&fid=$fid");
        }
        elseif ($rtn == '3page')
        {
            header("location:umain.php?q=2&step=1");
        }
    }

    // $q2 = mysqli_query($conn, "insert into adcart values (NULL,'$hid','$fid','$uid')") or die('User Data Not Added');
}
if (@$_GET['q'] == 'cpin' && @$_GET['uid'])
{
    $addrs = $_POST['addrs'];
    $nhod  = $_POST['nhod'];
    $pcde  = $_POST['pcde'];
    $uid   = @$_GET['uid'];
    $cust  = @$_GET['cust'];


    $r = mysqli_query($conn, "update uinfo set address='$addrs', city='$nhod', pincode='$pcde' WHERE uid='$uid' and fname='$cust'") or die('Error');

    header("location:umain.php?q=2");
}
if (@$_GET['q'] == 'editall' && @$_GET['uid'])
{
    $uid   = @$_GET['uid'];
    $addrs = $_POST['addrs'];
    $nhod  = $_POST['nhod'];
    $pcde  = $_POST['pcde'];
    $phno = $_POST['phno'];
    $emid  = $_POST['emid'];
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];

    $r = mysqli_query($conn, "update uinfo set fname='$fname', lname='$lname', phno='$phno', emid='$emid', address='$addrs', city='$nhod', pincode='$pcde' WHERE uid='$uid'") or die('Error');

    header("location:umain.php?q=2");
}
if (@$_GET['q'] == 'paytm' && (@$_GET['uid']) && (@$_GET['custid']) && (@$_GET['am']) && (@$_GET['fid']) && (@$_GET['oid']) && (@$_GET['ofrm']))
{
    $custid = base64_decode(@$_GET['custid']);
    $amount = base64_decode(@$_GET['am']);
    $fid = base64_decode(@$_GET['fid']);
    $uuid = @$_GET['uid'];
    $ofrm = base64_decode(@$_GET['ofrm']);
    $oid = @$_GET['oid'];
    // $rtn = @$_GET['rtn'];
    echo $ofrm;
    // echo $uuid.' '.$hid.' '.$item.' '.$oid.' '.$amount.' '.$oid.'<br>';
    if ($ofrm == 'Cart')
    {    
        $pattern = "/[,\s:]/";
        $components = preg_split($pattern, $fid);
        foreach($components as $item)
        {
            $qq3 = mysqli_query($conn, "select * from items where fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($qq3))
            {
                $hid = $row['hid'];
                $mrp = $row['mrp'];
                $discount = $row['discount'];
                $qq3 = mysqli_query($conn, "select * from adcart where fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qq3))
                {
                    $qty = $row['qty'];

                    $ivalue = $mrp - $discount;
                    echo $uuid.' '.$hid.' '.$item.' '.$oid.' '.$amount.' '.$ivalue.' '.$oid.'<br>';

                    $insert = mysqli_query($conn, "insert into `buynow` VALUES ('NULL', '$uuid', '$hid', '$item', '$oid','$qty', '$ivalue', '$amount', 'TXN_FAILURE','$ofrm','ordered','unseen','Online Payment')") or die('User Data Not Added');
                }
            }
        }
    }
    elseif ($ofrm == 'Buy Now')
    {
        echo 'Sagar';
        echo $fid;
        $qk3 = mysqli_query($conn, "SELECT * FROM `items` WHERE fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qk3))
        {
            $hid = $row['hid'];
            $mrp = $row['mrp'];
            $discount = $row['discount'];
            // $qq3 = mysqli_query($conn, "select * from adcart where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
            // while ($row = mysqli_fetch_array($qq3))
            // {
                $qty = 1;
                
                $ivalue = $mrp - $discount;
                echo $uuid.' '.$hid.' '.$fid.' '.$oid.' '.$amount.' '.$ivalue.' '.$oid.' '.$ofrm.'<br>';

                $insert = mysqli_query($conn, "insert into `buynow` VALUES ('NULL', '$uuid', '$hid', '$fid', '$oid','$qty', '$ivalue', '$amount', 'TXN_FAILURE','$ofrm','ordered','unseen','Online Payment')") or die('User Data Not Added');
            // }
        }
    }
    echo '<form method="post" action="PaytmKit/pgRedirect.php" name="try">
            <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="'.$oid.'">
            <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="'.$custid.'">
            <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
            <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
            <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$amount.'">
        </form>
        <script>
            document.try.submit();
        </script>';
}
if (@$_GET['q'] == 'success')
{
    $msg = base64_decode(@$_GET['msg']);
    $st = base64_decode(@$_GET['st']);
    $oid = base64_decode(@$_GET['oid']);
    $goid = @$_GET['oid'];
    if ($st == 'TXN_SUCCESS')
    {
        $r = mysqli_query($conn, "update buynow set status='$st', ostat='ordered' WHERE oid='$oid'") or die('Error');
        $qq3 = mysqli_query($conn, "select * from buynow where oid='$oid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qq3))
        {
            $fid = $row['fid'];
            $ostat = $row['ostat'];
            $ofrm = $row['ofrm'];
            echo $ofrm;
            echo $ostat;
            $gst = base64_encode($ostat);

            if ($ofrm == 'Cart')
            {
                $rt = mysqli_query($conn, "delete from adcart WHERE fid='$fid'") or die('Error');
            }
        }
    }
    header("location:umain.php?q=2&step=3&oid=$goid&ostat=$gst");
    // echo 'Sagar';
}
if (@$_GET['q'] == 'cod' && (@$_GET['uid']) && (@$_GET['custid']) && (@$_GET['am']) && (@$_GET['fid']) && (@$_GET['oid']) && (@$_GET['ofrm']))
{

    $custid = base64_decode(@$_GET['custid']);
    $amount = base64_decode(@$_GET['am']);
    $fid = base64_decode(@$_GET['fid']);
    $uuid = @$_GET['uid'];
    $ofrm = base64_decode(@$_GET['ofrm']);
    $oid = @$_GET['oid'];
    echo $oid;
    
    if ($ofrm == 'Cart')
    {    
        $pattern = "/[,\s:]/";
        $components = preg_split($pattern, $fid);
        foreach($components as $item)
        {
            $qq3 = mysqli_query($conn, "select * from items where fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
            while ($row = mysqli_fetch_array($qq3))
            {
                $hid = $row['hid'];
                $mrp = $row['mrp'];
                $discount = $row['discount'];
                $qq3 = mysqli_query($conn, "select * from adcart where fid='$item'") or die("No Items Details Fetched, Error Ask Sagar");
                while ($row = mysqli_fetch_array($qq3))
                {
                    $qty = $row['qty'];

                    $ivalue = $mrp - $discount;
                    echo $uuid.' '.$hid.' '.$item.' '.$oid.' '.$amount.' '.$ivalue.' '.$oid.'<br>';

                    $insert = mysqli_query($conn, "insert into `buynow` VALUES ('NULL', '$uuid', '$hid', '$item', '$oid','$qty', '$ivalue', '$amount', 'TXN_SUCCESS','$ofrm','ordered','unseen','Cash')") or die('User Data Not Added');
                }
            }
            $rt = mysqli_query($conn, "delete from adcart WHERE fid='$fid'") or die('Error');
        }
    }
    elseif ($ofrm == 'Buy Now')
    {
        echo 'Sagar';
        echo $fid;
        $qk3 = mysqli_query($conn, "SELECT * FROM `items` WHERE fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        while ($row = mysqli_fetch_array($qk3))
        {
            $hid = $row['hid'];
            $mrp = $row['mrp'];
            $discount = $row['discount'];
            // $qq3 = mysqli_query($conn, "select * from adcart where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
            // while ($row = mysqli_fetch_array($qq3))
            // {
                $qty = 1;
                
                $ivalue = $mrp - $discount;
                echo $uuid.' '.$hid.' '.$fid.' '.$oid.' '.$amount.' '.$ivalue.' '.$oid.' '.$ofrm.'<br>';

                $insert = mysqli_query($conn, "insert into `buynow` VALUES ('NULL', '$uuid', '$hid', '$fid', '$oid','$qty', '$ivalue', '$amount', 'TXN_SUCCESS','$ofrm','ordered','unseen','Cash')") or die('User Data Not Added');
            // }
        }
    }
    // $rtn = @$_GET['rtn'];
    // echo $ofrm;
    $goid = base64_encode($oid);
    $gstat = base64_encode('TXN_SUCCESS');
    header("location:umain.php?q=2&step=3&oid=$goid&ostat=$gstat");
    // echo 'Sagar';
}

?>