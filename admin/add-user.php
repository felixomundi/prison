<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['signup'])) {
        $fname = $_POST['fname'];
        $username = $_POST['username'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;

        $sql = "INSERT INTO users(`username`,`fname`,`lname`,`email`,`password`,`status`) VALUES(:username,:fname,:lname,:email,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Registration successful.The staff can now login with your provided credentials');document.location = 'manage-users.php'</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
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

<title>Add user</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check-availability.php",
                    data: 'email=' + $("#email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>

        <script type="text/javascript">
            function valid() {
                if (document.signup.password.value !== document.signup.passwordrepeat.value) {
                    alert("Password and Repeat Password field didn\'t match!!");
                    document.signup.passwordrepeat.focus();
                    return false;
                }
                return true;
            }
        </script>

        <script>
            function checkAvailability() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "check-availability.php",
                    data: 'email=' + $("#email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {
                    }
                });
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                function disablePrev() {
                    window.history.forward();
                }

                window.onload = disablePrev();
                window.onpageshow = function (evt) {
                    if (evt.persisted) disableBack()
                }
            });
        </script>

        <script type="text/javascript">
            var checkPass = function () {
                var password = document.getElementById('password').value;
                var repassword = document.getElementById('confirm_password').value;
                var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
                if (password !== "" || password !== null) {
                    if (password.match(regexpass)) {
                        document.getElementById('checkpass').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                        if (password === repassword) {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'password matched';
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('message').style.color = 'red';
                            document.getElementById('message').innerHTML = 'password not matching';
                            document.getElementById('submit').disabled = true;
                        }
                    } else {
                        document.getElementById('checkpass').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
                        document.getElementById('submit').disabled = true;
                    }
                } else {
                    document.getElementById('checkpass').innerHTML = 'Empty password';
                    document.getElementById('submit').disabled = true;
                }
            };

            var checkfname = function () {
                var fname = document.getElementById('fname').value;
                var fnamevalidation = /^[a-zA-Z ]{2,30}$/;

                if (fname === "" || fname === null || !fname.match(fnamevalidation) || fname.length < 2 || fname.length > 30) {
                    document.getElementById('checkfname').style.color = 'red';
                    document.getElementById('checkfname').innerHTML = 'invalid first name';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (fname.match(fnamevalidation)) {
                        //document.getElementById('checkfname').style.color = 'green';
                        document.getElementById('checkfname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

            var checklname = function () {
                var lname = document.getElementById('lname').value;
                var lnamevalidation = /^[a-zA-Z]{2,15}$/;

                if (lname === "" || lname === null || !lname.match(lnamevalidation) || lname.length < 2 || lname.length > 15) {
                    document.getElementById('checklname').style.color = 'red';
                    document.getElementById('checklname').innerHTML = 'invalid last name';
                    document.getElementById('submit').disabled = true;
                } else {
                    //var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
                    if (lname.match(lnamevalidation)) {
                        //document.getElementById('checklname').style.color = 'green';
                        document.getElementById('checklname').innerHTML = '';
                        document.getElementById('submit').disabled = false;
                    }
                }
            };

        </script>

        <script>
            function validate() {
                var fname = document.signup.fname.value;
                var lname = document.signup.lname.value;
                var email = document.signup.email.value;
                var pass = document.signup.password.value;
                var repass = document.signup.passwordrepeat.value;

                if (fname === "" || fname === null) {
                    document.getElementById('checkfname').innerHTML = 'Invalid First name';
                    return false;
                }
                if (lname === "" || lname === null) {
                    document.getElementById('checklname').innerHTML = 'Invalid Last name';
                    return false;
                }
                if (email === "" || email === null) {
                    //document.getElementById('checkemail').innerHTML = 'Enter your email address';
                    return false;
                }
                if (pass === "" || pass === null) {
                    document.getElementById('checkpass').innerHTML = 'Invalid password';
                    return false;
                }
            }
        </script>
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
<h3 class="text-dark mb-4">Add Staff</h3>
<div class="row mb-3">
<div class="col-lg-8">

<div class="row">
<div class="col">
<div class="card shadow mb-3">
<div class="card-header py-3">
<p class="text-primary m-0 font-weight-bold">Add Staff</p>
</div>
<div class="card-body">
<form class="user" method="post" name="signup" onsubmit="return validate();"
      
novalidate>



<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>First Name</strong></label> 
<input class="form-control"  type="text" id="fname"
                                                   placeholder="First Name" name="fname" autocomplete="off"
                                                   onkeyup="checkfname();">
                                            <span id="checkfname" style="font-size:12px; color: red;"></span>
</div>
</div>

<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>LastName</strong></label> 
<input class="form-control" type="text" id="lname"
                                                   placeholder="Last Name" name="lname" autocomplete="off"
                                                   onkeyup="checklname();">
                                            <span id="checklname" style="font-size:12px; color: red;"></span>
</div>
</div>
</div>



<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Email</strong></label> 
<input class="form-control" type="email" id="email"
                                               aria-describedby="emailHelp" autocomplete="off"
                                               placeholder="Email Address" name="email" onBlur="checkAvailability();">
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                        <span id="checkemail" style="font-size:12px; color: red;"></span>
</div>
</div>


<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>UserName</strong></label> 
<input class="form-control" type="text" required="true"
                                              
                                               placeholder="Enter Staff Username" name="username" >
</div>
</div>
        </div>

<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Password</strong></label><input class="form-control" type="password" id="password"
                                                   placeholder="Password" autocomplete="off" name="password"
                                                   onkeyup="checkPass();">
                                            <span id="checkpass" style="font-size:12px; color: red;"></span>
</div>
</div>
<div class="col-md-8 col-lg-6 col-xl-6">
<div class="form-group">
<label for="title1"><strong>Confirm Password</strong></label> <input class="form-control" type="password"
                                                   id="confirm_password" autocomplete="off" onkeyup='checkPass();'
                                                   placeholder="Repeat Password" name="passwordrepeat">
                                            <span id='message'></span>
                                            <span id="checkrepass" style="font-size:12px; color: red;"></span>
</div>
</div>
</div>




<div class="form-group">
<div class="form-row">
<div class="col-md-12 col-lg-12 col-xl-12">
<div class="form-group"> <button class="btn btn-danger btn-block text-white btn-user" type="submit"
                                            name="signup" id="submit">Register New Staff
                                    </button>
                                    <hr>
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