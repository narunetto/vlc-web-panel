<?php
include_once('../inc/config.inc');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>vlc web interface | Stream Started</title>
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
		// define shit
		$host = $_POST['host'];
		$port = $_POST['port'];
		$export = $_POST['export'];
		$mount = $_POST['mount'];
		$exmount = $_POST['exmount'];
		$user = $_POST['username'];
		
		// you gotta men this shit here to make sure people aren't bein giant niggers				
		if ($port == null) { 
			die("<span class=\"error\">The port was not specified, please try again.</span>");
		}
		if ($export == null) { 
			die("<span class=\"error\">The broadcast port was not specified, please try again.</span>");
		}
		if ($mount == null) { 
			die("<span class=\"error\">The mount point was not specified, please try again.</span>");
		}
		//echo "<strong>Bitrate:</strong> ".$bitrate."<br /><strong>Video Size:</strong> ".$vwidth."x".$vheight."<br /><strong>Filename:</strong> ".$filename."<br /><strong>Stream URL:</strong> http://dicksindustrial.com/s/tv.ts";
		
		$pid1 = fopen("/var/www/imcumm.in/vlcweb/livestream/pid/". $user,"r");
		$pidb = fread($pid1, 5);
		fclose($pid1);
		
		$asshole = exec("ps -u www-data | grep ". $pidb); // check to see if vlc is already runnin
		$asshole2 = $asshole[0];
//		echo "cvlc -I dummy --rtp-caching=500 rtp://@:". $port ." --sout='#duplicate{dst=std{access=http,mux=ts,dst=:". $export ."/". $mount ."}}' >/var/www/imcumm.in/vlcweb/livestream/console/". $user ." 2>&1 & echo $! 1 > /var/www/imcumm.in/vlcweb/livestream/pid/". $user, $output;

		if ($asshole2 == null) {				
			exec("cvlc -I dummy http://". $host .":". $port ."/". $mount ." --http-caching=5000 --sout='#duplicate{dst=std{access=http,mux=ts,dst=:". $export ."/". $exmount ."}}' >/var/www/imcumm.in/vlcweb/livestream/console/". $user ." 2>&1 & echo $! 1 > /var/www/imcumm.in/vlcweb/livestream/pid/". $user, $output);
			
			// old rtp shit that doesn't work anymore fuck france.
			// exec("cvlc -I dummy --rtp-caching=5000 rtp://@:". $port ." --sout='#duplicate{dst=std{access=http,mux=ts,dst=:". $export ."/". $mount ."}}' >/var/www/imcumm.in/vlcweb/livestream/console/". $user ." 2>&1 & echo $! 1 > /var/www/imcumm.in/vlcweb/livestream/pid/". $user, $output);
	
			$pidr = fopen("/var/www/imcumm.in/vlcweb/livestream/pid/". $user,"r");
			$pid = fread($pidr, 5);
			fclose($pidr);
			echo "<h2>You're streamin' motherfucker!</h2>";
			echo "<br /><br /><strong><a href=\"kill-vlc.php?pid=".$pid."\">Kill VLC PID ".$pid."</a>";
			echo "<br /><strong><a href=\"http://$url_hostname/vlcweb/livestream/console-output.php?user=". $user ."\" target=\"_blank\">View Console Output</a></strong>";
		} else {
			print "<span class=\"error\">Error:</span> A VLC process is already running. <a href=\"http://$url_hostname/vlcweb/livestream/kill-vlc.php?pid=". $pidb ."\">Click here</a> to kill the process.";
		}

		?>
		</div>	
	</body>
</html>
