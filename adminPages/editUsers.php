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
// data insert code starts here.
if(isset($_GET['edit_id']))
{	
	$id = $_GET['edit_id'];
	$result = $con->selectUsingUserId($id);
}
// data update code starts here.
if(isset($_POST['btn_update']))
{
    $userType = $_POST['userType'];
	$fname = $_POST['fname'];
	$uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $upass = $_POST['upass'];

	
	$id=$_GET['edit_id'];
	$res=$con->updateUserId($id,$userType,$fname,$uname,$uemail,$upass);
	if($res)
	{
		?>
		<script>
		alert('Record updated...');
        window.location='viewUsers.php'
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error updating record...');
        window.location='viewUsers.php'
        </script>
		<?php
	}
}
// data update code ends here.

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
    <form method="post">
    <table align="center">
        <tr>
            <th>User Type</th>
            <td>
              <select name = "userType" required>
                <option value="">--select a type--</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
              </select>
            </td>
          </tr>
        <tr>
            <th>Full Name:</th>
            <td>
              <input type="text" name="fname" value="<?php echo $result['fullname']; ?>" required>
            </td>
        </tr>
        <tr>
            <th>User Name:</th>
            <td>
              <input type="text" name="uname" value="<?php echo $result['uname']; ?>" required>
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
              <input type="email" name="uemail" value="<?php echo $result['uemail']; ?>" required>
            </td>
        </tr>
        <tr>
            <th>Password:</th>
            <td>
              <input type="password" name="upass" value="<?php echo $result['upass']; ?>" required>
            </td>
        </tr>

    <tr>
    <td>
    <button type="submit" name="btn_update"><strong>UPDATE</strong></button></td>
    </tr>
    </table>
    </form>
    </div>
</div>
</center>
</body>
</html>