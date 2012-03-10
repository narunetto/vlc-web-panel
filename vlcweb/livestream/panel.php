<?php
include_once('../inc/config.inc');
// here comes the mysql, nigger!
include_once('../inc/msql_connect.php');

// check to see if login session is legit.
$data = array("sessionid" => $_COOKIE['sessionid']);
$STH = $DBH->prepare('SELECT COUNT(*) FROM users WHERE sessionid = :sessionid');
$STH->execute($data);
$status = (bool) $STH->fetchColumn(0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Live Streaming</title>
		<link rel="stylesheet" href="<?php print $stylesheet_url; ?>" type="text/css" />
	</head>
	<body>
		<header id="top-grey-bar">
			<div id="header-text">
				<?php include("../inc/header.inc"); ?>
				<div style="float:right;"><a href="http://<?php print $url_hostname; ?>/vlcweb/livestream/logout.php">Log Out</a>
			</div>
		</header>

		<header id="top-grey-head">
			<div id="top-grey-wrap">
				<div id="top-grey-logo" style="margin-top: 5px;">
					<a href="http://<?php print $url_hostname; ?>/vlcweb/livestream/panel.php"><img src="http://<?php print $url_hostname; ?>/vlcweb/logo.png" /></a>
				</div>
			</div>
		</header>
<?php
// if it is, spit out the page.
if ($status) {
$cookie_username = $_COOKIE['user'];
$stmt = $DBH->prepare('SELECT * FROM users WHERE username = :user');
$stmt->bindParam(':user', $cookie_username);
$stmt->execute();
$count = 0;
while ($row = $stmt->fetch ()) {
?>
		<div id="top-yellow-alert">
			<strong>up ma ass</strong>
		</div>

		<div id="main-wrapper">
			<p><strong>Hello, <?php print $row['username'] ?>!</strong></p>
			<p>Welcome to the new streaming panel! It now uses a better user system using PDO/mySQL and allows you to edit your settings permanently if needed.</p>
			<p><strong>Helpful Links:</strong> <a href="http://<?php print $url_hostname; ?>/misc/streaming-kit.7z">Streaming Kit</a> | <a href="../hooner.exe">the streaming hooner</a> | <a href="edit.php">Edit Stream Settings</a>
			<form action="start-stream.php" method="post" enctype="multipart/form-data">
				Your Hostname/IP:<br />
				<input class="tagsInput" style="width: 252px;" value="<?php print $row['hostname'] ?>" type="text" name="host" id="hostname" /><br />
				Incoming Info:<br />
				<div class="inputTitle">PORT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MOUNT POINT</div>
				<input class="tagsInput" style="width: 34px;" value="<?php print $row['incport'] ?>" type="text" name="port" id="vwidth" /><input class="tagsInput" style="width: 200px;" value="<?php print $row['mountpoint'] ?>" type="text" name="mount" id="filename" /><br />
				Outgoing Info:<br />
				<div class="inputTitle">PORT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MOUNT POINT</div>
				<input class="tagsInput" style="width: 34px;" value="<?php print $row['bcastport'] ?>" type="text" name="export" id="vheight" /><input class="tagsInput" style="width: 200px;" value="<?php print $row['exmountpoint'] ?>" type="text" name="exmount" id="filename" /><br />
				<input type="hidden" name="username" value="<?php print $cookie_username ?>" />
				<input class="submit-button" type="submit" value="Start Streamin Cunt" />
			</form>
		</div>
	</body>
</html>
<?php
$count++;
}
} else {
	// and if it aint, you tell em to fuck off.
	echo 'Fuck off. <br /> <a href="login.php">Go</a> login.';
}
?>
