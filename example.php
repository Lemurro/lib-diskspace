<?php
/**
 * Пример работы библиотеки DiskSpace
 *
 * @version 06.06.2018
 * @author  Дмитрий Щербаков <atomcms@ya.ru>
 */

use Lemurro\Lib\DiskSpace\DiskSpace;

require 'vendor/autoload.php';

$disk_space = new DiskSpace();

$examples = [
    '50GiB',
    '30GiB',
];

foreach ($examples as $example) {
    $result = $disk_space->check($example);

    if (isset($result['data'])) {
        if ($result['data']['limit_exceeded']) {
            $color = 'red';
            $message = 'Лимит превышен';
        } else {
            $color = 'green';
            $message = 'Свободного места достаточно';
        }
        ?>
        <strong><?=$example?> <span style="color: <?=$color?>"><?=$message?></span></strong><br>
        Лимит: <?=$result['data']['space_limit']?><br>
        Свободное место: <?=$result['data']['free_space']?><br>
        <br>
        <?php
    } else {
        ?>
        <strong><?=$example?> <span style="color: red">Ошибка</span></strong><br>
        <pre><?=print_r($result)?></pre>
        <?php
    }
}
