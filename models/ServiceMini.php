<?php

namespace halumein\servicemini\models;

use Yii;

/**
 * This is the model class for table "service_mini_service".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $sort
 */
class ServiceMini extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'service_mini_service';
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['sort','parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'parent_id' => 'Родительская услуга',
            'sort' => 'Приоритет',
        ];
    }

    public function getService()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }
}
