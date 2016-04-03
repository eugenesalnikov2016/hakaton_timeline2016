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
    	    <link href="style.css" rel="stylesheet">
	    <link href="foundation.css" rel="stylesheet">
	    <script type="text/javascript" src="jquery.js"></script>
	    <script type="text/javascript" src="foundation.min.js"></script

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

		<div class="main">
		<h2 class="text-center">Добавить событие</h2>

		<form method="POST" name="form1">
		<div class="text-center">
		    <input type="radio" name="times" id="pokemonRed"><label for="pokemonRed">млрд.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">млн.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">По умолчанию</label>
            </div>
		    
		    <!--<p>Когда произошло событие</p>
		    <p><label><input type="radio" name="veha">13,7 - 4,8 млрд. лет до н.э.</label> </p>
		    <p><label><input type="radio" name="veha">4,8 - 4,6 млрд. лет до н.э.</label></p>

		    <p><label><input type="radio" name="veha">4,6 млрд. лет до н.э. - 3 млн. лет до н.э.</label></p> 
		    <p><label><input type="radio" name="veha">3 млн. лет до н.э. - 5000 лет до н.э.</label></p>

		    <p><label><input type="radio" name="veha">5000 лет до н.э. - Начало нашей эры</label></p> 
		    <p><label><input type="radio" name="veha">Начало нашей эры - 500 г. н.э.</label></p>

		    <p><label><input type="radio" name="veha">500г. - 1000г.</label></p> 
		    <p><label><input type="radio" name="veha">1000г. - 1500г.</label class="right"></p>

		    <p><label><input type="radio" name="veha">1500г. - 2000г.</label></p>
		    <p><label><input type="radio" name="veha">2000г. - 2016г.</label></p>

		    <select name="century">
		    <option>1 век нашей эры</option>
		    <option>2 век нашей эры</option>
		    <option>3 век нашей эры</option>
		    <option>4 век нашей эры</option>
		    <option>5 век нашей эры</option>
		    <option>6 век нашей эры</option>
		    <option>7 век нашей эры</option>
		    <option>8 век нашей эры</option>
		    <option>9 век нашей эры</option>
		    <option>10 век нашей эры</option>
		    <option>11 век нашей эры</option>
		    <option>12 век нашей эры</option>
		    <option>13 век нашей эры</option>
		    <option>14 век нашей эры</option>
		    <option>15 век нашей эры</option>
		    <option>16 век нашей эры</option>
		    <option>17 век нашей эры</option>
		    <option>18 век нашей эры</option>
		    <option>19 век нашей эры</option>
		    <option>20 век нашей эры</option>
		    <option>21 век нашей эры</option>
		    </select>-->
		    <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Год события</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" id="middle-label" name="year" required>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Название</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" id="middle-label" name="nameEvent" required>
                </div>
            </div>
            <!--<p><label>Название события <input type="text" name="nameEvent" required></label></p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Oписание</label>
                </div>
                <div class="small-9 columns">
                  <textarea name="description" rows="10" cols="15" id="middle-label" required></textarea>
                </div>
            </div>
            <!--<p>Oписание события</p> 
            <textarea name="description" rows="10" cols="15" required></textarea>
            <p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Изображение</label>
                </div>
                <div class="small-9 columns">
                  <label for="exampleFileUpload" class="button secondary">Обзор...</label><input type="file" accept="image/*" name="photo" id="exampleFileUpload" class="show-for-sr" required>
                </div>
            </div>
            <!--<label for="exampleFileUpload" class="button secondary">Добавить изображение</label><input type="file" accept="image/*" name="photo" id="exampleFileUpload" class="show-for-sr" required></p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Ccылка на видео</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" name="video" required>
                </div>
            </div>
            
            <!--<p><label>Вставить ссылку на видео<input type="text" name="video" required></label></p>-->
            <div class="text-center">
            <input type="submit" name="butt" value="Отправить" class="button" id="middle-label">
            </div>
        </form>
        </div>

</body>

</html>
