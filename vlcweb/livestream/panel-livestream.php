<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Live Streaming</title>
		<link rel="stylesheet" href="http://imcumm.in/vlcweb/style.css" type="text/css" />
	</head>
	<body>
		<header id="top-grey-bar">
			<div id="header-text">
				<?php include("../inc/header.inc"); ?>
				<div style="float:right;"><a href="http://imcumm.in/vlcweb/livestream/logout.php">Log Out</a>
			</div>
		</header>

		<header id="top-grey-head">
			<div id="top-grey-wrap">
				<div id="top-grey-logo" style="margin-top: 5px;">
					<a href="http://imcumm.in/vlcweb/panel.php"><img src="http://imcumm.in/vlcweb/logo.png" /></a>
				</div>
			</div>
		</header>
<?php
include_once("../inc/users.inc");
?>
		<div id="top-yellow-alert">
			<strong>up ma ass</strong>
		</div>

		<div id="main-wrapper">
			<p>Hello, <?php print $_SERVER['PHP_AUTH_USER'] ?>!</p>
			<p>If all of the information below is correct, press the button below to begin streaming. If anything thing has changed or you would like to make a change, input it below and contact <em>narunetto</em>. If you need the streaming kit, please click <a href="http://imcumm.in/misc/streaming-kit.7z">here</a>.</p>
			<form action="start-stream.php" method="post" enctype="multipart/form-data">
				Incoming Port:<br />
				<input class="tagsInput" style="width: 34px;" value="<?php print $port ?>" type="text" name="port" id="vwidth" /><br />
				Broadcast Port:<br />
				<input class="tagsInput" style="width: 34px;" value="<?php print $export ?>" type="text" name="export" id="vheight" /><br />
				Hostname/IP:<br />
				<input class="tagsInput" style="width: 200px;" value="<?php print $host ?>" type="text" name="host" id="hostname" /><br />
				Mount Point:<br />
				<input class="tagsInput" style="width: 200px;" value="<?php print $mount ?>" type="text" name="mount" id="filename" /><br />
				<input type="hidden" name="username" value="<?php print $_SERVER['PHP_AUTH_USER'] ?>" />
				<input class="submit-button" type="submit" value="Start Streamin Cunt" />
			</form>
		</div>
	</body>
</html>
