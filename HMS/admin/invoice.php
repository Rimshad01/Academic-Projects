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
                    <div class="col-md-12">
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
                        <th>Price</th>
                        <th style='width: 10%;'>Action</th>
                        <tr>
                        ";
                        if(mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td colspan='8' class='text-center'>No New patient</td></tr>";
                        }

                        while ($row = mysqli_fetch_array($res)){
                            $id = $row['id'];
                            $username = $row['name'];
                            $pri = $row['price'];

                            $output .= "
                            <tr>
                            <td>$id</td>
                            <td>$username</td>
                            <td>$pri</td>
                            <td>
                                <a href='patient.php?id=$id'><button id='$id' class='btn btn-danger remove'>Remove</button></a>
                            </td>
                            ";
                        }

                        $output .= "
                        </tr>
                        </table>
                        ";

                        echo $output;


                        if(isset($_GET['price'])){
                            $price = $_GET['price'];

                            $query = "DELETE FROM patient WHERE price = '$price'";
                            mysqli_query($con,$query);
                        }

                        ?>

                        

                            
                            

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>