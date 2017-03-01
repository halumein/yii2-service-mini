<?php

use yii\helpers\Url;

?>

<div class="default-index">
    <table class="table table-bordered">
        <th>Action</th>
        <th>Params</th>
        <th>Description</th>
        <tr>
            <td><a href="<?= Url::toRoute(['/service/service/index']) ?>"><span>/service/service (Услуги)</span></a></td>
            <td>[ ]</td>
            <td>Всё, что связано с предоставляемыми услугами (создание, добавление, редактирование, удаление).</td>
        </tr>
        <tr>
            <td><a href="<?= Url::toRoute(['/service/category/index']) ?>"><span>/service/category (Категории)</span></a></td>
            <td>[ ]</td>
            <td>Всё, что связано с категориями предоставляемых услуг (создание, добавление, редактирование, удаление).</td>
        </tr>
        <tr>
            <td><a href="<?= Url::toRoute(['/service/price/index']) ?>"><span>/service/price (Тарифы)</span></a></td>
            <td>[ ]</td>
            <td>Сводная таблица категорий и услуг, с возможностью заполнения цены и максимальной скидки на конкретную услугу, в конкретной категории.</td>
        </tr>
    </table>


</div>
