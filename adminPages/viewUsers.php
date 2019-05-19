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
        <style type="text/css">
        table,tr,td,th{
            border: 1px solid black;
        }
        th,td{
            padding: 10px
        }
    </style>

    <script type="text/javascript">
        function del_id(id)
        {
        	if(confirm('Sure to delete this record ?'))
        	{
        		window.location = 'deleteUsers.php?delete_id='+id
        	}
        }
        function edit_id(id)
        {
        	if(confirm('Sure to edit this record ?'))
        	{
        		window.location = 'editUsers.php?edit_id='+id
        	}
        }
    </script>


</head>
<body>
<center>
<div id="body">
	<div id="content">
        <table align="center">
        <tr>
        <th colspan="7">  <a href="homeAdmin.php"><img src="../back.jpg" alt="back" height="42" width="42"/></a></th>
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
                <td><?php echo $row[3]; ?></td>
    			<td align="center"><a href="javascript:edit_id(<?php echo $row[0]; ?>)"><img src="b_edit.png" alt="EDIT" /></a></td>
                <td align="center"><a href="javascript:del_id(<?php echo $row[0]; ?>)"><img src="b_drop.png" alt="DELETE" /></a></td>
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