<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// når man logger ud bruger vi session til at den ikke forbliver logget ind ved at den fjerne log ind informationerne 
// Finally, destroy the session.
session_destroy();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>log ud</title>
<link rel="stylesheet" href="logind_stylesheet.css">
</head>

<body>
Du er nu logget ud
</body>
</html>