<?php
include_once('./inc/config.inc');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>VLC Streaming Heener</title>
		<link rel="stylesheet" href="<?php print $stylesheet_url; ?>" type="text/css" />
	</head>
	<body>
		<header id="top-grey-bar">
			<div id="header-text">
				<strong><em>That piss BETTER NOT BOUNCE or you're a DEAD MOTHER FUCKER.</em></strong>
			</div>
		</header>

		<header id="top-grey-head">
			<div id="top-grey-wrap">
				<div id="top-grey-logo" style="margin-top: 5px;">
					<a href="http://<?php print $url_hostname; ?>/vlcweb/panel.php"><img src="http://<?php print $url_hostname; ?>/vlcweb/logo.png" /></a>
				</div>
			</div>
		</header>

		<div id="main-wrapper">
<?php
// here comes the mysql, nigger!
include_once('./inc/msql_connect.php');

// check to see if login session is legit.
$data = array("sessionid" => $_COOKIE['sessionid']);
$STH = $DBH->prepare('SELECT COUNT(*) FROM users WHERE sessionid = :sessionid');
$STH->execute($data);
$status = (bool) $STH->fetchColumn(0);
if ($status) {
	$pid = $_GET['pid'];
	echo "Killing PID $pid ... ";
	$asshole = exec("ps -u www-data | grep vlc");
	$asshole2 = $asshole[0];
	if ($asshole2 == null) {
		die("Error: No VLC process is running.");
	} else {
		exec("kill $pid");
		$fh = fopen( '/var/www/imcumm.in/vlcweb/livestream/pid/main', 'w' );
		fclose($fh);
	}
	echo "done.<br /><br /><a href=\"panel.php\">Back to home</a>";
} else {
	echo 'NIGGA YOU AINT AUTH\'D. <a href="login.php">Go</a> login.';
}
?>
		</div>	
	</body>
</html>
