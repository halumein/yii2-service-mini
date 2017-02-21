<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\MiniService */

$this->title = 'Update Mini Service: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mini Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mini-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
