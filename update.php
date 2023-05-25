<?php
include 'nav/_dbconnect.php';

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['admin']))
{
	header("location: login.php");
	exit;
}

if (@$_GET['q'] == 'unavi' && @$_GET['fid'])
{
    $fid = @$_GET['fid'];
    $r1 = mysqli_query($conn, "update items set availability='Unavailable' WHERE fid='$fid' ") or die('Error');
    header("location:main.php?q=0");
}

if (@$_GET['q'] == 'avi' && @$_GET['fid'])
{
    $fid = @$_GET['fid'];
    $r1 = mysqli_query($conn, "update items set availability='Available' WHERE fid='$fid' ") or die('Error');
    header("location:main.php?q=0");
}

if (@$_GET['q'] == 'additem' && (@$_GET['uid']) && (@$_GET['store']))
{
    echo 'Sagar';
    $type   = $_POST['type'];
    $fname  = $_POST['fname'];
    $fitno  = $_POST['fitno'];
    $desc   = $_POST['desc'];
    $mrp    = $_POST['mrp'];
    $netwt  = $_POST['netwt'];
    $dis    = $_POST['dis'];
    $inote    = $_POST['inote'];
    $ibox  = $_POST['ibox'];
    $ingden    = $_POST['ingden'];
    $ditm    = $_POST['ditm'];
    $fid    = uniqid();
    $uid    = @$_GET['uid'];
    $store  = @$_GET['store'];
    
    $ftype   = $_POST['ftype'];
    $btype   = $_POST['btype'];

    $q6 = mysqli_query($conn, "Select * from items where fid='$ftype'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $fbfid = $row['fid'];
        $fbfitno = $row['fitno'];
    }
    // $q = mysqli_query($conn, "insert into `boughtogh` values (NULL,'$uid','$fid','$fbfid','$fbfitno')") or die('Store Data Not Added');  
    // echo $type;

    $q6 = mysqli_query($conn, "Select * from items where fid='$btype'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $fbfid = $row['fid'];
        $fbfitno = $row['fitno'];
    }
    // $q = mysqli_query($conn, "insert into `fbought` values (NULL,'$hid','$fid','$fbfid','$fbfitno')") or die('Store Data Not Added');  
    echo $uid;

    $q6 = mysqli_query($conn, "Select * from sinfo where hid='$uid'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $hname = $row['hname'];
    }

    echo $hname;
    echo $type;

    $status = $statusMsg = ''; 

    echo $type.'<br>'.$fname.'<br>'.$fitno.'<br>'.$desc.'<br>'.$mrp.'<br>'.$dis.'<br>'.$netwt.'<br>'.$fid.'<br>'.$uid.'<br>'.$store.'<br>'.$inote.'<br>'.$ibox.'<br>'.$ingden.'<br>'.$ditm;
    echo 'Sagar1';
    $check = strpos($hname,"'");
    $c = $check+1;
    $heck = substr($hname,$c);
    $back = "\'";


    echo $hname.'<br>'.$heck.'<br>';
    if (!empty($check))
    {
        $htname = substr_replace($hname, $back.$heck, $check);
        echo $htname.'<br>';
        echo $hname;
    }
    $status = 'error';
    if(!empty($_FILES["image"]["name"]))
    {
        echo 'Sagar2';
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes))
        {
            echo 'Sagar3';
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
        
            // Insert image content into database 
            echo 'Sagar';
            // $insert = mysqli_query($conn, "INSERT into images VALUES ('$imgContent')"); 
            // $q3     = mysqli_query($conn, "insert into company values(NULL,'$id','$cname','$phoneno','$address')") or die("No Companies Data is Changed Error Ask Sagar");
            $insert = mysqli_query($conn, "insert into items values (NULL,'$fid','$fitno','$type','$imgContent','$uid','$htname','$fname','$desc','$netwt','$mrp','$dis','Available','$inote','$ibox','$ingden','$ditm')")or die("No Food Item is Added Error Ask Sagar"); 
            
            if($insert)
            {
                $status = 'success'; 
                $statusMsg = "File uploaded successfully.";
                header("location:main.php?q=0");
            }
            else
            {
                $statusMsg = "File upload failed, please try again."; 
            }  
        }
        else
        {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
    else
    {
        $statusMsg = 'Please select an image file to upload.'; 
    } 
    // }
    echo $statusMsg;
}

