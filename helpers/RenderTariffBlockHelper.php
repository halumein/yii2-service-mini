<?php
namespace halumein\servicemini\helpers;

use yii\helpers\Url;
use halumein\servicemini\models\ServiceToCategory as Tariff;


class RenderTariffBlockHelper
{
    static function renderBlock($serviceId, $categoryId)
    {
        $tariff = Tariff::find()->where(['service_id' => $serviceId, 'category_id' => $categoryId])->one();

        if ($tariff) {
            $tariffBlock = '<div class="tariff-column form-inline" 
                            data-role="tariff-block"
                            data-category="' . $tariff->category_id . '"
                            data-service="' . $tariff->service_id . '">';
            $tariffBlock .= ' <input class="form-control" 
                             style="width: 40%" 
                             type="text"
                             placeholder="Цена"
                             data-role="tariff-price"
                             data-price="' . $tariff->price . '"
                             value="' . $tariff->price . '">';
            $tariffBlock .= ' <input class="form-control"
                             style="width: 40%"
                             type="text" 
                             placeholder="Скидка" 
                             data-role="tariff-discount"
                             data-discount="' . $tariff->max_discount . '"
                             value="' . $tariff->max_discount . '">';

            $tariffBlock .= ' <a data-role="tariff-modal-btn" data-url="' . Url::to(['ajax-model-load']) . '"><i class="glyphicon glyphicon-pencil"></i></a>';

            $tariffBlock .= '</div>';
            return $tariffBlock;

        }

        return false;
    }
}