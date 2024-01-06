<?php
session_start();
?>

<link rel="stylesheet" href="../style.css">
<?php
include("../include/header.php");
include("../include/navbar.php");

include("../config/condb.php");
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
                            <div class="col-md-12">
                                <h5 class="text-center">All Staff</h5>


                                <?php
                                $dt = $_SESSION['Staff'];
                                $query = "SELECT * FROM staff WHERE name != '$dt'";
                                $res = mysqli_query($con, $query);


                                $output = "
                        <table class='table table-responsive table-bordered'>
                        <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Occupation</th>
                        <th>Email</th>
                        <th>Sallary</th>
                        <tr>
                        ";
                                if (mysqli_num_rows($res) < 1) {
                                    $output .= "<tr><td colspan='6' class='text-center'>No New Staff</td></tr>";
                                }

                                while ($row = mysqli_fetch_array($res)) {
                                    $id = $row['id'];
                                    $username = $row['name'];
                                    $email = $row['email'];
                                    $occ = $row['occupation'];
                                    $sal = $row['sallary'];

                                    $output .= "
                            <tr>
                            <td>$id</td>
                            <td>$username</td>
                            <td>$occ</td>
                            <td>$email</td>
                            <td>$sal</td>
                            ";
                                }

                                $output .= "
                        </tr>
                        </table>
                        ";

                                echo $output;


                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];

                                    $query = "DELETE FROM staff WHERE id = '$id'";
                                    mysqli_query($con, $query);
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>