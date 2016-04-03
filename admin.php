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
    $event_name = $_REQUEST['event_name'];
    $event_text = $_REQUEST['event_text'];
    $event_year = $_REQUEST['event_year'];
    $event_text_short = $_REQUEST['event_text_short'];

    $success = true;
    if (empty($event_name)) {
        $status['event_name'] = 'Имя не может быть пустым!';
        $success = false;
    }
    if (empty($event_year)) {
        $status['event_year'] = 'Год не может быть пустым!';
        $success = false;
    }
    if (empty($event_text)) {
        $status['event_text'] = 'Описание не может быть пустым!';
        $success = false;
    }
    if (empty($event_text_short)) {
        $status['event_text_short'] = 'Краткое описание не может быть пустым!';
        $success = false;
    }


    if (!empty($event_video_url) && !preg_match('/[-а-яa-z0-9_\.]{2,}\.(рф|[a-z]{2,6})/', $event_video_url)) {
        $status['event_video_url'] = 'Некорректный адрес видео!';
        $success = false;
    }

    if (!empty($_FILES['event_img_url']['name'])) {
        if (is_uploaded_file($_FILES['event_img_url']['tmp_name'])) {
            $event_img_url = 'img/' . time() . '.jpg';
            move_uploaded_file($_FILES['event_img_url']['tmp_name'], $event_img_url);
            $result .= 'Изображение успешно загружено';
        } else {
            $result .= 'Ошибка при загрузке изображения';
        }
    } else {
        $status['event_img_url'] = 'Изображение не может быть пустым!';
    }

    if ($success) {
        $db = new DB;

        if ($db->insert($event_name, $event_year, $event_text, $event_text_short, $event_img_url, 'https://' . $event_video_url)) {
            $result = 'Событие успешно добавлено';
        } else {
            $result = 'Произошла ошибка при добавлении события';
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
    <title>Добавить событие</title>
    <link href="style.css" rel="stylesheet">
    <link href="foundation.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="foundation.min.js"></script

</head>
<body>


<div class="main">
    <h2 class="text-center">Добавить событие</h2>
    <?= $result ?>
    <form name="add_event" action="" enctype="multipart/form-data" method="post">
        <!--
                <div class="text-center">

            <input type="radio" name="times" id="pokemonRed"><label for="pokemonRed">млрд.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">млн.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">По умолчанию</label>
            </div>
            -->


        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Год события</label>
            </div>
            <div class="small-9 columns">
                <input type="text" id="middle-label" value="<?= $event_year ?>" name="event_year"
                       required><?= $status['event_year'] ?>
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Название</label>
            </div>
            <div class="small-9 columns">
                <input type="text" id="middle-label" name="event_name" value="<?= $event_name ?>"
                       required><?= $status['event_name'] ?>
            </div>
        </div>

        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Oписание</label>
            </div>
            <div class="small-9 columns">
                <textarea name="event_text" rows="10" cols="15" id="middle-label"
                          required><?= $event_text ?></textarea><?= $status['event_text'] ?>
            </div>
        </div>

        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Краткое описание</label>
            </div>
            <div class="small-9 columns">
                <textarea name="event_text_short" rows="10" cols="15" id="middle-label"
                          required><?= $event_text_short ?></textarea><?= $status['event_text_short'] ?>
            </div>
        </div>

        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Изображение</label>
            </div>
            <div class="small-9 columns">
                <label for="exampleFileUpload" class="button secondary">Обзор...</label>
                <input type="file" accept="image/*" name="event_img_url" id="exampleFileUpload" class="show-for-sr"
                       required><?= $status['event_img_url'] ?>
            </div>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <label for="middle-label" class="text-right middle">Ccылка на видео</label>
            </div>
            <div class="small-9 columns">
                https://<input type="text" name="event_video_url" value="<?= $event_video_url ?>"
                               required><?= $status['event_video_url'] ?>
            </div>
        </div>

        <div class="text-center">
            <input type="submit" name="submit" value="Отправить" class="button" id="middle-label">

        </div>

    </form>
</div>

</body>

</html>
