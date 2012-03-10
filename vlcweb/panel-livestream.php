<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>VLC Streaming Heener</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<header id="top-grey-bar">
			<div id="header-text">
				<strong><a href="panel-jap.php">JAPTV</a></strong>
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
if ($_SERVER['REMOTE_ADDR'] != "::ffff:174.127.96.170") {
	die("<h2>WOA BUD, YOU'RE NOT ALLOWED TO USE THIS</h2>");
}
?>
		<div id="top-yellow-alert">
			<strong>protip:</strong> <em>/mnt/drive_1/The Chort</em> is where The Chort is located.
		</div>

		<div id="main-wrapper">
			<p>Welcome to the VLC Web Interface. Here you can stream video files with ease. Use the form below to start streaming!</p>
			<form action="start-vlc.php" method="post" enctype="multipart/form-data">
				Bitrate:<br />
				<input class="tagsInput" style="width: 32px;" value="1500" type="text" name="bitrate" id="bitrate" /><br />
				Video Width:<br />
				<input class="tagsInput" style="width: 32px;" value="1280" type="text" name="vwidth" id="vwidth" /><br />
				Video Height:<br />
				<input class="tagsInput" style="width: 32px;" value="720" type="text" name="vheight" id="vheight" /><br />
				Path to File:<br />
				<input class="tagsInput" style="width: 400px;" value="/mnt/drive_2/banal/" type="text" name="filename" id="filename" /><br />
				<input class="submit-button" type="submit" value="Start Streamin Cunt" />
			</form>
		</div>
	</body>
</html>
