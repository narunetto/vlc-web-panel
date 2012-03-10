<?php
include_once('../inc/config.inc');
setcookie('user', '', time() - 42000);
setcookie("sessionid",'', time() - 42000);
header('Location: http://$url_hostname/vlcweb/livestream/login.php');
?>
