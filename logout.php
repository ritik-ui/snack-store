<?php include 'nav/_dbconnect.php'; ?>
<?php
    session_start();
    if (@$_GET['q'] == 'store' && isset($_SESSION['store']))
    {
        // session_unset();
        // session_destroy();
        $uid = @$_GET['uid'];
        $r = mysqli_query($conn, "update sinfo set sstatus='offline' WHERE hid='$uid'") or die('Error');
        unset($_SESSION['admin']);
        header("location: login.php");
        exit;
    }

    session_start();
    if (@$_GET['q'] == 'user' && isset($_SESSION['cust']))
    {
        // session_unset();
        // session_destroy();
        unset($_SESSION['user']);
        header("location: ulogin.php");
        exit;
    }
?>