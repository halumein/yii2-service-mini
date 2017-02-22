<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Тарифы';
$this->params['breadcrumbs'][] = $this->title;

\halumein\servicemini\assets\ServiceAsset::register($this);
$form = ActiveForm::begin();
foreach ($tariffs as $index => $tariff) {
    echo $form->field($tariff, "[$index]service_id")->label('service');
    echo $form->field($tariff, "[$index]category_id")->label('category');
    echo $form->field($tariff, "[$index]price")->label('price');
    echo $form->field($tariff, "[$index]max_discount")->label('discount');
    echo '<hr>';
}
echo '<input type="submit" name="submit" value="Сохранить" class="btn btn-success" />';
ActiveForm::end();
die;
?>
<div class="price-index">

    <?php $form = ActiveForm::begin(); ?>
    <!--    <p>-->
    <!--        <input type="submit" name="submit" value="Сохранить" class="btn btn-success" />-->
    <!--    </p>-->

    <table class="table table-hover table-responsive service-prices-table">
        <tr>
            <th width="40">ID</th>
            <th width="200">Вид услуги</th>
            <?php foreach ($categories as $category) { ?>
                <th><?= $category->name; ?></th>
            <?php } ?>
        </tr>
        <?php foreach ($services as $service) { ?>
            <tr>
                <td><?= $service->id; ?></td>
                <td><?= $service->name; ?></td>
                <?php foreach ($categories as $category) { ?>
                    <td>
                        <?php ActiveForm::begin(); ?>
                        <?php echo $form->field($tariffs[$category->id], "[]price")->label('price'); ?>
                        <input style="width: 35%;" type="text" placeholder="Цена"
                               name="Prices[<?= $service->id; ?>][<?= $category->id; ?>]['price']" value=""/>
                        <input style="width: 35%;" placeholder="Cкидка" type="text"
                               name="Prices[<?= $service->id; ?>][<?= $category->id; ?>]['discount']">
                        <a href="<?= Url::toRoute(['update']); ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                        <?php ActiveForm::end() ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <p>
        <input type="submit" name="submit" value="Сохранить" class="btn btn-success"/>
    </p>
    <?php ActiveForm::end(); ?>
</div>