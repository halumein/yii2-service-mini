<?php
use yii\helpers\Html;

$this->title = 'Обновление цены: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тарифы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';

?>
<div class="price-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'services' => $services,
        'categories' => $categories,
    ]) ?>

</div>