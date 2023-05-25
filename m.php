<?php 
// Include the database configuration file  
include 'nav/_dbconnect.php';
 
// Get image data from database 
$result = mysqli_query($conn, "SELECT image FROM images ORDER BY id DESC"); 
?>

<?php 
if(mysqli_num_rows( $result ) > 0)
{ 
?> 
    <?php 
        while ($row = mysqli_fetch_array($result))
        {
            echo'<img src="data:image/jpg;charset=utf8;base64,';?><?php echo base64_encode($row['image']); echo'" /> ';
        }
}
else
{
    echo'<p class="status error">Image(s) not found...</p> ';
}
?>