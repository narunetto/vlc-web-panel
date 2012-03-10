<?php
include_once('../inc/config.inc');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Killing VLC</title>
		<link rel="stylesheet" href="http://<?php print $url_hostname; ?>/vlcweb/style.css" type="text/css" />
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
error_reporting(0);
$pid = $_GET['pid'];
echo "Killing PID $pid ... ";
$asshole = exec("ps -u www-data | grep vlc");
$asshole2 = $asshole[0];
if ($asshole2 == null) {
	die("Error: No VLC process is running.");
} else {
	exec("kill $pid");
}
echo "done.<br /><br /><a href=\"panel.php\">Go </a>back to panel.";
?>
		</div>	
	</body>
</html>
