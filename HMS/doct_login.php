<?php
session_start();
include ("./config/condb.php");

if(isset($_POST['login']))
{
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($username))
    {
        $error['doctor'] = "Enter Email";
    }
    else if (empty($password))
    {
        $error['doctor'] = "Enter Password";
    }

    if(count($error) == 0)
    {
        $query = "SELECT * FROM doctor WHERE Email='$username' AND password='$password'";

        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) == 1)
        {
            echo "<script>alert('You have Login As an doctor')</script>";


            $_SESSION['doctor'] = $username;
            header("Location:doctor/index.php");
            exit();
        }
        else
        {
            echo "<script>alert('Invalid Username or Password')</script>";
        }
    }
}


include ("./include/header.php");

include ("./include/navbar.php");
?>

<div style="margin-top: 60px;"></div>
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 bg-light mx-auto rounded-3 p-2">
                <form method="POST" class="my-3 ms-5 p-2">
                    <div>
                        <?php
                        if(isset($error['doctor']))
                        {
                            $sh = $error['doctor'];

                            $show = "<h4 class='alert alert-danger w-75'>$sh</h4>";
                        }
                        else
                        {
                            $show = "";
                        }
                        echo $show;
                        ?>
                    </div>
                    <div class="form-group p-3 bg-body-secondary rounded-3 w-75">
                <h5 class="text-center fs-3 fw-bold mb-5">Doctor Login</h5>
                        <input type="email" placeholder="User Name" class="form-control" name="uname">
                        <div class="form-group mt-3">
                        <input type="password" placeholder="Password" class="form-control" name="pass">
                        </div>
                        <input type="submit" name="login" value="Login" class="btn btn-primary fw-medium mt-3 w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>