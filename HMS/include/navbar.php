<nav class="navbar navbar-expand-lg navi">
  <div class="container">
    <a class="navbar-brand text-white fw-bold" href="./index.php"><i class="fa fa-h-square" aria-hidden="true"></i> Arogya Health Care</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav fw-medium ms-auto mb-2 mb-lg-0">
        <?php
        if(isset($_SESSION['admin']))
        {
          $user = $_SESSION['admin'];
          echo '
        <li class="nav-item">
          <a class="nav-link text-white disabled" href="#">'.$user.'</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white opacity-75" href="logout.php">Logout</a>
        </li>';
        }
        else if($_SESSION['doctor'])
        {
          $user = $_SESSION['doctor'];
          echo '
        <li class="nav-item">
          <a class="nav-link text-white disabled" href="#">'.$user.'</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white opacity-75" href="logout.php">Logout</a>
        </li>';
        }
        else if($_SESSION['staff'])
        {
          $user = $_SESSION['staff'];
          echo '
        <li class="nav-item">
          <a class="nav-link text-white disabled" href="#">'.$user.'</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white opacity-75" href="logout.php">Logout</a>
        </li>';
        }
        else 
        {
          echo '
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="admin_login.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="doct_login.php">Doctor</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link text-white" href="staff_login.php">Staff</a>
          </li> ';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>