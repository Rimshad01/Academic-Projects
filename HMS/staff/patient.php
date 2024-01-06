<?php
session_start();
?>

<link rel="stylesheet" href="../style.css">
    <?php
    include ("../include/header.php");
    include ("../include/navbar.php");

    include ("../config/condb.php");
    ?>



<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-2" style="margin-left: -30px;">
        <?php
            include ("sidenav.php");
        ?>
        <div class="col-md-10">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-center">All patient</h5>

                        
                        <?php
                        $dt = $_SESSION['patient'];
                        $query = "SELECT * FROM patient WHERE name != '$dt'";
                        $res = mysqli_query($con, $query);

                        
                        $output = "
                        <table class='table table-responsive table-bordered'>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Disease</th>
                        <th>Age</th>
                        <tr>
                        ";
                        if(mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan='7' class='text-center'>No New patient</td></tr>";
                        }

                        while ($row = mysqli_fetch_array($res)){
                            $id = $row['id'];
                            $username = $row['name'];
                            $add = $row['City'];
                            $cont = $row['phone'];
                            $age = $row['age'];
                            $sick = $row['disease'];

                            $output .= "
                            <tr>
                            <td>$id</td>
                            <td>$username</td>
                            <td>$add</td>
                            <td>$cont</td>
                            <td>$sick</td>
                            <td>$age</td>
                            ";
                        }

                        $output .= "
                        </tr>
                        </table>
                        ";

                        echo $output;


                        if(isset($_GET['id'])){
                            $id = $_GET['id'];

                            $query = "DELETE FROM patient WHERE id = '$id'";
                            mysqli_query($con,$query);
                        }

                        ?>

                        

                            
                            

                    </div>
                    <div class="col-md-6">
                        <?php
                        if(isset($_POST['add'])) {
                            $uname = $_POST['uname'];
                            $add = $_POST['add'];
                            $cont = $_POST['cont'];
                            $sick = $_POST['sick'];
                            $age = $_POST['age'];

                            $error = array ();

                            if(empty($uname)){
                                $error['u'] = "Enter patient Name";
                            }
                            else if(empty($add)){
                                $error['u'] = "Enter patient Address";
                            }
                            else if(empty($cont)){
                                $error['u'] = "Enter patient Contact";
                            }
                            else if(empty($sick)){
                                $error['u'] = "Enter patient Disease";
                            }
                            else if(empty($age)){
                                $error['u'] = "Enter patient Age";
                            }

                            if(count($error) ==0){
                                $q = "INSERT INTO patient(name, address, phone, disease, age) VALUES ('$uname','$add','$cont','$sick','$age')";

                                $result = mysqli_query($con,$q);
                            }
                        }

                        if (isset($error['u'])){
                            $er = $error['u'];

                            $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
                        }
                        else{
                            $show = "";
                        }
                        ?>
                        <h5 class="text-center">Add patient</h5>
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <?php echo $show; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Name">
                                <input type="text" name="add" class="form-control mt-2" autocomplete="off" placeholder="Address">
                                <input type="text" name="cont" class="form-control mt-2" autocomplete="off" placeholder="Phone Number">
                                <input type="text" name="sick" class="form-control mt-2" autocomplete="off" placeholder="Disease">
                                <input type="text" name="age" class="form-control mt-2" autocomplete="off" placeholder="Age">
                                <input type="submit" class="mt-2 btn btn-primary" name="add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>