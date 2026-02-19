<?php
// Logout page.
// Clears the current session and returns the user to the homepage.

require_once(__DIR__ . "/../util/security.php");

$inViewFolder = (strpos($_SERVER["PHP_SELF"], "/view/") !== false);
$homeHref = $inViewFolder ? "../index.php" : "index.php";
$viewPrefix = $inViewFolder ? "" : "view/";

Security::checkHTTPS();

Security::logout();
?>