<?php
session_set_cookie_params(0);
session_start();
include('includes/config1.php');
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else{
if(isset($_POST['update']))
{
$id=$_GET['id'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$contact=$_POST['contact'];
$udate = date('d-m-Y h:i:s', time());
$dob=$_POST['dob'];
$address=$_POST['address'];
$release_date=$_POST['release_date'];
$sql = "UPDATE `prisoners` SET fname=:fname,mname=:mname,lname=:lname,gender=:gender,contact=:contact,updationdate=:udate,dob=:dob, address=:address,release_date=:release_date WHERE id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);        
        $query->bindParam(':mname', $mname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':contact', $contact, PDO::PARAM_STR);
        $query->bindParam(':udate', $udate, PDO::PARAM_STR);        
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':release_date', $release_date, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Prisoner details updated successfully');document.location = 'manage-prisoners.php';</script>";
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

        <title>Update Prisoner Details</title>

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
                        <h3 class="text-dark mb-4">Update Prisoner Details</h3>
                        <div class="row mb-3">
                            <div class="col-lg-8">
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
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 font-weight-bold"><?php echo $row->fname;?> <?php echo $row->lname;?>'s&nbsp;Profile </p>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>First Name</strong></label>
                                                                <input class="form-control" id="title1" type="text"
                                                                       name="fname" value="<?php echo $row->fname;?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Middle Name</strong></label>
                                                                <input class="form-control" type="text"
                                                                value="<?php echo $row->mname;?>"  name="mname" required>
                                                            </div>
                                                        </div>
                                                    </div> 


                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="title1"><strong>Last Name</strong></label>
                                                                <input class="form-control" id="title1" type="text"
                                                                value="<?php echo $row->lname;?>"  name="lname" required>
                                                            </div>
                                                        </div>
<div class="col-md-8 col-lg-6 col-xl-6">
 <div class="form-group">
 <label for="title1"><strong>Gender</strong></label>
<select name="gender" class="form-control" required="required">
<option value="<?php echo $row->gender;?>"> <?php echo $row->gender;?></option>
<option value="">Select Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="others">Others</option>
</select>
</div>
</div>
</div>



<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="grabber"><strong>DOB</strong></label>
<input type="date" name="dob"  class="form-control" value="<?php echo $row->dob;?>" 
required="true">
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="grabber"><strong>Address</strong></label>
<input class="form-control" id="grabber" type="text" name="address" maxlength="40" value="<?php echo $row->address;?>"  
required="true">
</div>
</div>
</div>


<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="grabber"><strong>Contact</strong></label>
<input class="form-control" type="text" name="contact" minlength="10" maxlength="10" value="<?php echo $row->contact;?>"  
required="true">
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="grabber"><strong>Expected Release Date</strong></label>
<input class="form-control" type="date" name="release_date" value="<?php echo $row->release_date;?>"  
required="true">
</div>
</div>
</div>



                                                    <div class="form-row">
                                                        <div class="col-md-8 col-lg-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="insertimage1"><strong>Change prisoner
                                                                                                  image</strong></label>
                                                                                                  <img
src="photo/<?php echo $row->profilepic; ?>"
width="300" height="200" style="border:solid 1px #000"><br><br>
<a href="change-image.php?userid=<?php echo $row->id ?>">Click to Change Prisoner Image</a>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit"
                                                                            name="update">Post
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

                    
<?php } ?>

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
      <?php }?>