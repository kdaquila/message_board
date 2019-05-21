<?php # Load words from database in user's language

// Set the encoding
header('Content-Type: text/html; charset=UTF-8');

// Start a session
session_start();

// For testing purposes
$_SESSION['user_id'] = 1;
$_SESSION['user_tz'] = 'America/New_York';

// Set the language id in the session
$default_lid = 1;
if (isset($_GET['lid']) && filter_var($_GET['lid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $_SESSION['lid'] = $_GET['lid'];
}
else {
    $_SESSION['lid'] = $default_lid;
}

// Connect to database
// $dbc     The database connection
require('../mysqli_connect.php');

// Get the words for this language id
$q = "SELECT * FROM words WHERE lang_id = {$_SESSION['lid']}";
$r = mysqli_query($dbc, $q);

// When no words found, switch to default language
if (mysqli_num_rows($r) == 0) {
    $_SESSION['lid'] = $default_lid;
    $q = "SELECT * FROM words WHERE lang_id = {$_SESSION['lid']}";
    $r = mysqli_query($dbc, $q);
}

// Convert SQL object to PHP array
$words = mysqli_fetch_array($r);

// Cleanup
mysqli_free_result($r);



