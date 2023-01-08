<?php
include('includes/pdoconfig.php');
if(!empty($_POST["roomid"])) 
{	
$id=$_POST['roomid'];
$stmt = $DB_con->prepare("SELECT * FROM cells WHERE id = :id");
$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['cell_name']); ?>

  <?php
 }
}



if(!empty($_POST["cellno"])) 
{	
$id=$_POST['cellno'];
$stmt = $DB_con->prepare("SELECT * FROM cells WHERE id = :id");
$stmt->execute(array(':id' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['cell_number']); ?>
  <?php
 }
}

?>