<?php
    include("header.php");

    // Build string for "posted_on" date column
    // and convert to user's time zone, if possible.
    if (isset($_SESSION['user_tz'])) {
        $posted_on = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
    } else {
        $posted_on = 'p.posted_on';
    }

    // Build the query string for getting the forum records
    $q = "SELECT t.thread_id, t.subject, username, COUNT(post_id) - 1 AS responses, MAX(DATE_FORMAT($posted_on, '%e-%b-%y %l:%i %p')) AS last, MIN(DATE_FORMAT($posted_on, '%e-%b-%y %l:%i %p')) AS first FROM threads AS t INNER JOIN posts as p USING (thread_id) INNER JOIN users AS u ON t.user_id = u.user_id WHERE t.lang_id = {$_SESSION['lid']} GROUP BY (p.thread_id) ORDER BY last DESC";

    // Run the query
    $r = mysqli_query($dbc, $q);

    // Build the results table
    if (mysqli_num_rows($r) == 0) {
        echo "<p>There are currently no messages in this forum</p>";
    }
    else {
        echo '<table class="table table-striped">
        <thead>
            <tr>
                <th>' . $words['subject'] . '</th>
                <th>' . $words['posted_by'] . '</th>
                <th>' . $words['posted_on'] . '</th>
                <th>' . $words['replies'] . '</th>
                <th>' . $words['latest_reply'] . '</th>
            </tr>
        </thead>';

        echo '<tbody>';
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td><a = href="read.php?tid=' . $row['thread_id'] . '&lid=' . $_SESSION['lid'] .'">' . $row['subject'] . '</a></td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['first'] . '</td>
                    <td>' . $row['responses'] . '</td>
                    <td>' . $row['last'] . '</td>
                </tr>';
        }

    }

    include("footer.php");