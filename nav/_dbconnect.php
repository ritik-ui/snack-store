<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "snacks";

$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn)
{
    die("Error".mysqli_connect_error());
}

// if($conn)
// {
//     echo 'Connected';
// }
// else
// {
//     die("Error".mysqli_connect_error());
// }

?>