<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="utf-8" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
	<meta http-equiv="X-UA-Compatible" content="ie=edge" /> 
	<title>Loader Demo</title> 
	<style>
		@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
		*
		{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		} 
		#loader
		{ 
			border: 12px solid #f3f3f3; 
			border-radius: 50%; 
			border-top: 12px solid #444444; 
			width: 70px; 
			height: 70px; 
			animation: spin 1s linear infinite; 
		} 
		
		@keyframes spin
		{
			100%
			{
				transform: rotate(360deg); 
			} 
		} 
		
		.center
		{
			position: absolute; 
			top: 0; 
			bottom: 0; 
			left: 0; 
			right: 0; 
			margin: auto; 
		} 
	</style> 
</head> 

<body> 
	<div id="loader" class="center"></div>
	<script> 
		document.onreadystatechange = function()
		{
			if (document.readyState !== "complete")
			{
				document.querySelector( 
				"body").style.visibility = "hidden"; 
				document.querySelector( 
				"#loader").style.visibility = "visible"; 
			}
			else
			{ 
				document.querySelector( 
				"#loader").style.display = "none"; 
				document.querySelector( 
				"body").style.visibility = "visible"; 
			} 
		}; 
	</script> 
</body> 

</html> 

<?php
// include 'nav/_dbconnect.php'; 
// $result = mysqli_query($conn, "SELECT * FROM history order by eid desc") or die('Error223');
//     echo '<div class="panel" style="margin-top: 2.5vh;">
//             <table class="tap tap-string"  style="vertical-align:middle; width:97.5%; margin-top: 2.5vh; margin-left: 2.5vh; margin-right: 2.5vh; margin-bottom:4.5vh;">
//                 <tr>
//                     <td><b>S.N.</b></td>
//                     <td style="vertical-align:middle"><b>Username</b></td>
//                     <td style="vertical-align:middle"><b>Score</b></td>
//                 </tr>
//             </table>';
//     $c = 1;
//     while ($row = mysqli_fetch_array($result))
//     {                            
//         $eid     = $row['eid'];
//         $username = $row['username'];
//         $score = $row['score'];
//         $level = $row['level'];
//         $correct = $row['correct'];
//         $wrong = $row['wrong'];
//         $status  = $row['status'];
//         $just = $row['uid'];
        