if (@$_GET['q'] == 'upitm' && (@$_GET['uid']) && (@$_GET['store']) && (@$_GET['fid'])) 
{
    echo 'Sagar';
    $type   = $_POST['type'];
    $fname  = $_POST['fname'];
    $fitno  = $_POST['fitno'];
    $desc   = $_POST['desc'];
    $mrp    = $_POST['mrp'];
    $netwt  = $_POST['netwt'];
    $dis    = $_POST['dis'];
    // $fidd    = uniqid();
    $fid    = @$_GET['fid'];
    $uid    = @$_GET['uid'];
    $store  = @$_GET['store'];
    $inote    = $_POST['inote'];
    $ibox  = $_POST['ibox'];
    $ingden    = $_POST['ingden'];
    $ditm    = $_POST['ditm'];

    echo $type.'<br>'.$fname.'<br>'.$fitno.'<br>'.$desc.'<br>'.$mrp.'<br>'.$dis.'<br>'.$netwt.'<br>'.$fid.'<br>'.$uid.'<br>'.$store.'<br>'.$inote.'<br>'.$ibox.'<br>'.$ingden.'<br>'.$ditm;
    $status = $statusMsg = ''; 
    // $delete = mysqli_query($conn, "insert into items values (NULL,'$fid','$fitno','$type','$imgContent','$uid','$store','$fname','$desc','$netwt','$mrp','$dis','Available')")or die("No Food Item is Added Error Ask Sagar"); 
    // if(empty($_FILES["image"]["name"]))
    // {
    //     // $r = mysqli_query($conn, "update store set sinfo='Entered' WHERE uid='$uid'") or die('Error');
        
    // }

    echo 'Sagar1';
    $q6 = mysqli_query($conn, "Select * from sinfo where hid='$uid'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $hname = $row['hname'];
    }

    echo $hname;
    echo $type;

    $status = $statusMsg = ''; 

    echo $type.'<br>'.$fname.'<br>'.$fitno.'<br>'.$desc.'<br>'.$mrp.'<br>'.$dis.'<br>'.$netwt.'<br>'.$fid.'<br>'.$uid.'<br>'.$store.'<br>'.$inote.'<br>'.$ibox.'<br>'.$ingden.'<br>'.$ditm;
    echo 'Sagar1';
    $check = strpos($hname,"'");
    $c = $check+1;
    $heck = substr($hname,$c);
    $back = "\'";


    echo $hname.'<br>'.$heck.'<br>';
    if (!empty($check))
    {
        $htname = substr_replace($hname, $back.$heck, $check);
        echo $htname.'<br>';
        echo $hname;
    }
    $status = 'error';
    if(!empty($_FILES["image"]["name"]))
    {
        echo 'Sagar2';
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes))
        {
            echo 'Sagar3';
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
        
            // Insert image content into database 
            echo 'Sagar';
            // $insert = mysqli_query($conn, "INSERT into items VALUES ('$imgContent')"); 
            // $q3     = mysqli_query($conn, "insert into company values(NULL,'$id','$cname','$phoneno','$address')") or die("No Companies Data is Changed Error Ask Sagar");
            $delete = mysqli_query($conn, "delete from items where fid='$fid'") or die('Error');
            
            if($delete)
            {
                // $insert = mysqli_query($conn, "insert into items values (NULL,'$fid','$fitno','$type','$imgContent','$uid','$store','$fname','$desc','$netwt','$mrp','$dis','Available','$inote','$ibox','$ingden','$ditm')")or die("No Food Item is Added Error Ask Sagar"); 
                $insert = mysqli_query($conn, "update items set fitno='$fitno', type='$type', image='$imgContent', uid='$uid', store='$htname', fname='$fname', description='$desc', netwt='$netwt', mrp='$mrp', discount='$dis', availability='Available', inote='$inote', ibox='$ibox', ingden='$ingden', ditm='$ditm')")or die("No Food Item is Added Error Ask Sagar"); 
                // $insert = mysqli_query($conn, "insert into items values (NULL,'$fidd','$fitno','$type','$imgContent','$uid','$store','$fname','$desc','$netwt','$mrp','$dis','Available')")or die("No Food Item is Added Error Ask Sagar"); 
                if($insert)
                {
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully.";
                    header("location:main.php?q=0");
                }
            }
            else
            {
                $statusMsg = "File upload failed, please try again."; 
            }  
        }
        else
        {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
    else
    {
        $r = mysqli_query($conn, "update items set inote='$inote',ibox='$ibox',ingden='$ingden',ditm='$ditm',type='$type',fname='$fname',description='$desc',netwt='$netwt',mrp='$mrp',discount='$dis',fitno='$fitno' WHERE fid='$fid'") or die('Error');
        header("location:main.php?q=0");
        $statusMsg = 'Please select an image file to upload.'; 
    } 
    // }
    echo $statusMsg;
}

