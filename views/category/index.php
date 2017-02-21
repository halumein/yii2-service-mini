<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel halumein\servicemini\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории услуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-mini-category-index">

    <p>
        <?php echo Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 49px;']],
            'name',
            [
                'attribute' => 'parent.name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_category',
                    $categories,
                    ['class' => 'form-control', 'prompt' => 'Материнская категория']
                ),
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 100px;']],
        ],
    ]); ?>
</div>
