<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

    <br style="clear: both;">
    <ul class="nav nav-pills">
        <li role="presentation" <?php if (yii::$app->request->get('view') == 'tree' | yii::$app->request->get('view') == '') echo ' class="active"'; ?>>
            <a href="<?= Url::toRoute(['category/index', 'view' => 'tree']); ?>">Деревом</a></li>
        <li role="presentation" <?php if (yii::$app->request->get('view') == 'list') echo ' class="active"'; ?>><a
                href="<?= Url::toRoute(['category/index', 'view' => 'list']); ?>">Списком</a></li>
    </ul>
    <br style="clear: both;">
    <?php if (isset($_GET['view']) && $_GET['view'] == 'list') {
        $categoriesList = GridView::widget([
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
                        'parent_id',
                        $categories,
                        ['class' => 'form-control', 'prompt' => 'Родительская категория']
                    ),
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}', 'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 100px;']],
            ],
        ]);
    } else {
        $categoriesList = \pistol88\tree\widgets\Tree::widget(['model' => new \halumein\servicemini\models\Category(), 'viewUrl' => null]);
    }
    echo $categoriesList;
    ?>
</div>
