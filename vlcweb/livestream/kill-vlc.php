<?php
include_once('../inc/config.inc');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Killing VLC</title>
		<link rel="stylesheet" href="<?php print $stylesheet_url; ?>" type="text/css" />
	</head>
	<body>
<?php include_once('../inc/header.inc'); ?>

<?php include_once('../inc/header_grey.inc'); ?>

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
