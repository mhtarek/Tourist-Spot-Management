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
    // data insert code starts here.
    if(isset($_POST['submit']))
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
        $res = $spot->insertSpot($name,$location,$pic);
    	if($res)
    	{
    		?>
    		<script>
        		alert('Spot inserted...');
                window.location='homeAdmin.php';
            </script>
    		<?php
    	}
    	else
    	{
    		?>
    		<script>
        		alert('error inserting record...');
                window.location='homeAdmin.php';
            </script>
    		<?php
    	}
    }
// data insert code ends here.

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Database Operation Using OOP</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<style>
body {
  background-color: lightblue;
}
</style>
</head>
<body>
<center>
<div id="header">
	<div id="content">
    <label>Add spots</label>
    </div>
</div>
<div id="body">
	<div id="content">
    <form name = "field" action = "" method = "POST" enctype = "multipart/form-data">
    <table align="center" class="table table-bordered table-dark">
	<thead>
	<tr>
    <th colspan="5">  <a href="homeAdmin.php"><img src="../back.jpg" alt="back" height="50" width="50"/></a></th>
    </tr>
	</thead>
    
    <tbody>
    <tr>
    <td><input type="text" name="name" placeholder="spotName" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="location" placeholder="location" required /></td>
    </tr>
    <tr>
    <td><input type = "file" name = "image"/></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="submit"><strong>SAVE</strong></button></td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
</div>
</center>
</body>
</html>