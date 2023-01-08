<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else if(isset($_POST['update']))
{
$id=$_GET['id'];
$f_name=$_POST['f_name'];
$m_name=$_POST['m_name'];
$l_name=$_POST['l_name'];
$contact=$_POST['contact'];
$prisoner_id=$_POST['prisoner_id'];
$sql="update  visitor set f_name=:f_name,m_name=:m_name,l_name=:l_name, contact=:contact,prisoner_id=:prisoner_id where id=:id";
$query = $dbh->prepare($sql);

$query->bindParam(':f_name',$f_name,PDO::PARAM_STR);
$query->bindParam(':m_name',$m_name,PDO::PARAM_STR);
$query->bindParam(':l_name',$l_name,PDO::PARAM_STR);
$query->bindParam(':contact',$contact,PDO::PARAM_STR);
$query->bindParam(':prisoner_id',$prisoner_id,PDO::PARAM_STR);

$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

echo "<script>alert('Visitor info updated successfully');document.location = 'manage-visitors.php';</script>";
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

        <title>Update visitor Details</title>

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
                        <h3 class="text-dark mb-4">Update Visitor Details</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8"><?php
                            	
$id=$_GET['id'];
$status=1;
$ret="select * from visitor where id=:id and status=:status";
$query= $dbh -> prepare($ret);
$query->bindParam(':id',$id, PDO::PARAM_STR);
$query->bindParam(':status',$status, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result1)
{
?>              <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                </div>
                                            <div class="card-body">
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                                    
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>FName</strong></label>
                                                                <input type="text" value="<?php echo htmlentities($result1->f_name);?>" class="form-control" name="f_name" required id="cell_name">
                                
                                                            </div>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>MName</strong></label>
                                                                <input type="text" value="<?php echo htmlentities($result1->m_name);?>" class="form-control" name="m_name" required id="cell_name">
                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>LName</strong></label>
                                                                <input type="text" value="<?php echo htmlentities($result1->l_name);?>" name="l_name" class="form-control" required id="cell_name">
                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Contact</strong></label>
                                                                <input type="text" value="<?php echo htmlentities($result1->contact);?>" name="contact" minlenght="10" maxlength="10" class="form-control" required id="cell_name">
                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Prisoner name</strong></label>
                                                                <select class="form-control"  name="prisoner_id" required>
                 
                  <?php $ret="select id, fname,mname,lname from prisoners";
                  $query= $dbh -> prepare($ret);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>
                  <option value="<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->mname);?> <?php echo htmlentities($result->lname);?></option>
                  <option value="">Select Prisoner Here </option>
                  <?php }} ?>

                  </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="update">Update
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

                    
<?php } }?>

                </div>
                <!-- End of Main Content -->

             
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