if (@$_GET['q'] == 'addsinfo' && @$_GET['uid'])
{
    $uid = @$_GET['uid'];
    // echo $uid;
    // echo 'Sagar';
    $hname  = $_POST['hname'];
    $phno   = $_POST['phno'];
    $emid   = $_POST['emid'];
    $addrs  = $_POST['addrs'];
    $nhod   = $_POST['nhod'];
    $pcde   = $_POST['pcde'];
    $dpcde  = $_POST['dpcde'];
    
    // $hname = "Shyam's Family Restaurant";
    $check = strpos($hname,"'");
    $c = $check+1;
    $heck = substr($hname,$c);
    $back = "\'";

    echo $hname.'<br>'.$heck.'<br>';
    if (!empty($check))
    {
        $htname = substr_replace($hname, $back.$heck, $check);
        echo $htname.'<br>';
        echo $hname;
        // echo $emid.'s';
        if (empty($emid))
        {
            // echo 'Sagar';
            // echo '<br>'.$uid.'<br>'.$hname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde;
            // echo $uid.'<br>'.$hname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde;
            $q = mysqli_query($conn, "insert into `sinfo` values (NULL,'$uid','$htname','$phno','-','$addrs','$nhod','$pcde')") or die('Store DataNot Added');
        }
        else
        {
            $q = mysqli_query($conn, "insert into `sinfo` values (NULL,'$uid','$htname','$phno','$emid','$addrs','$nhod','$pcde')") or die('Store Data Not Added');
        }
    }
    else
    {
        if (empty($emid))
        {
            // echo 'Sagar';
            // echo '<br>'.$uid.'<br>'.$hname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde;
            // echo $uid.'<br>'.$hname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde;
            $q = mysqli_query($conn, "insert into `sinfo` values (NULL,'$uid','$hname','$phno','-','$addrs','$nhod','$pcde')") or die('Store Data Not Added');
        }
        else
        {
            $q = mysqli_query($conn, "insert into `sinfo` values (NULL,'$uid','$hname','$phno','$emid','$addrs','$nhod','$pcde')") or die('Store Data Not Added');
        }
    }
    $pattern = "/[,\s:]/";
    $components = preg_split($pattern, $dpcde);
    foreach($components as $item)
    {
        echo $item . "<br>";
        $q = mysqli_query($conn, "insert into dpcode values (NULL,'$uid','$item')") or die('Delivery Pin Code Not Added');
    }
    echo $uid.'<br>'.$hname.'<br>'.$phno.'<br>'.$emid.'<br>'.$addrs.'<br>'.$nhod.'<br>'.$pcde.'<br>'.$dpcde;
    
    // $q = mysqli_query($conn, "insert into sinfo values (NULL,'$uid','$hname','$phno','$emid','$addrs','$nhod','$pcde')") or die('Stre Data Not Added');
    $r = mysqli_query($conn, "update store set sinfo='Entered' WHERE uid='$uid'") or die('Error');

    header("location:main.php?q=0");
}

