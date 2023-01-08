<?php
require_once("includes/config2.php");


if(!empty($_POST["roomno"])) 
{
$roomno=$_POST["roomno"];
$result ="SELECT count(*) FROM hostel WHERE cell_number=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$roomno);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
echo "<span style='color:red'>$count. Seats already full.</span>";
else
	echo "<span style='color:red'>All Seats are Available</span>";
}
?>