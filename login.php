<?php 
session_start();
include_once 'include/class.user.php';
$user = new User();
if (isset($_POST['submit'])) {
		setcookie("user", $_POST['emailusername'] , time()+60*60,'/http://localhost/480-backend/adminPages/homeAdmin.php');
		        

		extract($_POST);   
	    $login = $user->check_login($emailusername, $password,$userType);

	    if ($login and $userType=='Admin') {
	        // Registration Success
	       header("location:adminPages/homeAdmin.php");
	    }else if($login and $userType=='User'){
         header("location:userPages/homeUser.php");
      } else {
	        // Registration Failed
	        echo 'Wrong username or password';
	    }
	}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>OOP Login Module</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
  	<ul>
	  <li><a class="active" href="login.php">Home</a></li>
	  <li><a href="SpotsPublic.php">Spots</a></li>
	</ul>
  
    <div id="container" class="container">
      <h1>Login Here</h1>
      <form action="" method="post" name="login">

        <table class="table " width="400">
          <tr>
            <th>User Type</th>
            <td>
              <select name = "userType">
                <option value="-1">--select a type--</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
              </select>
            </td>
          </tr>
          <tr>
            <th>UserName or Email:</th>
            <td>
              <input type="text" name="emailusername" required>
            </td>
          </tr>
          <tr>
            <th>Password:</th>
            <td>
              <input type="password" name="password" required>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="btn" type="submit" name="submit" value="Login" onclick="return(submitlogin());">
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a href="userPages/registrationUser.php">Register new user</a></td>
          </tr>

        </table>
      </form>
    </div>
    <script>
      function submitlogin() {
        var form = document.login;
        if (form.userType.value == "-1") {
          alert("select a type");
          return false;
        }else if (form.emailusername.value == "") {
          alert("Enter email or username.");
          return false;
        } else if (form.password.value == "") {
          alert("Enter password.");
          return false;
        } 
      }
    </script>


</body>