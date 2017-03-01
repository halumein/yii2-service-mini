<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMini */

$this->title = 'Редактирование услуги: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="mini-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
    ]) ?>

</div>
