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

<!DOCTYPE html>
<html>
<head>
    <link href="index.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>Timeline</title>
</head>
<body>
<!-- Добавление -->
<div class="plus">

    <a href="admin.php">
        <div class="vertical"></div>
        <div class="horizontal"></div>
    </a>
</div>

<!-- Контент -->

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
        <div class="content" style="background-image: url(<?= $event['event_img_url'] ?>);
            background-position: 50% 50%;
            background-size: cover;">
            <div class="contenttext">

                <h1><?= $event['event_name'] ?></h1>
                <p><?= $event['event_text'] ?></p>
            </div>
        </div>

    <?php endforeach; ?>
    <?php else: ?>
    <div class="content" style="background-image: url(images/title.png);
        background-position: 50% 50%;
        background-size: cover;">
        <div class="contenttext">

            <h1>Рождение Вселенной</h1>
            <p>По современным представлениям, наблюдаемая нами сейчас Вселенная возникла 13,7 млрд лет назад из некоторого начального сингулярного состояния и с тех пор непрерывно расширяется и охлаждается. В результате расширения и охлаждения во Вселенной произошли фазовые переходы, аналогичные конденсации жидкости из газа, но применительно к элементарным частицам.</p>

        </div>

    </div>
<?php endif; ?>





<div class="none"></div>

<!-- НАВИГАЦИЯ -->

<div class="down">

    <div id="crumbs">
        <ul>
            <li><a href="index.php">История времен</a></li>
            <li><a onclick="window.history.back();">Назад</a></li>

        </ul>
    </div>

    <div class="timeline">

        <table class="timelinetable">

            <tr>
                <?php if ($count == 10): ?>
                    <?php for ($i = 0; $i < $count; $i++): ?>

                        <td>
                            <div class="timelineblock" style="background-image: url(images/<?= $i ?>.png);
                                background-position: 50% 50%;
                                background-size: cover; ">
                                <div class="text"><a
                                        href="?start=<?= $array[$i]['start'] ?>&end=<?= $array[$i]['end'] ?>&level=<?= ($level + 1) ?>"><?= $array[$i]['start'] . ' - ' . $array[$i]['end'] ?></a>
                                </div>

                            </div>
                        </td>
                        <?php if ($i == 4) echo '</tr><tr>'; ?>
                    <?php endfor; ?>
                <?php endif; ?>

                <?php if ($count == 5): ?>
                <?php for ($i = $start, $k = 0;
                $i < $end;
                $i = $i + $section_count, $k++): ?>
                <td>
                    <div class="timelineblock" style="background-image: url(images/<?= $k ?>.png);
                        background-position: 50% 50%;
                        background-size: cover; ">
                        <div class="text">

                            <<? echo ($tag == 'a') ? 'a href="?start=' . $i . '&end=' . ($i + $section_count) . '&level=' . ($level + 1) . '"' : 'div'; ?>
                            ><?= $i . ' - ' . ($i + $section_count) ?> </<? echo ($tag == 'a') ? 'a' : 'div'; ?>
                        >

                    </div>
    </div>
    </td>
    <?php endfor; ?>
    <?php endif; ?>
    </tr>

    </table>
</div>

</div>
</body>
</html>