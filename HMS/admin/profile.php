<?php
session_start();
?>

<link rel="stylesheet" href="../style.css">
<?php
include("../include/header.php");
include("../include/navbar.php");

include("../config/condb.php");

$ad = $_SESSION['admin'];

$query = "SELECT * FROM admin WHERE name = '$ad'";

$res = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($res)) {
    $username = $row['name'];
    $profile = $row['image'];
}
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php
                include("sidenav.php");
                ?>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $username; ?> Profile</h4>

                                <?php

                                if (isset($_POST['update'])) {
                                    $profile = $_FILES['img']['name'];

                                    if (empty($profile)) {
                                    } else {
                                        $query = "UPDATE admin SET image = '$profile' WHERE name = '$ad'";

                                        $result = mysqli_query($con, $query);

                                        if ($result) {
                                            move_uploaded_file($_FILES['img']['tmp_name'], "img/$profile");
                                        }
                                    }
                                }

                                ?>

                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    echo "<img src='img/$profile' class='col-md-12 w-50' style='height: 200px;'>"
                                    ?>

                                    <br><br>
                                    <div class="form-group">
                                        <input type="file" name="img" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update" value="UPDATE" class="btn btn-primary">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    if(isset($_POST['update_pass'])) {
                                        $old_pass = $_POST['old_pass'];
                                        $new_pass = $_POST['new_pass'];
                                        $con_pass = $_POST['con_pass'];

                                        $error = array();

                                        $old = mysqli_query($con, "SELECT * FROM admin WHERE name = '$ad'");

                                        $row = mysqli_fetch_array($old);
                                        $pass = $row['password'];

                                        if(empty($old_pass)){
                                            $error['p'] = "Enter Your Current Password";
                                        }
                                        else if(empty($new_pass)){
                                            $error['p'] = "Enter New Password";
                                        }
                                        else if(empty($con_pass)){
                                            $error['p'] = "Enter Confirm Password";
                                        }
                                        else if($old_pass != $pass){
                                            $error['p'] = "Invalid Current Password";
                                        }
                                        else if($new_pass != $con_pass){
                                            $error['p'] = "Both Password Does not match";
                                        }

                                        if(count($error)==0){
                                            $query = "UPDATE admin SET password = '$new_pass' WHERE name= '$ad'";

                                            mysqli_query($con,$query);
                                        }

                                        
                                    }

                                    if (isset($error['p'])){
                                        $e = $error['p'];

                                        $show = "<h5 class='text-center alert alert-danger'>$e</h5>";
                                    }
                                    else {
                                        $show = "";
                                    }
                                ?>
                                <form method="post">
                                    <h5 class="text-center my-4">Change Password</h5>
                                    <div>
                                        <?php
                                            echo $show;
                                        ?>
                                    </div>
                                    <br><br>
                                    <div class="form-group">
                                    <input type="password" name="old_pass" class="form-control" placeholder="Current Password">
                                        <br>
                                        <input type="password" name="new_pass" class="form-control" placeholder="Password">
                                        <br>
                                        <input type="password" name="con_pass" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <br>
                                    <input type="submit" name="update_pass" value="UPDATE" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>