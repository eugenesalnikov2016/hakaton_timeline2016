<?php

require_once 'DB.php';

$event_name = $_REQUEST['event_name'];
$event_year = $_REQUEST['event_year'];
$event_text = $_REQUEST['event_text'];
$event_video_url = $_REQUEST['event_video_url'];

$status = [
    'event_name' => '',
    'event_year' => '',
    'event_text' => '',
    'event_img_url' => '',
    'event_video_url' => '',
];
$result = '';


if (!empty($_REQUEST)) {
    $success = true;
    if (empty($event_name)) {
        $status['event_name'] = 'Name cannot be empty!';
        $success = false;
    }
    if (empty($event_year)) {
        $status['event_year'] = 'Year cannot be empty!';
        $success = false;
    }
    if (empty($event_text)) {
        $status['event_text'] = 'Text cannot be empty!';
        $success = false;
    }

    if (empty($event_video_url)) {
        $status['event_video_url'] = 'Video URL cannot be empty!';
        $success = false;
    }

    if (!empty($_FILES['event_img_url']['name'])) {
        if (is_uploaded_file($_FILES['event_img_url']['tmp_name'])) {
            $event_img_url = 'img/' . time() . '.jpg';
            move_uploaded_file($_FILES['event_img_url']['tmp_name'], $event_img_url);
            $result .= 'Image successfully uploaded';
        } else {
            $result .= 'Error while uploading image';
        }
    }

    if ($success) {
        $db = new DB;
        if ($db->insert($event_name, $event_year, $event_text, $event_img_url, $event_video_url)) {
            $result = 'Event successfully added';
        } else {
            $result = 'Error while addind to database';
        }
    }

} else {
    //
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
    <?= $result ?>
    <form name="add_event" action="" enctype="multipart/form-data" method="post">
        <p>Name: <input name="event_name" type="text" value="<?= $event_name ?>"> <?= $status['event_name'] ?></p>
        <p>Year: <input name="event_year" type="text" value="<?= $event_year ?>"> <?= $status['event_year'] ?></p>
        <p>Text: <input name="event_text" type="text" value="<?= $event_text ?>"> <?= $status['event_text'] ?></p>
        <p>Image: <input name="event_img_url" type="file"> <?= $status['event_img_url'] ?>
        </p>
        <p>Video URL: <input name="event_video_url" type="text"
                             value="<?= $event_video_url ?>"> <?= $status['event_video_url'] ?></p>
        <p><input name="submit" type="submit" value="Add"></p>
    </form>
</div>
</body>
</html>