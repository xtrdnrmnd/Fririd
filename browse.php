<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');;
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>browse</title>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        #menu-items {
            background-color: #F4C095;
        }

        .wrapper .footer a,
        #menu-items li a {
            color: #071E22;
        }

        #location-icon {
            background-image: url("./images/location-icons/location-icon-dblue.png");
        }

        #logo {
            background-image: url("./images/logos/Logo-dblue.png");
        }
    </style>
</head>

<body id="browse">
    <div class="wrapper">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "countries");
        $res = mysqli_query($conn, "SELECT DISTINCT  alterName, flag_dir FROM country ORDER BY alterName ASC ");
        while ($row = mysqli_fetch_object($res)) {
        ?>
            <div class="browse-block">
                <div>
                    <?php echo "<img src=" . $row->flag_dir . " class='img-circle'>"; ?>
                </div>
                <div class="hed-name">
                    <?php echo $row->alterName; ?>
                </div>
                <div id="rate">
                    <?php
                    $from = ip_visitor_country();
                    $to = $row->alterName;
                    $str_output = shell_exec("/Library/Frameworks/Python.framework/Versions/3.8/bin/python3 ./python/DataProcessor.py $from $to");
                    echo number_format((float)$str_output, 1, ',', '');
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
</body>

</html>