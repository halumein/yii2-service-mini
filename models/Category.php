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
class Category extends \yii\db\ActiveRecord
{
    
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'pistol88\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
            ],
        ];
    }
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
            'sort' => 'Приоритет',
        ];
    }

    public function getChilds()
    {
        return $this->hasMany(self::className(), ['parent_category' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_category']);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_category']);
    }

    public static function buildTree($parent_category = null)
    {
        $return = [];

        if(empty($parent_category)) {
            $categories = Category::find()->where('parent_category = 0 OR parent_category is null')->orderBy('sort DESC')->asArray()->all();
        } else {
            $categories = Category::find()->where(['parent_category' => $parent_category])->orderBy('sort DESC')->asArray()->all();
        }

        foreach($categories as $level1) {
            $return[$level1['id']] = $level1;
            $return[$level1['id']]['childs'] = self::buldTree($level1['id']);
        }

        return $return;
    }

    public static function buildTextTree($id = null, $level = 1, $ban = [])
    {
        $return = [];

        $prefix = str_repeat('--', $level);
        $level++;

        if(empty($id)) {
            $categories = Category::find()->where('parent_category = 0 OR parent_category is null')->orderBy('sort DESC')->asArray()->all();
        } else {
            $categories = Category::find()->where(['parent_category' => $id])->orderBy('sort DESC')->asArray()->all();
        }

        foreach($categories as $category) {
            if(!in_array($category['id'], $ban)) {
                $return[$category['id']] = "$prefix {$category['name']}";
                $return = $return + self::buildTextTree($category['id'], $level, $ban);
            }
        }

        return $return;
    }
}
