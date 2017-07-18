<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model halumein\servicemini\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-mini-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropdownList($categories); ?>

    <?= $form->field($model, 'sort')->textInput()->hint('Чем выше приоритет, тем выше элемент среди других в общем списке.'); ?>

    <?=\dvizh\gallery\widgets\Gallery::widget(['model' => $model]); ?>
    <br>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
