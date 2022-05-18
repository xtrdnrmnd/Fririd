<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
?>
<html>

<head>
    <title>forum</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .wrapper .footer a {
            color: #F4C095;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="forum">
    <form action="" method="POST">
        <label>
            <input type="text" name="Name" class="comment_name" required>
        </label><br><br>
        <label>
            <textarea name="Comment" class="comment_section" required></textarea>
        </label><br><br>
        <input type="submit" name="Submit" value="Submit" id="sub_btn">
    </form>
</body>

</html>

<?php

if (isset($_POST['Submit'])) {
    /*print "<h1>Your comment has been submitted!</h1>";*/
    $Name = $_POST['Name'];
    $Comment = $_POST['Comment'];
    #Get old comments
    $old = fopen("comments.txt", "r+t");
    $old_comments = fread($old, 1024);
    #Delete everything, write down new and old comments
    $write = fopen("comments.txt", "w+");
    $string = "<b>" . $Name . "</b><br>" . $Comment . "<br>\n" . $old_comments;
    fwrite($write, $string);
    fclose($write);
    fclose($old);
}
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>