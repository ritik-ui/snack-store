<?php
include 'nav/_dbconnect.php';

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['admin']))
{
	header("location: login.php");
	exit;
}
// $conn = mysqli_connect("localhost", "root", "", "data");
$rows = mysqli_query($conn, "SELECT * FROM items");
?>
<table border = 1 cellpadding = 10>
  <tr>
    <td>#</td>
    <td>Name</td>
    <td>Email</td>
    <td>Age</td>
    <td>Country</td>
  </tr>
  <?php $i = 1; ?>
  <?php foreach($rows as $row) : ?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $row["fname"]; ?></td>
      <td><?php echo $row["mrp"]; ?></td>
      <td><?php echo $row['discount']; ?></td>
      <td><?php echo $row['description']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
