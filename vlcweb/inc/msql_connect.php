<?php
try {
	$DBH = new PDO("mysql:host=localhost;dbname=vlcweb","vlcweb","QpFhYwzGcHxyY27B");
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
