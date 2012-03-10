<h2>Console Output:</h2>
<pre>
<?php
$user = $_GET['user'];
$pidr = fopen("/var/www/imcumm.in/vlcweb/livestream/console/". $user,"r");
$output = fread($pidr, filesize("/var/www/imcumm.in/vlcweb/livestream/console/". $user));
fclose($pidr);
echo $output;
?>
</pre>
