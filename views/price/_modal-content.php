<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $model halumein\servicemini\models\ServiceToCategory */

?>

<div class="price-form">

    <?php $form = ActiveForm::begin(['action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id])]); ?>

    <?= $form->field($model, 'service_id')->hiddenInput(['value' => $service['id'], 'readonly' => true])->label(false) ?>

    <?= $form->field($model, 'category_id')->hiddenInput(['value' => $category['id'], 'readonly' => true])->label(false) ?>
    <div class="form-group">
        <label for="">Услуга</label>
        <input type="text" class="form-control" value="<?= $service['name'] ?>" disabled>
    </div>
    <div class="form-group">
        <label for="">Категория</label>
        <input type="text" class="form-control" value="<?= $category['name'] ?>" disabled>
    </div>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'required' => true]) ?>

    <?= $form->field($model, 'max_discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>