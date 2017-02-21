<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMiniCategory */

$this->title = 'Update Service Mini Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Service Mini Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-mini-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
