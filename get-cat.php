<?php
include "db_config.php";

if (isset($_POST['category_id'])){
$category_id = $_POST["category_id"];
$result = mysqli_query($con, "SELECT * FROM cells where id = $category_id");
?>
<option value="">Select Cell Here</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["cell_name"]; ?></option>
    <?php
}}
elseif(isset($_POST['category1_id'])){
$category1_id = $_POST["category1_id"];
$result = mysqli_query($con, "SELECT * FROM cells where id = $category1_id");
?>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    
<option value="">Select Cell Room Here</option>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["cell_number"]; ?></option>
    <?php 
}}
?>




<!----Query 2--->
<?php if (isset($_POST['rid']))
{	
$rid=$_POST['rid'];
$result =  mysqli_query($con, "SELECT * FROM cells where cell_number = $rid");
?>
 <?php
 while($row = mysqli_fetch_array($result)) 
 {
  ?>
 <?php echo htmlentities($row['seater']); ?>
  <?php
 }
}

?>