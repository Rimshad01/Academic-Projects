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
                        <th style='width: 10%;'>Action</th>
                        <tr>
                        ";
                        if(mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan='6' class='text-center'>No New Staff</td></tr>";
                        }

                        while ($row = mysqli_fetch_array($res)){
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
                            <td>
                                <a href='Staff.php?id=$id'><button id='$id' class='btn btn-danger remove'>Remove</button></a>
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

                            $query = "DELETE FROM staff WHERE id = '$id'";
                            mysqli_query($con,$query);
                        }

                        ?>

                        

                            
                            

                    </div>
                    <div class="col-md-6">
                        <?php
                        if(isset($_POST['add'])) {
                            $uname = $_POST['uname'];
                            $pass = $_POST['pass'];
                            $occ = $_POST['occ'];
                            $email = $_POST['email'];
                            $sal = $_POST['sal'];
                            $image = $_FILES['img']['name'];

                            $error = array ();

                            if(empty($uname)){
                                $error['u'] = "Enter Staff Username";
                            }
                            else if(empty($pass)){
                                $error['u'] = "Enter Staff Passowrd";
                            }
                            else if(empty($occ)){
                                $error['u'] = "Enter Staff Occupation";
                            }
                            else if(empty($email)){
                                $error['u'] = "Enter Staff Email";
                            }
                            else if(empty($sal)){
                                $error['u'] = "Enter Staff Sallary";
                            }
                            else if(empty($image)){
                                $error['u'] = "Add Staff Picture";
                            }

                            if(count($error) ==0){
                                $q = "INSERT INTO staff(name, password, email, sallary, occupation, image) VALUES ('$uname','$pass','$email','$sal','$occ','$image')";

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
                        <h5 class="text-center">Add Staff</h5>
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <?php echo $show; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="User Name">
                                <input type="password" name="pass" class="form-control mt-2" autocomplete="off" placeholder="Password">
                                <select class="form-select mt-2" type="file" name="occ" aria-label="Default select example">
                                <option value="">Occupation</option>
                                <option value="Epidemiologist">Nurse</option>
                                <option value="Psychiatrist">Clerk</option>
                                <option value="Cardiologist">Reception</option>
                                </select>
                                <input type="text" name="email" class="form-control mt-2" autocomplete="off" placeholder="Email">
                                <input type="text" name="sal" class="form-control mt-2" autocomplete="off" placeholder="Sallary">
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