if (@$_GET['q'] == 'uimag' && @$_GET['hid'] && @$_GET['fid'])
{
    $qid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    // $a = $_POST['']
  
    $status = 'error';
    if(!empty($_FILES["image"]["name"]))
    {
        echo 'Sagar2';
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes))
        {
            echo 'Sagar3';
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
        
            // Insert image content into database 
            echo 'Sagar';
            // $insert = mysqli_query($conn, "INSERT into images VALUES ('$imgContent')"); 
            // $q3     = mysqli_query($conn, "insert into company values(NULL,'$id','$cname','$phoneno','$address')") or die("No Companies Data is Changed Error Ask Sagar");
            // $insert = mysqli_query($conn, "insert into items values (NULL,'$fid','$fitno','$type','$imgContent','$uid','$store','$fname','$desc','$netwt','$mrp','$dis','Available')")or die("No Food Item is Added Error Ask Sagar"); 
            $r = mysqli_query($conn, "update items set image='$imgContent' WHERE fid='$fid'") or die('Error');
            
            if($r)
            {
                $status = 'success'; 
                $statusMsg = "File uploaded successfully.";
                header("location:main.php?q=0&step=4&fid=$fid");
            }
            else
            {
                $statusMsg = "File upload failed, please try again."; 
            }  
        }
        else
        {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
    else
    {
        $statusMsg = 'Please select an image file to upload.'; 
    }    echo $statusMsg;
}

if (@$_GET['q'] == 'uinote' && @$_GET['hid'] && @$_GET['fid'])
{
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $inote = $_POST['inote'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "update items set inote='$inote' WHERE fid='$fid' and hid='$hid'") or die('Error');

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'uspec' && @$_GET['hid'] && @$_GET['fid'])
{
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $inbx = $_POST['inbx'];
    $ingden = $_POST['ingden'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "update items set ibox='$inbx',ingden='$ingden' WHERE fid='$fid' and hid='$hid'") or die('Error');

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'addfb' && @$_GET['hid'] && @$_GET['fid'])
{
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $type   = $_POST['type'];

    $q6 = mysqli_query($conn, "Select * from items where fid='$type'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $fbfid = $row['fid'];
        $fbfitno = $row['fitno'];
    }
    $q = mysqli_query($conn, "insert into `fbought` values (NULL,'$hid','$fid','$fbfid','$fbfitno')") or die('Store Data Not Added');  
    echo $type;

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'eque' && @$_GET['qid'] && @$_GET['fid'])
{
    $qid = @$_GET['qid'];
    $fid = @$_GET['fid'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "update ans set ans='' WHERE qid='$qid'") or die('Error');

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'ansque' && @$_GET['qid'] && @$_GET['fid'])
{
    $qid = @$_GET['qid'];
    $fid = @$_GET['fid'];
    $qans = $_POST['qans'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "update ans set ans='$qans' WHERE qid='$qid'") or die('Error');

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'addbt' && @$_GET['hid'] && @$_GET['fid'])
{
    $hid = @$_GET['hid'];
    $fid = @$_GET['fid'];
    $type   = $_POST['type'];

    $q6 = mysqli_query($conn, "Select * from items where fid='$type'") or die('Error');
    while ($row = mysqli_fetch_array($q6))
    {
        $fbfid = $row['fid'];
        $fbfitno = $row['fitno'];
    }
    $q = mysqli_query($conn, "insert into `boughtogh` values (NULL,'$hid','$fid','$fbfid','$fbfitno')") or die('Store Data Not Added');  
    echo $type;

    header("location:main.php?q=0&step=4&fid=$fid");
}

