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
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="forum">

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
    </div>


</body>

</html>

<?php

if (isset($_POST['AddComment'])) {
    $db = mysqli_connect("localhost", "root", "", "countries") or die("Check your connection" . mysqli_connect_error());
    $Name = $_POST['Name'];
    $Comment = $_POST['Comment'];
    $Hashtag1 = $_POST['Hashtag1'];
    $Hashtag2 = $_POST['Hashtag2'];
    $sql = "INSERT INTO `comments` (`nm`, `hashtag1`, `hashtag2`, `comment`) VALUES ('$Name', '$Hashtag1', '$Hashtag2', '$Comment');";
    $result = $db->query($sql);
}
?>