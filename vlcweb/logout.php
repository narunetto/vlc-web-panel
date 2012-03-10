<?php
setcookie('user', '', time() - 42000);
setcookie("sessionid",'', time() - 42000);
header('Location: http://imcumm.in/vlcweb/login.php');
?>
