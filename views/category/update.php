<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\Category */

$this->title = 'Редактирование категории: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="service-mini-category-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
