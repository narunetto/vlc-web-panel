<?php
include_once('./inc/msql_connect.php');

if(!isset($_POST['submit'])) {
?>
	<h2>kool super sekret user signup</h2>
	<form action="sekret_signup.php" method="post" enctype="multipart/form-data">
		Username: <input style="width: 200px;" type="text" name="username" id="username" /><br />
		Password: <input style="width: 200px;" type="password" name="password" id="password" /><br />
		<br />
		Signup Password: <input style="width: 200px;" type="password" name="signuppassword" id="signuppassword" /><br />
		
		<input type="submit" name="submit" value="FUCK" />
	</form>
<?php
} else {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$signuppassword = $_POST['signuppassword'];
	
	if ($signuppassword == "niggerdick2003") {
		$data = array( 'username' => $username, 'password' => md5($password) );

		$STH = $DBH->prepare("INSERT INTO users (username, password) value (:username, :password)");
		$STH->execute($data);
		echo "USER CREATED, ASS";
	} else {
		echo "NIGGA YOU GOT THE SIGNUP PASSWORD WRONG";
	}
}
?>
