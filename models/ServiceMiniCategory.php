<?php

namespace halumein\servicemini\models;

use Yii;

/**
 * This is the model class for table "service_mini_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_category
 * @property integer $sort
 */
class ServiceMiniCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_mini_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_category', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'parent_category' => 'Родительская категория',
            'sort' => 'Сортировка',
        ];
    }
}
