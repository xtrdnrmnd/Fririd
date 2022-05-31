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
        <form action="search_result.php" method="POST">
            <input type="text" name="fromName" class="from_name" placeholder="From...">
            <input type="text" name="toName" class="to_name" placeholder="To..." required>
            <input type="submit" name="Search" value="Search" id="search_btn">
        </form>
        <?php

        // Initialize the session
        session_start();

        if (isset($_POST['toName'])) {
            $db = mysqli_connect("localhost", "root", "") or die("Check your connection");
            mysqli_select_db($db, "countries") or die("Connection failed");
            $result = mysqli_query($db, "SELECT countryName FROM country");
            $array = mysqli_fetch_array($result);
            do {
                $x = True;
                if ($_POST['toName'] == $array['countryName']) {
                    header("Location: search_result.php");
                    $x = False;
                }
            } while ($array = mysqli_fetch_array($result));
            if ($x = True) { ?>
                <div class="mistake" style="color: #FFFFFF;font-family: 'Inter';font-style: normal;font-weight: 500; font-size: 28px;grid-column-start: 7;grid-row-start: 2;width:400px;"><?php echo "Please check the spelling!"; ?></div>
        <?php }
        }
        ?>
    </div>
</body>

</html>