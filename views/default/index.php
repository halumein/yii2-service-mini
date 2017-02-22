<?php

use yii\helpers\Url;

?>

<div class="default-index">
    <table class="table table-bordered">
        <th>Action</th>
        <th>Params</th>
        <th>Description</th>
        <tr>
            <td>test</td>
            <td>test</td>
            <td><a href="<?= Url::toRoute(['/service/service/index']) ?>">Услуги</a></td>
        </tr>
        <tr>
            <td>test</td>
            <td>test</td>
            <td><a href="<?= Url::toRoute(['/service/category/index']) ?>">Категории</a></td>
        </tr>
        <tr>
            <td>test</td>
            <td>test</td>
            <td><a href="<?= Url::toRoute(['/service/price/index']) ?>">Тарифы</a></td>
        </tr>
    </table>


</div>
