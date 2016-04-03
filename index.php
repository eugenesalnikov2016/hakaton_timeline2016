<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Helper.php';


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

<?php if (!isset($_REQUEST['id'])): ?>

    <?php if (!empty($events)): ?>
        <div class="content">
            <a class="add-link" href="admin.php">+</a>
            <?php foreach ($events as $event): ?>
                <div class="contents" style="background-image: url(<?= $event['event_img_url'] ?>);
                    background-position: 50% 50%;
                    background-size: cover;">
                    <div class="contenttx">
                        <div class="contenttext">
                            <h1><?= $event['event_name'] ?></h1>

                            <a href="index.php?id=<?= $event['event_id'] ?>"><p><?= $event['event_text_short'] ?></p>
                            </a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="content" style="background-image: url(images/title.png);
        background-position: 50% 50%;
        background-size: cover;">
            <a class="add-link" href="admin.php">+</a>
            <div class="contenttext">
                <h1>Рождение Вселенной</h1>
                <p>По современным представлениям, наблюдаемая нами сейчас Вселенная возникла 13,7 млрд лет назад из
                    некоторого начального сингулярного состояния и с тех пор непрерывно расширяется и охлаждается. В
                    результате расширения и охлаждения во Вселенной произошли фазовые переходы, аналогичные конденсации
                    жидкости из газа, но применительно к элементарным частицам.</p>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <?php
    $sql = "SELECT * FROM `events` WHERE `event_id` = {$_REQUEST['id']}";
    $result = mysqli_query($db->link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="content" style="background-image: url(' . $row['event_img_url'] . ');
        background-position: 50% 50%;
        background-size: cover;">
            <div class="contenttext">
                <h1>' . $row['event_name'] . '</h1>
                <p>' . $row['event_text'] . '</p>
            </div>
        </div>';
    }
    ?>
<?php endif; ?>



<!-- НАВИГАЦИЯ -->

<div class="down">


    <div class="timeline">
        <div id="crumbs">
            <ul>
                <li>
                    <a href="index.php">История времен</a>
                </li>
                <li>
                    <a onclick="window.history.back();">Назад</a>
                </li>

            </ul>
        </div>

        <table class="timelinetable">

            <tr>
                <?php if ($count == 10): ?>
                    <?php for ($i = 0;
                               $i < $count;
                               $i++): ?>

                        <td>
                            <div class="timelineblock"
                                 style="background-image: url('images/<?= ($i + 1) ?>.png'); background-position: 50% 50%; background-size: cover; ">
                                <div class="text">
                                    <a href="?start=<?= $array[$i]['start'] ?>&end=<?= $array[$i]['end'] ?>&level=<?= ($level + 1) ?>"><?= Helper::bd_nice_number($array[$i]['start']) . ' — ' . Helper::bd_nice_number($array[$i]['end']) ?></a>
                                </div>

                            </div>
                        </td>
                        <?php if ($i == 4) echo '</tr><tr>'; ?>
                    <?php endfor; ?>
                <?php endif; ?>

                <?php if ($count == 5): ?>
                    <?php for ($i = $start, $k = 1;
                               $i < $end;
                               $i = $i + $section_count, $k++): ?>
                        <td>
                            <div class="timelineblock <?if ($tag !== 'a') { echo 'nolink'; }?>" style="background-image: url('images/<?= $k ?>.png'); background-position: 50% 50%; background-size: cover;">
                                <div class="text">
                                    <? if ($tag == 'a'): ?>
                                        <a href="?start=<?= $i ?>&end=<?= $i + $section_count ?>&level=<?= $level + 1 ?>"><?= Helper::bd_nice_number($i) . ' — ' . Helper::bd_nice_number($i + $section_count) ?></a>
                                    <? else: ?>
                                        <a><?= Helper::bd_nice_number($i) . ' — ' . Helper::bd_nice_number($i + $section_count) ?></a>
                                    <? endif; ?>
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