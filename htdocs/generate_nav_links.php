<?php
    echo '<li><a href="index.php?lid=' . $_SESSION['lid']  . '">' . $words["home"] . '</a></li>';
    echo '<li><a href="forum.php?lid=' . $_SESSION['lid']  . '">' . $words["forum_home"] . '</a></li>';

    // Generate links for users that are logged in
    if (isset($_SESSION['user_id'])) {

        // Generate link for posting new thread
        if (basename($_SERVER['PHP_SELF']) == 'forum.php') {
            echo '<li><a href="post.php">' . $words['new_thread'] . '</a></li>';
        }

        // Generate the logout link
        echo '<li><a href="logout.php">' . $words['logout'] . '</a></li>';
    }

    // Generate links for users that are not logged in
    else {

        // Generate the register link
        echo '<li><a href="register.php">' . $words['register'] . '</a></li>'; 

        // Generate the login link
        echo '<li><a href="login.php">' . $words['login'] . '</a></li>'; 
    }

    // Generate language dropdown
    echo '<li class="dropdown">';
    echo '<a href="forum.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
    echo $words['language'] . '<span class="caret"></span>';
    echo '</a>';
    echo '<ul class="dropdown-menu">';
    $q = "SELECT lang_id, lang FROM languages ORDER BY lang_eng";
    $r = mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) > 0) {
        while ($menu_row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo '<li>';
            echo '<a href="forum.php?lid=' . $menu_row[0] . '">';
            echo $menu_row[1];
            echo '</a>';
            echo '</li>';
        }
    }

    // clean up
    mysqli_free_result($r);
