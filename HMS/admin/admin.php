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
                        <h5 class="text-center">All Admin</h5>

                        
                        <?php
                        $ad = $_SESSION['admin'];
                        $query = "SELECT * FROM admin WHERE name != '$ad'";
                        $res = mysqli_query($con, $query);

                        
                        $output = "
                        <table class='table table-responsive table-bordered'>
                        <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th style='width: 10%;'>Action</th>
                        <tr>
                        ";
                        if(mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan='3' class='text-center'>No New Admin</td></tr>";
                        }

                        while ($row = mysqli_fetch_array($res)){
                            $id = $row['id'];
                            $username = $row['name'];

                            $output .= "
                            <tr>
                            <td>$id</td>
                            <td>$username</td>
                            <td>
                                <a href='admin.php?id=$id'><button id='$id' class='btn btn-danger remove'>Remove</button></a>
                            </td>
                            ";
                        }

                        $output .= "
                        </tr>
                        </table>
                        ";

                        echo $output;


                        if(isset($_GET['id'])){
                            $id = $_GET['id'];

                            $query = "DELETE FROM admin WHERE id = '$id'";
                            mysqli_query($con,$query);
                        }

                        ?>

                        

                            
                            

                    </div>
                    <div class="col-md-6">
                        <?php
                        if(isset($_POST['add'])) {
                            $uname = $_POST['uname'];
                            $pass = $_POST['pass'];
                            $image = $_FILES['img']['name'];

                            $error = array ();

                            if(empty($uname)){
                                $error['u'] = "Enter Admin Username";
                            }
                            else if(empty($pass)){
                                $error['u'] = "Enter Admin Passowrd";
                            }
                            else if(empty($image)){
                                $error['u'] = "Add Admin Picture";
                            }

                            if(count($error) ==0){
                                $q = "INSERT INTO admin (name,password,image) VALUES ('$uname','$pass','$image')";

                                $result = mysqli_query($con,$q);

                                if($result) {
                                    move_uploaded_file($_FILES['img']['tmp_name'],"img/$image");
                                }
                                else{

                                }
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
                        <h5 class="text-center">Add Admin</h5>
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <?php echo $show; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="User Name">
                                <input type="password" name="pass" class="form-control mt-2" autocomplete="off" placeholder="Password">
                                <input type="file" name="img" class="form-control mt-2">
                                <input type="submit" class="mt-2 btn btn-primary" name="add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>