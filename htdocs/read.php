<?php
include("header.php");

// Get the thread id
$tid = FALSE;
if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $tid = $_GET['tid'];
} else {
    echo '<p class="bd-danger">This page has been accessed in error.</p>';
    die();
}

// Set the string for getting posted date
// convert to user's timezone, if possible.
if (isset($_SESSION['user_tz'])) {
    $posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
} else {
    $posted = 'p.posted_on';
}

// Build the query string to get the posts for this thread
$q = "SELECT t.subject, p.message, username, DATE_FORMAT($posted, '%e-%b-%y %l:%i %p') AS posted FROM threads AS t LEFT JOIN posts AS p USING (thread_id) INNER JOIN users AS u ON p.user_id = u.user_id WHERE t.thread_id = $tid ORDER BY p.posted_on";

// Run the query
$r = mysqli_query($dbc, $q);

if ($r == false || mysqli_num_rows($r) == 0) {
    echo '<p class="bd-danger">Error. No posts found on this thread.</p>';
    die();
}

$message = mysqli_fetch_array($r, MYSQLI_ASSOC);

// generate header element
echo "<h2>{$message['subject']}</h2>";

// generate 1st message element
echo "<p>{$message['username']} ({$message['posted']})</p>";
echo "<p>{$message['message']}</p>";

// generate remaining messages elements
while ($message = mysqli_fetch_array($r)) {
    echo "<p>{$message['username']}({$message['posted']})</p>";
    echo "<p>{$message['message']}</p>";
}

include('post_form.php');

include("footer.php");