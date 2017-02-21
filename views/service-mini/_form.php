<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\ServiceMini */
/* @var $form yii\widgets\ActiveForm */
/* @var $services */

$parentServices[''] = 'Нет';
foreach($services as $id => $service) {
    $parentServices[$id] = $service;
}

if(!$model->parent_id) {
    $model->parent_id = 0;
}
?>

<div class="mini-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'sort')->textInput(['maxlength' => true])->hint('Чем выше приоритет, тем выше элемент среди других в общем списке.'); ?>

    <?= $form->field($model, 'parent_id')->dropdownList($parentServices);?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
