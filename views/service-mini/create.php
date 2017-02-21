<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\MiniService */

$this->title = 'Create Mini Service';
$this->params['breadcrumbs'][] = ['label' => 'Mini Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mini-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
