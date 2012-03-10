<?php 
include_once('./inc/config.inc');
include_once('./inc/msql_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Live Streaming</title>
		<link rel="stylesheet" href="http://<?php print $url_hostname; ?>/vlcweb/style.css" type="text/css" />
	</head>
	<body>
		<header id="top-grey-bar">
			<div id="header-text">
				<?php include("./inc/header.inc"); ?>
			</div>
		</header>

		<header id="top-grey-head">
			<div id="top-grey-wrap">
				<div id="top-grey-logo" style="margin-top: 5px;">
					<a href="http://<?php print $url_hostname; ?>/vlcweb/livestream/panel.php"><img src="http://<?php print $url_hostname; ?>/vlcweb/logo.png" /></a>
				</div>
			</div>
		</header>
		<div id="main-wrapper">
<?php
if(!isset($_POST['username'])) {
?>
		
			<p>Welcome to the <em>vlc file streaming web interface</em>. Please login below to continue.</p>
			<form action="login.php" method="post" enctype="multipart/form-data">
				Username:<br />
				<input class="tagsInput" style="width: 252px;" placeholder="dicksmcgee" type="text" name="username" id="username" /><br />
				Password:<br />
				<input class="tagsInput" style="width: 252px;" placeholder="anus" type="password" name="password" id="password" /><br />
				<input class="submit-button" type="submit" value="Login" />
			</form>
		
<?
} else {
	$ps = $DBH->prepare("SELECT COUNT(*) FROM users WHERE username = :user AND password = :pass");

	$params = array("user" => $_POST['username'], "pass" => md5($_POST['password']));
	$ps->execute($params);

	$status = (bool) $ps->fetchColumn(0);
	if ($status) {
		$sessionid = md5(rand(5, 300));
		
		$data = array("sessionid" => $sessionid, "username" => $_POST['username']);
		$STH = $DBH->prepare("UPDATE users SET sessionid = :sessionid WHERE username = :username");
		$STH->execute($data);
		
		setcookie("user", $_POST['username']);
		setcookie("sessionid", $sessionid);
		header("Location: http://$url_hostname/vlcweb/panel.php");
	} else {
		echo '<span class="error">Your login was unsuccessful.</span> <p>Please <a href="login.php">try</a> again.';
	}
}
?>
</div>
