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
<?php include_once('../inc/header.inc'); ?>

<?php include_once('../inc/header_grey.inc'); ?>
<?php
// if it is, spit out the page.
if ($status) {
$cookie_username = $_COOKIE['user'];
$stmt = $DBH->prepare('UPDATE users SET hostname = :hostname, incport = :incport, bcastport = :bcastport, mountpoint = :mountpoint, exmountpoint = :exmountpoint WHERE username = :user');
$stmt->bindParam(':user', $cookie_username);
$stmt->bindParam(':hostname', $_POST['host']);
$stmt->bindParam(':incport', $_POST['port']);
$stmt->bindParam(':bcastport', $_POST['export']);
$stmt->bindParam(':mountpoint', $_POST['mount']);
$stmt->bindParam(':exmountpoint', $_POST['exmount']);
$stmt->execute();
?>
		<div id="top-yellow-alert">
			<strong>up ma ass</strong>
		</div>

		<div id="main-wrapper">
			<p><?php print $_COOKIE['user'] ?>, your settings have been saved. <a href="panel.php">Go back</a> to the panel.</p>
		</div>
	</body>
</html>
<?php
} else {
	// and if it aint, you tell em to fuck off.
	echo 'Fuck off. <br /> <a href="login.php">Go</a> login.';
}
?>
