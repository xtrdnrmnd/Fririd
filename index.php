<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
//include('menu.php');
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>Diploma</title>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        .wrapper .footer a {
            color: #F4C095;
        }
    </style>
</head>

<body id="landingPage">
    <form action="" method="POST">
        <label><input type="text" name="fromName" class="from_name" required>
            <input type="text" name="toName" class="to_name" required>
        </label>
        <input type="submit" name="Search" value="Search" id="search_btn">
    </form>


</body>

</html>

<?php

if (isset($_POST['Search'])) {
    $From = $_POST['fromName'];
    $To = $_POST['toName'];
    $openFile = "countries.txt";
    $readFile = fopen($openFile, 'r+');

    $match = null;
    $match2 = null;
    while (($line = stream_get_line($fp, 1024 * 1024, "\n")) !== false) {
        if (trim($line) === trim($To)) {
            $match = trim($line);
            break;
        }
    }
    while (($line = stream_get_line($fp, 1024 * 1024, "\n")) !== false) {
        if (trim($line) === trim($From)) {
            $match = trim($line);
            break;
        }
    }
    fclose($fp);

    if (!empty($match)) {
        header("Location: search_result.php");
        exit;
    } else {
        echo "Check the search data";
    }
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