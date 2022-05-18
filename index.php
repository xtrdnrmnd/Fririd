<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
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

        .block {
            background: #F4C095;
        }

        #menu-items {
            background-color: #071E22;
        }
    </style>
</head>

<body id="landingPage">
    <div class="wrapper">
        <form action="" method="POST">
            <input type="text" name="fromName" class="from_name" placeholder="From..." required>
            <input type="text" name="toName" class="to_name" placeholder="To..." required>
            <input type="submit" name="Search" value="Search" id="search_btn">
        </form>
    </div>

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