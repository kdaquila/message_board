<?php
    // Load the words
    // $words     Common words in user's language
    require('load_words.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $words['title']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        body {
        padding-top: 50px;
        }

        .starter-template {
        padding: 40px 15px;
        text-align: left;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <?php echo '<a class="navbar-brand" href="index.php?lid=' . $_SESSION['lid']  . '">' . 'Awesome Message Board' . '</a>'; ?>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                    require('generate_nav_links.php');
                ?>
            </ul>
        </div>
    </div>
        
</nav>

<div class="container">
    <div class="starter-template">
        