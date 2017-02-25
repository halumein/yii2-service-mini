<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceToCategory */

$this->title = 'Добавление тарифа';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mini-service-create">

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'categories' => $categories,
    ]) ?>

</div>