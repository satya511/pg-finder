<?php
// Start a session
session_start();

// Unset the session variables
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: index.html');
exit();
?>