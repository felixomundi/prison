<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} {
    include('dbconnection.php');
    if (isset($_POST['submit'])) {        
       
        $prison_id = $_POST['prison_id'];
        $cell_name = $_POST['cell_name'];
        $cell_number = $_POST['cell_number'];
        $seater = $_POST['seater'];
        $cell_type = $_POST['cell_type'];        
        $status=1;
        $query=mysqli_query($con, "INSERT INTO cells(prison_id,cell_number,cell_name,cell_type,seater,status) VALUES('$prison_id','$cell_number','$cell_name','$cell_type','$seater','$status')");

    if ($query) {
        echo "<script>alert('You have successfully registered a cell');</script>";
        echo "<script type='text/javascript'> document.location ='manage-cell.php'; </script>";
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

        <title>Add cell</title>

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
                        <h3 class="text-dark mb-4">Add cell</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">

                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold">Add cell</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">


                                                <div class="form-row">
                                                        
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="title1"><strong>Prison Type </strong></label>
                                                                    <select class="form-control" name="prison_id" required>
                  <option value=""> --Select prison Type-- </option>
                  <?php $ret="select prison_id, type from prisons";
                  $query= $dbh -> prepare($ret);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>
                  <option value="<?php echo htmlentities($result->prison_id);?>"><?php echo htmlentities($result->type);?></option>
                  <?php }} ?>
                  </select>
    
                                                                </div>
                                                            </div>
                                                                </div>


                                                    <div class="form-row">
                                                        
                                                    <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Cell Type</strong></label>
                                                                <select class="form-control" name="cell_type"  required="true">
                                                                    <option value="">Select Type</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Others">Others</option>
                                                                    </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Cell Name </strong></label>
                                                                <input type="text" class="form-control" name="cell_name" required>
                                                                                                   </div>
                                                        </div>
                                                    </div>

                                     
                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label><strong>Select Seater</strong></label>
                                        <Select name="seater" class="form-control" required>
                                        <option value="">Select Seater</option>
                                        <option value="1">Single Seater</option>
                                        <option value="2">Two Seater</option>
                                        <option value="3">Three Seater</option>
                                        <option value="4">Four Seater</option>
                                        <option value="5">Five Seater</option>
                                        </Select>
                                        </div>
                                        </div>

                                                        
                                                         
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Cell Number</strong></label>
                                                                <input type="number" class="form-control" name="cell_number" required="true">
                                                                    
                                                            </div>
                                                        </div>
                                                    </div>              



                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="submit">Post
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