<?php
session_start();
$_SESSION = array(); // Clear the session variables
session_destroy(); // Destroy the session
setcookie(session_name(), '', time() - 3600); // Clear the session cookie (if applicable)
header("Location: index.php"); // Redirect to homepage
exit;

?>
