<?php
session_set_cookie_params(0);
session_start();

include('includes/config1.php');
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
}?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>View Prisoner Details</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
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
<h2 style="text-align:center">Single Prisoner Profile</h2>
<?php	
$id=$_GET['id'];
$ret="select * from prisoners where id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$id);
$stmt->execute() ;//ok
$res=$stmt->get_result();
//$cnt=1;
while($row=$res->fetch_object())
{
?>
<div class="card">

  <img 
src="photo/<?php echo $row->profilepic;?>" alt="" style="width:100%">
  <p class="title">Prisoner name:<?php echo $row->fname;?> <?php echo $row->lname;?> </p>
  <p >Prisoner ID: <?php echo $row->passport;?>  </p>
  <p>Expected Release date:<?php echo $row->release_date;?></p>
<p>Crime:<?php echo $row->crime_name;?> </p>  
  
<div style="margin: 24px 0;">
  
<?php
                            	
                                $id=$_GET['id'];
                                //$status=1;
                                $ret="select hostel.* from hostel inner join prisoners on prisoners.id=hostel.prisoner_id  inner join cells on cells.id=hostel.cell_number and hostel.prisoner_id=:id ";
                                $query= $dbh -> prepare($ret);
                                $query->bindParam(':id',$id, PDO::PARAM_STR);
                                //$query->bindParam(':status',$status, PDO::PARAM_STR);
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query -> rowCount() > 0)
                                {
                                foreach($results as $result)
                                {
                                ?>
                                
                                <p>Cell Block:<?php echo $result->cell_name;?></p>
                                
                                
                                <?php }}?>
  </div>
  <p><button>Emergency Contact:<?php echo $row->contact;?></button></p>
</div>
<?php }?>


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