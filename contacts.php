<!DOCTYPE html>
<?php
include('header.php');
include('footer.php');
?>
<html>

<head>
    <!-- Meta information -->
    <meta charset="utf-8">
    <title>contacts</title>

    <!--CSS-->
    <link rel="stylesheet" href="style.css" />
    <style>
        .wrapper .footer a {
            color: #1D7874;
        }

        #menu-items {
            background-color: #679289;
        }

        .block {
            background: #1D7874;
        }

        #menu:hover .block {
            background: #071E22;
        }

        #logo {
            background-image: url("./images/logos/Logo-blue.png");
        }

        #location-icon {
            background-image: url("./images/location-icons/location-icon-blue.png");
        }
    </style>
</head>

<body id="contacts">
    <div class="wrapper">
        <div id="contact-text">
            This website was designed and made as a diploma project in 2022.
            The idea for it came in 2021, when COVID was still a thing.
            Now its mainly used to showcase my skills as a software development graduate and hopefully will help me land a job.
            In case of any questions or contributions, please, contact me
            <a href="mailto:xtrdnrmnd@gmail.com" style="color: #ffffff;">xtrdnrmnd@gmail.com </a>
        </div>

        <div id="git">
            <a href="https://github.com/xtrdnrmnd">
                <img src="./images/git-logo.png" width="300">
                @xtrdnrmnd
            </a>
        </div>
    </div>
</body>

</html>