if (@$_GET['q'] == 'catg')
{
    echo 'Sagar';
    $cagt  = $_POST['cagt'];
    echo $cagt;

    $status = $statusMsg = ''; 


    // echo $type.'<br>'.$fname.'<br>'.$fitno.'<br>'.$desc.'<br>'.$mrp.'<br>'.$dis.'<br>'.$netwt.'<br>'.$fid.'<br>'.$uid.'<br>'.$store;
    echo 'Sagar1';
    $status = 'error';
    if(!empty($_FILES["image"]["name"]))
    {
        echo 'Sagar2';
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes))
        {
            echo 'Sagar3';
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
        
            // Insert image content into database 
            echo 'Sagar';
            // $insert = mysqli_query($conn, "INSERT into images VALUES ('$imgContent')"); 
            // $q3     = mysqli_query($conn, "insert into company values(NULL,'$id','$cname','$phoneno','$address')") or die("No Companies Data is Changed Error Ask Sagar");
            $insert = mysqli_query($conn, "update categories set bimage='$image' where cagname='$cagt'")or die("No Food Item is Added Error Ask Sagar"); 
            
            if($insert)
            {
                $status = 'success'; 
                $statusMsg = "File uploaded successfully.";
                header("location:main.php?q=9");
            }
            else
            {
                $statusMsg = "File upload failed, please try again."; 
            }  
        }
        else
        {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
    else
    {
        $statusMsg = 'Please select an image file to upload.'; 
    }
    // }
    echo $statusMsg;
}

if (@$_GET['q'] == 'rem' && @$_GET['fid'] && @$_GET['uid'])
{
    $uid = base64_decode(@$_GET['uid']);
    $fid = base64_decode(@$_GET['fid']);
    echo $uid.'<br>'.$fid;
    // $inbx = $_POST['inbx'];
    // $ingden = $_POST['ingden'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "delete from `items` where hid='$uid' and fid='$fid'") or die('Error');

    header("location:main.php?q=4");
}

if (@$_GET['q'] == 'oseen' && @$_GET['oid'])
{
    $oid = base64_decode(@$_GET['oid']);
    $uid = @$_GET['uid'];
    echo $uid.'<br>'.$oid;
    // $inbx = $_POST['inbx'];
    // $ingden = $_POST['ingden'];
    // $a = $_POST['']
    $r = mysqli_query($conn, "update `buynow` set sstat='seen' where oid='$oid'and hid='$uid'") or die('Error');

    header("location:main.php?q=0");
}

if (@$_GET['q'] == 'costat' &&@$_GET['oid'])
{
    $oid = base64_decode(@$_GET['oid']);
    $uid = @$_GET['uid'];
    $type   = $_POST['type'];
    echo $type;
    $r = mysqli_query($conn, "update `buynow` set ostat='$type' where oid='$oid'and hid='$uid'") or die('Error');

    header("location:main.php?q=0");
}

