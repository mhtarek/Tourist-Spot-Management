<?php 
session_start();
    include_once '../include/class.user.php';
    $user = new User();
    $uid = $_SESSION['uid'];
    if (!$user->get_session()){
       header("location:../login.php");
    }
    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:../login.php");
    }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
       <link rel="stylesheet" href="../style.css" />
  </head>

  <body>
    <center>
    <div id="container" class="container">
      <div id="header">
        <a href="homeAdmin.php?q=logout">LOGOUT</a>
      </div>
      <div id="main-body">
        <br/>
        <br/>
        <br/>
        <br/>
        <h1>
                  Hello <?php $user->get_fullname($uid); ?>
    			</h1>
      </div>
      <div>
        <a href="addSpots.php"><button>Add Spots</button></a>
        <a href="viewSpotsAdmin.php"><button>View Spots</button></a>
        <a href="viewUsers.php"><button>View Users</button></a>
        <a href="registrationAdmin.php"><button>Register new user</button></a>
      </div>
      <div id="footer"></div>
    </div>
    </center>
  </body>

</html>