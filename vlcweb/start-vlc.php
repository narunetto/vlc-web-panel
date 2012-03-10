<?php
include_once('./inc/config.inc');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Starting Stream</title>
		<link rel="stylesheet" href="<?php print $stylesheet_url; ?>" type="text/css" />
	</head>
	<body>
<?php include_once('../inc/header.inc'); ?>

<?php include_once('../inc/header_grey.inc'); ?>

		<div id="main-wrapper">
		<?php
		// here comes the mysql, nigger!
		include_once('./inc/msql_connect.php');

		// check to see if login session is legit.
		$data = array("sessionid" => $_COOKIE['sessionid']);
		$STH = $DBH->prepare('SELECT COUNT(*) FROM users WHERE sessionid = :sessionid');
		$STH->execute($data);
		$status = (bool) $STH->fetchColumn(0);
		
		if($status) {
			// define shit
			$bitrate = $_POST['bitrate'];
			$vwidth = $_POST['vwidth'];
			$vheight = $_POST['vheight'];
			$filename = $_POST['filename'];
			$preset = $_POST['profile'];
			$audiotrack = $_POST['audiotrack'];
			$logo = null;
		
			if (!isset($_POST['subtitles'])) {
				$subtitles = null;			
			} else {
				$subtitles = ",soverlay";
			}
		
			if (!isset($_POST['transcodeaud'])) {
				$transcodeaud = ",acodec=aac,ab=128,channels=2";
			} else {
				$transcodeaud = null;
			}
		
			if ($vwidth < 920) {
				$logo = "sd-logo.png";
			} else {
				$logo = "new-logo.png";
			}
			
		
			// you gotta men this shit here to make sure people aren't bein giant niggers		
			if ($bitrate == null) { 
				die("<span class=\"error\">The bitrate was not specified, please try again.</span>");
			}		
			if ($vwidth == null) { 
				die("<span class=\"error\">The video width was not specified, please try again.</span>");
			}
			if ($vheight == null) { 
				die("<span class=\"error\">The video height was not specified, please try again.</span>");
			}
			if ($filename == null) { 
				die("<span class=\"error\">The filename was not specified, please try again.</span>");
			}
			if ($vwidth < 320) {
				die("<span class=\"error\">I'm pretty sure you don't need to stream something that is that small, get out.");
			}
			if ($vheight < 240) {
				die("<span class=\"error\">I'm pretty sure you don't need to stream something that is that small, get out.");
			}
			if ($filename == "/home/thechort/") {
				die("<span class=\"error\">The filename was not specified, please try again. (didn't change default input)</span>");
			}
			if (!isset($_POST['transcodeaud'])) {	
				if (file_exists($filename) == false) {
					die("<span class=\"error\">The file you specified does not exist, try again.</span>");
				}
			}
			echo "<strong>Bitrate:</strong> ".$bitrate."<br /><strong>Video Size:</strong> ".$vwidth." x ".$vheight."<br /><strong>Filename:</strong> ".$filename."<br /><strong>Stream URL:</strong> http://dicksindustrial.com/s/tv.ts";
		
			$pid1 = fopen("/var/www/imcumm.in/vlcweb/livestream/pid/main","r");
			$pidb = fread($pid1, 5);
			fclose($pid1);
		
			if (!isset($_POST['transcodeaud'])) {
				$filename = "\"".$filename."\"";
			}
		
			$asshole = exec("ps -u www-data | grep ".$pidb.""); // check to see if vlc is already runnin
			$asshole2 = $asshole[0];
			if ($asshole2 == null) {
				exec("cvlc -I dummy ".$filename." --logo-file ".$logo." --logo-x=75 --logo-y=35 --http-caching=20000 --audio-track=".$audiotrack." --sub-track=0 --subsdec-formatted --sout-mux-caching=2000 --sout-keep --sout='#gather:duplicate{dst=\"transcode{vcodec=h264,venc=x264{crf=18,keyint=140,vbv-maxrate=".$bitrate.",vbv-bufsize=2000,preset=".$preset.",threads=4},vfilter=canvas{width=".$vwidth.",height=".$vheight.",aspect=16:9}".$transcodeaud."".$subtitles.",sfilter=logo,audio-sync}:duplicate{dst=std{access=http,mux=ts,dst=:6767/tv.ts}\"}' >/etc/farts 2>&1 & echo $! 1 > /var/www/imcumm.in/vlcweb/livestream/pid/main", $output);
			
				$pidr = fopen("/var/www/imcumm.in/vlcweb/livestream/pid/main","r");
				$pid = fread($pidr, 5);
				fclose($pidr);
			
				echo "<br /><br /><strong><a href=\"kill-vlc.php?pid=".$pid."\">Kill VLC PID ".$pid."</a>";
				echo "<br /><strong><a href=\"http://$url_hostname/vlcweb/console-output.php\" target=\"_blank\">View Console Output</a></strong>";
			} else {
				print("<br /><br /><span class=\"error\">Error:</span> A VLC process is already running. <a href=\"http://$url_hostname/vlcweb/livestream/kill-vlc.php?pid=". $pidb ."\">Click here</a> to kill the process.");
			}
		} else {
			echo 'NIGGA YOU AINT AUTH\'D. <a href="login.php">Go</a> login.';
		}
		?>
		</div>	
	</body>
</html>
