<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMini */

$this->title = 'Добавление услуги';
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mini-service-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services,
    ]) ?>

</div>
