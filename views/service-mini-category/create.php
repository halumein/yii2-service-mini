<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMiniCategory */

$this->title = 'Create Service Mini Category';
$this->params['breadcrumbs'][] = ['label' => 'Service Mini Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-mini-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
