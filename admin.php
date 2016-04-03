<?php

require_once 'DB.php';
require_once 'Helper.php';


$status = [
    'event_name' => '',
    'event_year' => '',
    'event_text' => '',
    'event_img_url' => '',
    'event_video_url' => '',
];
$result = '';
$success = false;

$checked = (isset($_REQUEST['']));
$event_video_url = $_REQUEST['event_video_url'];


if (!empty($_REQUEST)) {
    $event_name = Helper::process($_REQUEST['event_name']);
    $event_text = Helper::process($_REQUEST['event_text']);
    $event_year = $_REQUEST['event_year'];


    $success = true;
    if (empty($event_name)) {
        $status['event_name'] = 'Name is empty!';
        $success = false;
    }
    if (empty($event_year) || !preg_match('/^[0-9]+$/', $event_year)) {
        $status['event_year'] = 'Year is empty or containing letters!';
        $success = false;
    }
    if (empty($event_text)) {
        $status['event_text'] = 'Text is empty!';
        $success = false;
    }


    if (empty($event_video_url) || !preg_match('/[-а-яa-z0-9_\.]{2,}\.(рф|[a-z]{2,6})/', $event_video_url)) {
        $status['event_video_url'] = 'Video URL is empty or incorrect!';
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
    } else {
        $status['event_img_url'] = 'Image is empty';
    }

    if ($success) {
        $db = new DB;

        if ($db->insert($event_name, $event_year, $event_text, $event_img_url, 'http://' .$event_video_url)) {
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
        <p>Video URL: http://<input name="event_video_url" type="text"
                                    value="<?= $event_video_url ?>"> <?= $status['event_video_url'] ?></p>
        <p><input name="submit" type="submit" value="Add"></p>
    </form>
</div>
</body>
</html>