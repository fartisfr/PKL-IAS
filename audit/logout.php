<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_name('audit_sess');
    session_start();
    session_destroy();
}else{
    session_destroy();
}
header("Location: index.php");
 
?>