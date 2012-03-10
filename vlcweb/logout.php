<?php
// oh boy we're rearing shit
setcookie('user', '', time() - 42000); // this is what it sounds like, when the cookies cry
setcookie("sessionid",'', time() - 42000); // murder
header('Location: http://imcumm.in/vlcweb/login.php'); // cheeze it, it's the cops.
?>
