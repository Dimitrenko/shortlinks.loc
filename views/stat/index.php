<?php
/* @var $this yii\web\View */
?>
<table class="table">
    <thead >
    <tr>
        <th>Дата перехода</th>
        <th>Ссылка</th>
        <th>Страна</th>
        <th>Город</th>
        <th>Браузер</th>
        <th>Верся браузера</th>
        <th>Операционная система</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($data as $items):?>
    <tr>
        <?php foreach($items as $item):?>
            <td><?=$item?></td>
        <?php endforeach;?>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
