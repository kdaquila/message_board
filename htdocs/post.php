<?php
include ("header.php");

// if accessed by a form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

}

// if accessed by navigation-bar link
else {
    include("post_form.php");
}

include ("footer.php");