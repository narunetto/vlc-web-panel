<h2>Console Output:</h2>
<pre>
<?php
$pidr = fopen("/etc/farts","r");
$output = fread($pidr, filesize("/etc/farts"));
fclose($pidr);
echo $output;
?>
</pre>
