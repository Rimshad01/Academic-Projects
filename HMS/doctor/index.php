<?php
session_start();
?>

<link rel="stylesheet" href="../style.css">
    <?php
    include ("../include/header.php");

    include ('../include/navbar.php');

    include ("../config/condb.php");
    ?>


<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
            <?php
                include ("sidenav.php");
            ?>
            <div class="col-md-10 ms-auto">
                <h4 class="my-2 mt-5 fw-bolder">Staff Dashboard</h4>
                <div class="col-md-12 my-1">
                    <div class="row">
                        <div class="col-md-3 bg-warning mx-2 rounded-2" style="height: 130px;">
                            <div class="row">
                                <div class="col-md-8">
                                <?php
                                     $dc = mysqli_query($con, "SELECT * FROM staff");

                                     $num = mysqli_num_rows($dc);
                                    ?>
                                    <h5 class="my-2 text-white text-center" style="font-size: 30px;"><?php echo $num; ?></h5>
                                    <h5 class="text-white">Total</h5>
                                    <h5 class="text-white">staff</h5>
                                </div>
                                <div class="col-md-4">
                                    <a href="#"><i class="fa fa-user-md fa-3x my-4" style="color: white;"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 bg-info mx-2 rounded-2" style="height: 130px;">
                            <div class="row">
                                <div class="col-md-8">
                                <?php
                                     $pt = mysqli_query($con, "SELECT * FROM patient");

                                     $num = mysqli_num_rows($pt);
                                    ?>
                                    <h5 class="my-2 text-white text-center" style="font-size: 30px;"><?php echo $num; ?></h5>
                                    <h5 class="text-white">Total</h5>
                                    <h5 class="text-white">Patient</h5>
                                </div>
                                <div class="col-md-4">
                                    <a href="#"><i class="fa fa-procedures fa-3x my-4" style="color: white;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>