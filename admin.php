<?php

require_once 'DB.php';

var_dump($_REQUEST);
$event_name = $_REQUEST['event_name'];
$event_year = $_REQUEST['event_year'];
$event_text = $_REQUEST['event_text'];
$event_img_url = $_REQUEST['event_img_url'];
$event_video_url = $_REQUEST['event_video_url'];


if (!empty($_REQUEST)) {
    echo 'not empty';
} else {
    echo 'empty';
}


?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>
<h3>Add event</h3>
<div>
    <form name="add_event" action="" method="post">
        <p>Name: <input name="event_name" type="text" value="<?= $event_name ?>"></p>
        <p>Year: <input name="event_year" type="text" value="<?= $event_year ?>"></p>
        <p>Text: <input name="event_text" type="text" value="<?= $event_text ?>"></p>
        <p><input name="event_img_url" type="text" value="<?= $event_img_url ?>"></p>
        <p>Video URL: <input name="event_video_url" type="text" value="<?= $event_video_url ?>"></p>
        <p><input name="submit" type="submit" value="Add"></p>
    </form>
</div>
</body>
</html>