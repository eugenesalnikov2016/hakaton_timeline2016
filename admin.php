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

$event_name = '';
$event_text = '';
$event_year = '';
$event_text_short = '';


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
            $event_img_url = 'images/' . time() . '.jpg';
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

            $event_year = '';
            $event_name = '';
            $event_text = '';
            $event_text_short = '';
            $event_video_url = '';
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
    <title><?php if (isset($_REQUEST['edit'])): ?>Управление событиями<?php else: ?>Добавить событие<?php endif; ?></title>
    <link href="style.css" rel="stylesheet">
    <link href="foundation.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="foundation.min.js"></script
</head>
<body>


<?php if (isset($_REQUEST['edit'])): ?>

    <?php

    $db = new DB;
    $sql = 'SELECT * FROM `events`';
    $result = mysqli_query($db->link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }


    ?>

    <div class="main">
        <h2 class="text-center">Управление событиями</h2>
        <table>
            <tr>
                <td>ID</td>
                <td>Имя</td>
                <td>Год</td>
                <td>Текст</td>
                <td>Удалить?</td>
            </tr>

            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['event_id'] ?></td>
                    <td><?= $event['event_name'] ?></td>
                    <td><?= $event['event_year'] ?></td>
                    <td><?= Helper::txt_trim($event['event_text']) ?></td>
                    <td><a href="?delete&id=<?= $event['event_id'] ?>">X</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <a class="button" href="admin.php">Добавить событие</a>
        <a class="button" href="index.php">На главную</a><br>
    </div>


<?php elseif (isset($_REQUEST['delete'])): ?>

    <div class="main">
        <h2 class="text-center">Удалить событие</h2>

        <?php if (empty($_POST)): ?>


            <?php
            $db = new DB;
            if ($db->delete($_GET['id'])) {
                echo 'Событие успешно удалено!';
                echo '<a href="admin.php?edit">Управление событиями</a><br>';
                echo '<a href="admin.php">Добавить событие</a><br>';
            } else {
                echo 'Ошибка при добавлении события!';
            }
            ?>


        <?php else: ?>
            <?php

            $db = new DB;
            if ($db->delete($_POST['id'])) {
                echo 'Событие успешно удалено!';
            } else {
                echo 'Ошибка при добавлении события!';
            }


            ?>
        <?php endif; ?>

    </div>

<?php else: ?>

    <div class="main">
        <h2 class="text-center">Добавить событие</h2>
        <?= $result ?>
        <form name="add_event" action="" enctype="multipart/form-data" method="post">
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
                    <label for="middle-label" class="text-right middle">Краткое описание (макс. 255 символов)</label>
                </div>
                <div class="small-9 columns">
                <textarea maxlength="255" name="event_text_short" rows="10" cols="15" id="middle-label"
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
                    https://<input type="text" name="event_video_url"
                                   value="<?= $event_video_url ?>"><?= $status['event_video_url'] ?>
                </div>
            </div>

            <div class="text-center">
                <input type="submit" name="submit" value="Отправить" class="button" id="middle-label">
            </div>

        </form>
        <a class="button" href="admin.php?edit">Управление событиями</a>
        <a class="button" href="index.php">На главную</a><br>
    </div>

<?php endif; ?>

</body>

</html>