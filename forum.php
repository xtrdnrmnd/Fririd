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

        .block {
            background: #F4C095;
        }

        #menu-items {
            background-color: #679289;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="forum">
    <img src="./images/hashtag.png" id="hashtag-picture">
    <div id="search-hashtag-id">
        <form method="POST" action="">
            <input type="text" name="search-hashtag" id="search-hashtag" placeholder="Search #hashtag">
            <input type="submit" name="search-comment" value="Search" id="search-commment-btn">
        </form>
    </div>
    <div class="wrapper">
        <form method="POST" action="">
            <div class="forum-input">
                <input type="text" name="Name" class="comment_name" placeholder="Name" required>
                <textarea name="Comment" class="comment_section" placeholder="Leave your story here" required></textarea>
                <input type="text" name="Hashtag1" placeholder="Hashtag" class="hashtag">
                <input type="text" name="Hashtag2" placeholder="Hashtag" class="hashtag">
            </div>
            <input type="submit" name="AddComment" value="Submit" id="sub_btn">
        </form>

        <div class="old-comments">
            <?php
            $html = "";
            $db = mysqli_connect("localhost", "root", "", "countries") or die("Check your connection" . mysqli_connect_error());
            $select = "SELECT * FROM comments";
            $res = mysqli_query($db, $select);
            if (isset($_POST['search-comment'])) {
                $html = preg_replace('#<div class="single-comment">(.*?)<div>#', '', $html);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($row['hashtag1'] == $_POST['search-hashtag'] || $row['hashtag2'] == $_POST['search-hashtag']) {
                            echo "<div class='single-comment'>" . $row['nm'] . "<div class='hashtag'>#" . $row['hashtag1'] . "</div><div class='hashtag'>#" . $row['hashtag2'] . "</div><br><br>" . $row['comment'] . "</div>";
                        }
                    }
                }
            } else {
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $html .= "<div class='single-comment'>" . $row['nm'] . "<div class='hashtag'>#" . $row['hashtag1'] . "</div><div class='hashtag'>#" . $row['hashtag2'] . "</div><br><br>" . $row['comment'] . "</div>";
                    }
                }
                echo $html;
            }
            ?>
        </div>
    </div>



</body>

</html>

<?php

if (isset($_POST['AddComment'])) {
    $Name = $_POST['Name'];
    $Comment = $_POST['Comment'];
    $Hashtag1 = $_POST['Hashtag1'];
    $Hashtag2 = $_POST['Hashtag2'];
    $sql = "INSERT INTO `comments` (`nm`, `hashtag1`, `hashtag2`, `comment`) VALUES ('$Name', '$Hashtag1', '$Hashtag2', '$Comment');";
    $result = $db->query($sql);
}
?>