//         if ($just == "60089584033a5")
//         {
//             if ($status == "finished")
//             {
// 				$q = mysqli_query($conn, "SELECT * FROM quiz where eid='$eid'") or die('Error223');
// 				while ($row = mysqli_fetch_array($q))
// 				{									
// 					$title = $row['title'];
// 					echo $c++ . $username . "&nbsp;" . $title . "&nbsp;" . $score . "&nbsp;" . $level . "&nbsp;" . $correct . "&nbsp;" . $wrong . "<br>";
// 				}
//             }
//         }
//     }

	// if (@$_GET['q'] == 'result' && @$_GET['eid']) {
	// 	$eid = @$_GET['eid'];
	// 	$q = mysqli_query($conn, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error157');
	// 	while ($row = mysqli_fetch_array($q)) {
	// 		$total = $row['total'];
	// 	}
	// 	$q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$eid' AND username='$username' ") or die('Error157');
		
	// 	while ($row = mysqli_fetch_array($q)) {
	// 		$s      = $row['score'];
	// 		$w      = $row['wrong'];
	// 		$r      = $row['correct'];
	// 		$status = $row['status'];
	// 	}
	// 	if ($status == "finished") {
	// 		echo '<div class="panel">
	// 		<center><br>
	// 			<h1 class="title" style="color:#660033">Result</h1>
	// 		</center><br>
	// 		<table class="tap tap-string" style="font-size:20px;font-weight:1000;margin-left:10px;width:95%;margin:auto;margin-bottom:50px;text-align:unset;">';
	// 		echo '<tr style="color:darkblue">
	// 				<td style="vertical-align:left; padding-left:100px;">Total Questions</td>
	// 				<td style="vertical-align:middle">' . $total . '</td>
	// 			  </tr>
	// 		<tr style="color:darkgreen">
	// 				<td style="vertical-align:left; padding-left:100px;">Correct Answer&nbsp;<span class="glyphicon glyphicon-ok-arrow" aria-hidden="true"></span></td>
	// 				<td style="vertical-align:middle">' . $r . '</td>
	// 		</tr> 
	// 		<tr style="color:red">
	// 			<td style="vertical-align:left; padding-left:100px;">Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-arrow" aria-hidden="true"></span>
	// 			</td><td style="vertical-align:middle">' . $w . '</td>
	// 		</tr>
	// 		<tr style="color:orange">
	// 			<td style="vertical-align:left; padding-left:100px;">Unattempted&nbsp;<span class="glyphicon glyphicon-ban-arrow" aria-hidden="true"></span></td>
	// 			<td style="vertical-align:middle">' . ($total - $r - $w) . '</td>
	// 		</tr>
	// 		<tr style="color:darkblue">
	// 			<td style="vertical-align:left; padding-left:100px;">Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
	// 			<td style="vertical-align:middle">' . $s . '</td>
	// 		</tr>';
	// 		$q = mysqli_query($conn, "SELECT * FROM rank WHERE  username='$username' ") or die('Error157');
	// 		while ($row = mysqli_fetch_array($q)) {
	// 			$s = $row['score'];
	// 			// echo '<tr style="color:#990000"><td style="vertical-align:middle">Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td style="vertical-align:middle">' . $s . '</td></tr>';
	// 		}
	// 		echo '<tr>
	// 		</tr>
	// 		</table>
	// 		</div>
	// 		<div class="panel" style="padding: 0px 50px;">
	// 		<h3 align="center" style="font-family:calibri; font-weight:10; padding-top:20px; font-size:30px;">:: Detailed Analysis ::</h3>
	// 		<br>
	// 		<ol style="font-size:20px;display:grid;font-weight:bold;font-family:calibri;margin-top:20px">';
	// 		$q = mysqli_query($conn, "SELECT * FROM questions WHERE eid='$_GET[eid]'") or die('Error197');
	// 		while ($row = mysqli_fetch_array($q)) {
	// 			$question = $row['qns'];
	// 			$qid      = $row['qid'];
	// 			$q2 = mysqli_query($conn, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND qid='$qid' AND username='$_SESSION[username]'") or die('Error197');
	// 			if (mysqli_num_rows($q2) > 0)
	// 			{
	// 				$row1         = mysqli_fetch_array($q2);
	// 				$ansid        = $row1['ans'];
	// 				$correctansid = $row1['correctans'];
	// 				$q3 = mysqli_query($conn, "SELECT * FROM options WHERE optionid='$ansid'") or die('Error197');
	// 				$q4 = mysqli_query($conn, "SELECT * FROM options WHERE optionid='$correctansid'") or die('Error197');
	// 				$row2       = mysqli_fetch_array($q3);
	// 				$row3       = mysqli_fetch_array($q4);
	// 				$ans        = $row2['option'];
	// 				$correctans = $row3['option'];
	// 			} else {
	// 				$q3 = mysqli_query($conn, "SELECT * FROM answer WHERE qid='$qid'") or die('Error197');
	// 				$row1         = mysqli_fetch_array($q3);
	// 				$correctansid = $row1['ansid'];
	// 				$q4 = mysqli_query($conn, "SELECT * FROM options WHERE optionid='$correctansid'") or die('Error197');
	// 				$row2       = mysqli_fetch_array($q4);
	// 				$correctans = $row2['option'];
	// 				$ans        = "Unanswered";
	// 			}
	// 			if ($correctans == $ans && $ans != "Unanswered")
	// 			{
	// 				echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri; margin-bottom: 15px;margin-top:20px;background-color:lightgreen;padding:10px;word-wrap:break-word;border:2px solid darkgreen;border-radius:10px;">' . $question . ' <span class="glyphicon glyphicon-ok" style="color:darkgreen"></span></div>';
	// 				echo '<div style="font-size: 0px; font-weight: 500;margin-left:30px;"><font style="font-size:14px;color:darkgreen"><b>Your Answer: </b></font><font style="font-size:14px;">' . $ans . '</font><br />';
	// 				echo '<font style="font-size:14px;color:darkgreen"><b>Correct Answer: </b></font><font style="font-size:14px;">' . $correctans . '</font><br /></div>';
	// 			}
	// 			else if ($ans == "Unanswered")
	// 			{
	// 				echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:#f7f576;padding:10px;word-wrap:break-word;border:2px solid #b75a0e;border-radius:10px;">' . $question . ' </div><br />';
	// 				echo '<div style="font-size: 0px; font-weight: 500;margin-left:30px;"><font style="font-size:14px;color:darkgreen"><b>Correct Answer: </b></font><font style="font-size:14px;">' . $correctans . '</font><br /></div>';
	// 			} 
	// 			else
	// 			{
	// 				echo '<li><div style="font-size:16px;font-weight:bold;font-family:calibri;margin-top:20px;background-color:#f99595;padding:10px;word-wrap:break-word;border:2px solid darkred;border-radius:10px;">' . $question . ' <span style="color:red"></span></div><br />';
	// 				echo '<div style="font-size: 0px; font-weight: 500;margin-left:30px;"><font style="font-size:14px;color:darkgreen"><b>Your Answer: </b></font><font style="font-size:14px;">' . $ans . '</font><br />';
	// 				echo '<font style="font-size:14px;color:red"><b>Correct Answer: </b></font><font style="font-size:14px;">' . $correctans . '</font><br /></div>';
					
	// 			}
	// 			echo "<br /></li>";
	// 		}
	// 		echo '</ol>';
	// 		echo "</div>";
	// 	}
	// 	else
	// 	{
	// 		die("Thats a 404 Error bro. You are trying to access a wrong page");
	// 	}
	// }
?>