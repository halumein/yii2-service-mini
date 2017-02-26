<?php

namespace halumein\servicemini\models;

use Yii;
use halumein\servicemini\models\Service;

/**
 * This is the model class for table "service_mini_service_to_category".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $category_id
 * @property string $price
 * @property string $max_discount
 * @property string $description
 */
class ServiceToCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_mini_service_to_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'category_id', 'price'], 'required'],
            [['service_id', 'category_id'], 'integer'],
            [['price', 'max_discount'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Услуга',
            'category_id' => 'Категория',
            'price' => 'Цена',
            'max_discount' => 'Максимальная скидка',
            'description' => 'Описание',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
