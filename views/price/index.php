<?php

use yii\helpers\Url;
use halumein\servicemini\helpers\RenderTariffBlockHelper;

$this->title = 'Тарифы';
$this->params['breadcrumbs'][] = $this->title;

\halumein\servicemini\assets\ServiceAsset::register($this);

?>
<?php if ((!empty($services)) && (!empty($categories))) { ?>
    <div class="price-index">
        <div class="tariff-grid-error-box" data-role="error-box">
            <p class="tariff-grid-error-message" data-role="error-message">

            </p>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="tariff-grid-left-column col-md-4" style="width: 20%">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 25px;">id</th>
                            <th>услуга</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($services as $service) { ?>
                            <tr data-role="service-row">
                                <td style="width: 25px;"><?= $service->id; ?></td>
                                <td style="height: 51px;"><?= $service->name; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tariff-grid-right-column">
                    <table class="table service-prices-table" data-role="tariff-grid">
                        <thead>
                        <tr>
                            <?php foreach ($categories as $category) { ?>
                                <th class="tariff-column text-center"><?= $category->name; ?></th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($services as $service) { ?>
                            <tr data-role="category-row">
                                <?php foreach ($categories as $category) { ?>
                                    <td data-role="tariff-row">
                                    <?php if ($tariffBlock = RenderTariffBlockHelper::renderBlock($service->id, $category->id)) {
                                        echo $tariffBlock;
                                    } else { ?>
                                        <div style="" class="tariff-column form-inline" data-role="tariff-block"
                                             data-category="<?= $category->id ?>"
                                             data-service="<?= $service->id ?>">
                                            <input class="form-control" style="width: 40%" type="text"
                                                   placeholder="Цена"
                                                   data-role="tariff-price" data-price="">
                                            <input class="form-control" style="width: 40%" type="text"
                                                   placeholder="Баллы"
                                                   data-role="tariff-discount" data-discount="">
                                            <a data-role="tariff-modal-btn"
                                               data-url="<?= Url::to(['ajax-model-load']) ?>"><i
                                                    class="glyphicon glyphicon-pencil"></i></a>
                                        </div>
                                        </td>
                                    <?php }
                                } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
<?php } else { ?>
    <div class="text-center"><span class="alert alert-danger">Не заполнены таблицы услуг либо категорий!</span>
        <hr>
        <p>
            <a href="<?= Url::to(['service/index']) ?>"> Услуги</a>
        </p>
        <p>
            <a href="<?= Url::to(['category/index']) ?>"> Категории</a>
        </p>
    </div>
<?php } ?>