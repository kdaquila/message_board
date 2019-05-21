<?php

// redirect if this page is accessed directly
if (!isset($words)) {
    header("Location: index.php?lid={$_SESSION['lid']}" );
}

// generate content for logged-in users
if (isset($_SESSION['user_id'])) {

    // generate form
    echo '<form action="post.php" method="post" accept-charset="utf-8">';

    // if script is accessed from read.php
    if (isset($tid) && $tid) {

        // generate heading
        echo '<h3>' . $words['post_a_reply'] . '</h3>';

        // generate a hidden input with the thread id
        echo '<input name="tid" type="hidden" value="' . $tid . '">';
    }

    // if script is accessed from post.php
    else {

        // generate heading
        echo '<h3>' . $words['new_thread'] . '</h3>';

        // generate an input for the subject
        echo '<div class="form-group">
                <label for="subject">' . $words['subject'] . '</label>
                <input name="subject" type="text" class="form-control" size="60" maxlength="100"';

            // insert existing value
            if (isset($subject)) {
                echo "value = \"$subject\"";
            }

            echo '></div>';
    }

    // generate the text area
    echo '<div class="form-group">
                <label for="subject">' . $words['body'] . '</label>
                <textarea name="body" class="form-control" rows="10" cols="60">';
                if(isset($body)) {
                    echo $body;
                }
                echo '</textarea>
          </div>';

    // generate the submit button
    echo '<input name="submit" type="submit" class="form-control" value="' . $words['submit'] . '">';

    echo '</form>';


} else {
    echo '<p class="bg-warning">You must be logged in to post messages.</p>';
}