if (@$_GET['q'] == 'odet')
{
    $uid = @$_GET['uid'];

    $io = 0;
    $q40 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q40))
    {
        $ostat = $row['ostat'];

        if ($ostat != 'Delivered')
        {
            $io++;
        }
    }
    // $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid") or die("No Items Details Fetched, Error Ask Sagar");
    // while ($row = mysqli_fetch_array($q4))
    // {
    //     // $fid = $row['fid'];
    //     // $oid = $row['oid'];
    //     $otstat = $row['ostat'];
    //     $ststat = $row['sstat'];
    // }
    if ($io >= 1)
    {
        echo '<div style="padding: 0 20px; margin: 0 0 50px 0; display: -webkit-box;">
        <div>';
    
        $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid order by Serial_no desc") or die("No Items Details Fetched, Error Ask Sagar");
        foreach($q4 as $row1) :
            $fid = $row1['fid'];
            $oid = $row1['oid'];
            $ostat = $row1['ostat'];
            $sstat = $row1['sstat'];
            $kostat = base64_encode($ostat);
            $koid = base64_encode($oid);
            $amount = $row1['amount'];

            $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
            foreach($q485 as $row2) :
                $aimage = $row2['image'];
                $fnam = $row2['fname'];
                $fhid = $row2['hid'];
                $ffid = $row2['fid'];

                $try = $fnam;
                $c = 1;
                $q49 = mysqli_query($conn, "select * from buynow where oid='$oid' and status='TXN_SUCCESS' and hid='$uid'") or die("No Items Details Fetched, Error Ask Sagar");
                foreach($q49 as $row3) :
                    $fikd = $row3['fid'];
                    // $amount = $row['amount'];
                    $q490 = mysqli_query($conn, "select * from items where fid='$fikd'") or die("No Items Details Fetched, Error Ask Sagar");
                    foreach($q490 as $row4) :
                        $afid = $row4['fid'];
                        $afitno = $row4['fitno'];
                        $atype = $row4['type'];
                        $adesc = $row4['description'];
                        $anetwt = $row4['netwt'];
                        // $aimage = $row4['image'];
                        $ahid = $row4['hid'];
                        $ahname = $row4['hname'];
                        $afname = $row4['fname'];
                        $amrp = $row4['mrp'];
                        $adisc = $row4['discount'];
                        $aavi = $row4['availability'];
                        $aditm = $row4['ditm'];
            
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
                    endforeach;
                endforeach;

                // $ostat = $row['ostat'];
                if ($ostat != 'Delivered')
                {
                    if ($sstat != 'seen')
                    {
                        echo '<div class="cima tq active">
                                <div class="panel" style="padding: 15px 0 15px 0; background-color: #ffffff; width: 400px; height: 30%;">
                                    <div style="width: 45%; margin: auto; text-align: center;">
                                        <h2 style="text-align: center; font-size: 30px; padding-top: 10px; color: #d532d5bb;">New Order</h2>
                                    </div>
                                    <p style="color: #4bd532bb; font-size: 20px; font-weight: 600; padding: 15px 25px 0 25px;">'.$try.'</p>
                                    <a href="update.php?q=oseen&oid='.$koid.'&uid='.$uid.'" class="sub btn btn-light" style="margin: 20px; width: 150px;">Ok</a>
                                </div>
                            <!-- <img src="images/close.png" class="clsb" onclick="toggle();"> -->
                        </div>';
                    }

                    echo '<div style="height: fit-content; width: 510px; float: left; background-color: #fff; margin: 25px 25px 0 25px; border-radius: 15px; display: flex; box-sizing: border-box; padding: 25px 15px; border: 1px solid #ddd; justify-content: space-between;">
                        <div style="position: relative;">
                            <h1 style="font-size: 15px; font-weight: 600; color: #d532d5bb; text-transform: capitalize;">New Order • '.$ostat.'</h1>
                            <h1><a href="main.php?q=0&step=5&hid='.$fhid.'&oid='.$oid.'" class="link" style="font-size: unset; font-weight: unset;text-align: center; width: 100%; margin: auto;"><span class="wlink" style="height: 50%;"></span>'.$try.'</a></h1>
                            <!-- <a style="color: #4bd532bb; font-size: 20px; font-weight: 600;">'.$try.'</a> -->
                            <form name="form" id="formbv" action="update.php?q=costat&oid='.$koid.'&uid='.$uid.'" method="POST" enctype="multipart/form-data" style="width: 100%;">
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
                        <div style="display: flex; padding: 0 0 0 50px;">
                            <div class="ima" style="height: 120px; width: 180px;">
                                <img src="data:image/jpg; charset=utf8;base64,';?><?php echo base64_encode($aimage); echo'" style="display: inline-block; margin-left: auto; margin-right: auto;"/>
                            </div>';
                        echo '</div>';
                        echo '</div>';
                // }
            }
        endforeach;
    endforeach;
    echo '</div>';
    echo '</div>';
    // }
    }
}

