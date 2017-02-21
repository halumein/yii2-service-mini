<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMiniCategory */

$this->title = 'Добавление категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-mini-category-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
