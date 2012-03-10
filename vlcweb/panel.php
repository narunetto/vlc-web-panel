<?php
include_once('./inc/config.inc');
// here comes the mysql, nigger!
include_once('./inc/msql_connect.php');

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
		<title>vlc web interface | File Streaming</title>
		<link rel="stylesheet" href="<?php print $stylesheet_url; ?>" type="text/css" />
		<script src="javascripts/prototype.js" type="text/javascript"></script>
		<script src="javascripts/scriptaculous.js" type="text/javascript"></script>
	</head>
	<body>
<?php include_once('../inc/header.inc'); ?>

<?php include_once('../inc/header_grey.inc'); ?>

		<div id="top-yellow-alert">
			<strong>protip:</strong> New Feature! You can now stream the entirety of a folder! Just add an asterisk to the end of the path. (Example: /home/ass/*)
		</div>

		<div id="main-wrapper">
<?php
if ($status) {
?>
			<p>Welcome to the VLC Web Interface. Use the form below to start streaming!</p>
			<form action="start-vlc.php" method="post" enctype="multipart/form-data">
				Bitrate:<br />
				<input class="tagsInput" style="width: 32px;" value="1500" type="text" name="bitrate" id="bitrate" /><br />
				Video Width:<br />
				<input class="tagsInput" style="width: 32px;" value="1280" type="text" name="vwidth" id="vwidth" /><br />
				Video Height:<br />
				<input class="tagsInput" style="width: 32px;" value="720" type="text" name="vheight" id="vheight" /><br />
				Path to File:<br />
				<input class="tagsInput" style="width: 400px;" value="/home/thechort/" type="text" name="filename" id="filename" /><br />
				<a href="#" onclick="Effect.SlideDown('advanced'); return false;"><u>Advanced Settings</u></a><br />
				<div id="advanced" style="display:none;margin-left: 10px;">
				  <div>
					<input class="tagsInput" type="checkbox" name="subtitles" checked/>Subtitles<br />
					<input class="tagsInput" type="checkbox" name="transcodeaud" />Multi-file Streaming<br />
					x264 Profile:<br />
					<select name="profile" class="tagsInput">
						<option value="fast">fast</option>
						<option value="ultrafast">ultrafast</option>
						<option value="superfast">superfast</option>
						<option value="veryfast">veryfast</option>
						<option value="faster">faster</option>
						<option value="medium">medium</option>
						<option value="slow">slow</option>
					</select><br />
					Audio Bitrate:<br />
					<input class="tagsInput" style="width: 32px;" value="128" type="text" name="abitrate" id="abitrate" /><br />
					Audio Track:<br />
					<input class="tagsInput" style="width: 32px;" value="0" type="text" name="abitrate" id="audiotrack" /><br />
					<a href="#" onclick="$('advanced').hide(); return false;">Hide</a>
				  </div>
				</div>
				<input class="submit-button" type="submit" value="Start Streamin' Cunt" />
			</form>
		</div>
<?php
} else {
	echo 'NIGGA YOU AINT AUTH\'D. <a href="login.php">Go</a> login.';
}
?>
	</body>
</html>
