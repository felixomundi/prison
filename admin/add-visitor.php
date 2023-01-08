<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
header('location: login.php');
} {
include('dbconnection.php');
if (isset($_POST['submit'])) {

$prison_id = $_POST['prisoner_id'];
$f_name = $_POST['f_name'];
$m_name = $_POST['m_name'];
$l_name = $_POST['l_name'];
$contact = $_POST['contact'];
$relation = $_POST['relation'];
$status=1;
$date=$_POST['date_created'];
$status=1;
$query=mysqli_query($con, "INSERT INTO visitor(prisoner_id,f_name,m_name,l_name,contact,date_created,status) VALUES('$prison_id','$f_name','$m_name','$l_name','$contact',now(),'$status')");

if ($query) {
echo "<script>alert('You have successfully registered a visitor');</script>";
echo "<script type='text/javascript'> document.location ='manage-visitors.php'; </script>";
} else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Add visitor</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include "includes/sidebar.php"; ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<?php include "includes/header.php"; ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
<h3 class="text-dark mb-4">Add New visitor</h3>
<div class="row mb-3">
<div class="col-lg-8">

<div class="row">
<div class="col">
<div class="card shadow mb-3">
<div class="card-header py-3">
<p class="text-primary m-0 font-weight-bold">Add New visitor</p>
</div>
<div class="card-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>FName</strong></label>
<input type="text"required placeholder="Enter first name" class="form-control" name="f_name">
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>MName</strong></label>
<input type="text"required placeholder="Enter middle name" class="form-control" name="m_name">
</div>
</div>
</div>


<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong> LName</strong></label>
<input type="text" placeholder="Enter last name" class="form-control" required name="l_name">
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Contact</strong></label>
<input type="text" placeholder="Enter visitor contact" class="form-control" minlength="10" maxlength="10" required name="contact">
</div>
</div>
</div>




<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Prisoner</strong></label>
<select  name="prisoner_id" class="form-control" required>
<option value="">Please Select Prisoner Here </option>
<?php $ret="select id, fname,mname,lname from prisoners";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->mname);?> <?php echo htmlentities($result->lname);?></option>
<?php }} ?>
</select>
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Relation</strong></label>

<select name="relation" class="form-control" required="required">
<option value="">Select Relation</option>
<option value="Father">Father</option>
<option value="Mother">Mother</option>
<option value="Son">Son</option>
<option value="Daughter">Daughter</option>
<option value="Uncle">Uncle</option>
<option value="Aunt">Aunt</option>
<option value="Others">Others</option>
</select>
</div>
</div>
</div> 



<div class="form-group">
<div class="form-row">
<div class="col-md-12 col-lg-12 col-xl-12">
<div class="form-group">
<button class="btn btn-primary" type="submit"
name="submit">Add
</button>
</div>
</div>
</div>
</div>




</form>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="logout.php">Logout</a>
</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php } ?>