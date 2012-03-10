<?php
try {
	$DBH = new PDO("mysql:host=localhost;dbname=vlcweb","vlcweb","");
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