if (@$_GET['q'] == 'bell')
{
    $uid = @$_GET['uid'];

    $io = 0;
    $i = 0;
    $q40 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid") or die("No Items Details Fetched, Error Ask Sagar");
    while ($row = mysqli_fetch_array($q40))
    {
        $ostat = $row['ostat'];

        if ($ostat != 'Delivered')
        {
            $io++;
            $i++;
        }
    }
    // $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid") or die("No Items Details Fetched, Error Ask Sagar");
    // while ($row = mysqli_fetch_array($q4))
    // {
    //     // $fid = $row['fid'];
    //     // $oid = $row['oid'];
    //     // $otstat = $row['ostat'];
    //     // $ststat = $row['sstat'];
    //     $ostat = $row['ostat'];

    //     if ($ostat != 'Delivered')
    //     {
    //         // if($row['ty'] > 1)
    //         // {
    //             // echo $row['ty'];
    //             // $i++;
    //         // }
    //     }
    // }
    if ($io >= 1)
    {
        $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid order by Serial_no desc") or die("No Items Details Fetched, Error Ask Sagar");
        foreach($q4 as $row1) :
            $fid = $row1['fid'];
            $oid = $row1['oid'];
            $ostat = $row1['ostat'];
            $sstat = $row1['sstat'];
            $kostat = base64_encode($ostat);
            $koid = base64_encode($oid);
            $amount = $row1['amount'];
            // echo 'Sagar';
            // $i++;
        endforeach;
    }
    echo '
    <div class="ddn">
    <a style="cursor: pointer;" class="dbtn"><div style="position: relative;">🔔<p style="position: absolute; padding: 1px 0 0 0; transform: translate(10px, -27px); border-radius: 50%; height: 19px; width: 20px; font-size: 0.8rem; color: #fff; border-radius: 50%; background-color: #ff0707;">'.$i.'</p></div></a>
    <div class="ddcon">';
    $q4 = mysqli_query($conn, "select * from buynow where status='TXN_SUCCESS' and hid='$uid' group by oid order by Serial_no desc") or die("No Items Details Fetched, Error Ask Sagar");
    foreach($q4 as $row1) :
        $fid = $row1['fid'];
        $oid = $row1['oid'];
        $ostat = $row1['ostat'];
        $sstat = $row1['sstat'];
        $kostat = base64_encode($ostat);
        $koid = base64_encode($oid);
        $amount = $row1['amount'];

        $q485 = mysqli_query($conn, "select * from items where fid='$fid'") or die("No Items Details Fetched, Error Ask Sagar");
        foreach($q485 as $row2) :
            $aimage = $row2['image'];
            $fnam = $row2['fname'];
            $fhid = $row2['hid'];
            $ffid = $row2['fid'];

            $try = $fnam;
            $c = 1;
            $q49 = mysqli_query($conn, "select * from buynow where oid='$oid' and status='TXN_SUCCESS' and hid='$uid'") or die("No Items Details Fetched, Error Ask Sagar");
            foreach($q49 as $row3) :
                $fikd = $row3['fid'];
                // $amount = $row['amount'];
                $q490 = mysqli_query($conn, "select * from items where fid='$fikd'") or die("No Items Details Fetched, Error Ask Sagar");
                foreach($q490 as $row4) :
                    $afid = $row4['fid'];
                    $afitno = $row4['fitno'];
                    $atype = $row4['type'];
                    $adesc = $row4['description'];
                    $anetwt = $row4['netwt'];
                    // $aimage = $row4['image'];
                    $ahid = $row4['hid'];
                    $ahname = $row4['hname'];
                    $afname = $row4['fname'];
                    $amrp = $row4['mrp'];
                    $adisc = $row4['discount'];
                    $aavi = $row4['availability'];
                    $aditm = $row4['ditm'];
        
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
                    // $i++;
                endforeach;
            endforeach;

            // $ostat = $row['ostat'];
            if ($ostat != 'Delivered')
            {
                echo '<a href="#">'.$try.'</a>';
            }
        endforeach;
    endforeach;
echo '</div>
</div>';
}

?>