<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use halumein\servicemini\helpers\RenderTariffBlockHelper;

$this->title = 'Тарифы';
$this->params['breadcrumbs'][] = $this->title;

\halumein\servicemini\assets\ServiceAsset::register($this);

?>
<div class="price-index">

    <table class="table table-hover table-responsive service-prices-table" data-role="tariff-grid">
        <tr>
            <th width="40">ID</th>
            <th width="200">Вид услуги</th>
            <?php foreach ($categories as $category) { ?>
                <th class="text-center"><?= $category->name; ?></th>
            <?php } ?>
        </tr>
        <?php foreach ($services as $service) { ?>
            <tr>
                <td><?= $service->id; ?></td>
                <td><?= $service->name; ?></td>
                <?php foreach ($categories as $category) { ?>
                    <td data-role="tariff-row">
                    <?php if ($tariffBlock = RenderTariffBlockHelper::renderBlock($service->id, $category->id)) {
                        echo $tariffBlock;
                    } else { ?>
                        <div class="form form-inline" data-role="tariff-block" data-category="<?= $category->id ?>"
                             data-service="<?= $service->id ?>" data-status="not-changed">
                            <input class="form-control" style="width: 40%" type="text" placeholder="Цена"
                                   data-role="tariff-price">
                            <input class="form-control" style="width: 40%" type="text" placeholder="Скидка"
                                   data-role="tariff-discount">
                            <a data-role="tariff-modal-btn" data-url="<?= Url::to(['ajax-model-load']) ?>"><i
                                    class="glyphicon glyphicon-pencil"></i></a>
                        </div>
                        </td>
                    <?php }
                } ?>
            </tr>
        <?php } ?>
    </table>
    <p>
        <input type="submit" name="submit" data-url="<?= Url::to(['save-tariff-grid']) ?>" data-role="send-grid"
               value="Сохранить" class="btn btn-success"/>
           <span style="display: none" data-role="alert">
               
           </span>
    </p>
</div>
<div class="tariff-modal modal fade" id="tariffModal" tabindex="-1" role="dialog" data-role="tariff-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Тариф</h4>
            </div>
            <div class="modal-body" data-role="tariff-modal-content">

            </div>
        </div>
    </div>
</div>