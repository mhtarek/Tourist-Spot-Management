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

    $con = new User();
    $table = "users";
    $res=$con->selectUsers();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Database Operation Using OOP</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="body">
	<div id="content">
        <table align="center">
        <tr>
        <th colspan="5">  <a href="homeAdmin.php"><img src="b_back.jpg" alt="back" height="42" width="42"/></a></th>
        </tr>
         <tr>
            <th>User ID</th>
            <th>User Type</th>
            <th>Username</th>
            <th>Full name</th>
            <th>Email</th>
            <th colspan="2">edit/delete</th>
        </tr>
        <?php
    	while($row=mysqli_fetch_row($res))
    	{
    			?>
                <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                </tr>
                <?php
    	}
    	?>
        </table>
    </div>
</div>
</center>
</body>
</html>