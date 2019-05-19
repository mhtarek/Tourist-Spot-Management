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
	$result = $con->selectUsingId($id);
}
// data update code starts here.
if(isset($_POST['btn_update']))
{
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $tmp = explode('.',$file_name);
    $file_ext=strtolower(end($tmp ));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152) {
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true) {
       move_uploaded_file($file_tmp,"../images/".$file_name);
       echo "Success";
    }else{
       print_r($errors);
    }

	$name = $_POST['name'];
	$location = $_POST['location'];
    $pic = 'images/'.$file_name;
	
	$id=$_GET['edit_id'];
	$res=$con->updateSpot($id,$name,$location,$pic);
	if($res)
	{
		?>
		<script>
		alert('Record updated...');
        window.location='viewSpotsAdmin.php'
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error updating record...');
        window.location='viewSpotsAdmin.php'
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
    <form method="post" enctype = "multipart/form-data">
    <table align="center">
    <tr>
    <td><input type="text" name="name" placeholder="First Name" value="<?php echo $result['name']; ?>"  /></td>
    </tr>
    <tr>
    <td><input type="text" name="location" placeholder="email" value="<?php echo $result['location']; ?>" /></td>
    </tr>
    <tr>
    <td><input type="file" name="image" placeholder="image" value="<?php echo $result['image']; ?>" /></td>
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