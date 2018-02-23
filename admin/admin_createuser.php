<?php
	require_once('phpscripts/config.php');
	confirm_logged_in();

	if(isset($_POST['submit'])){
		$fname = trim($_POST['fname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$email = trim($_POST['email']);
		$lvllist = trim($_POST['lvllist']);
		if(empty($lvllist)){
			$message = "Please select a user level";
		}else{
			$result = createUser($fname, $username, $password, $email, $lvllist);
			$message = $result;
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create User</title>
</head>
<body>
<h2>Create User</h2>
<?php if(!empty($message)){echo $message;}?>
<form action="admin_createuser.php" method="post">
<label>First Name:</label>
<input type="text" name="fname" value="">
<label>User Name:</label>
<input type="text" name="username" value="">
<!--<label>Password:</label>
<input type="text" name="" value="">-->
<label>Email</label>
<input type="text" name="email" value="">
<select name="lvllist">
	<option value="">Select User Level</option>
	<option value="3">Web Admin</option>
	<option value="2">Web Master</option>
	<option value="1">Web User</option>
</select>
<input type="submit" name="submit" value="SUBMIT">
</form>
</body>
</html>
