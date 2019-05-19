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
	if(isset($_GET['delete_id']))
	{
		$id=$_GET['delete_id'];
		$res=$con->deleteSpot($id);
		if($res)
		{
			?>
			<script>
			alert('Record Deleted ...')
	        window.location='viewSpotsAdmin.php'
	        </script>
			<?php
		}
		else
		{
			?>
			<script>
			alert('Record can\'t Deleted !!!')
	        window.location='viewSpotsAdmin.php'
	        </script>
			<?php
		}
	}
?>