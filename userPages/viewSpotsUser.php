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

    $spot = new User();
    $table = "spots";
    $res=$spot->selectSpots();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Database Operation Using OOP</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <style type="text/css">
        table,tr,td,th{
            border: 1px solid black;
        }
        th,td{
            padding: 10px
        }
    </style>

</head>
<body>
<center>
<div id="body">
	<div id="content">
        <table align="center">
        <tr>
        <th colspan="5">  <a href="homeUser.php"><img src="../back.jpg" alt="back" height="42" width="42"/></a></th>
        </tr>
         <tr>
        <th>Spot name</th>
        <th>Address</th>
        <th>Picture</th>
        </tr>
        <?php
    	while($row=mysqli_fetch_row($res))
        {
                ?>
                <tr>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                
                <?php $file_name = $row[3]?>
                
                <td><img src="../<?php echo $file_name;  ?>" width="150" height="100"></td>
                
                <?php
        }
        ?>
        </table>
    </div>
</div>
</center>
</body>
</html>