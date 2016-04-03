<?php
require_once 'DB.php';
require_once 'Helper.php';


$level = $_REQUEST['level'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
if (empty($level)) {
    $level = 0;
}
$tag = "a";
if ($level > 1) {
    $level = 1;
    $tag = 'div';
}
if ($level == 0) {
    $count = 10;
} else {
    $count = 5;
}

$years_count = $_REQUEST['end'] - $_REQUEST['start'];
$section_count = ceil($years_count / $count);

$db = new DB;
$sql = 'SELECT * FROM `sections`';
$result = mysqli_query($db->link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $array[] = $row;
}


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Events</title>
</head>
<body>
<div>
    <table>
        <tr>
            <?php if ($count == 10): ?>
                <?php for ($i = 0; $i < $count; $i++): ?>
                    <td>
                        <a href="?start=<?= $array[$i]['start'] ?>&end=<?= $array[$i]['end'] ?>&level=<?= ($level + 1) ?>"><?= $array[$i]['start'] . ' - ' . $array[$i]['end'] ?></a>
                    </td>
                <?php endfor; ?>
            <?php endif; ?>
            <?php if ($count == 5): ?>
            <?php for ($i = $start;
            $i < $end;
            $i = $i + $section_count): ?>
            <<? echo ($tag == 'a') ? 'a href="?start=' . $i . '&end=' . ($i + $section_count) . '&level=' . ($level + 1) . '"' : 'div'; ?>
            ><?= $i . ' - ' . ($i + $section_count) ?> </<? echo ($tag == 'a') ? 'a' : 'div'; ?>>
        <?php endfor; ?>
        <?php endif; ?>
        </tr>
    </table>


    <?php


    if ($tag == 'div') {

        $sql = "SELECT * FROM `events` WHERE `event_year` >= $start AND `event_year` <= $end ORDER BY `event_year`";

        $result = mysqli_query($db->link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }

    }


    ?>

    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
            <div>
                <?= $event['event_name'] ?>
            </div>
            <div>
                <?= $event['event_year'] ?>
            </div>
            <div>
                <?= $event['event_text'] ?>
            </div>
            <div>
                <img src="<?= $event['event_img_url'] ?>" alt="img">
            </div>
            <div>
                <img src="<?= $event['event_img_url'] ?>" alt="img">
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


</div>
</body>
</html>