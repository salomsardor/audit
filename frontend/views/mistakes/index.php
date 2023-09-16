<?php

use app\models\data\Mistakes;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\data\MistakesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kamchiliklar ro`yxati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mistakes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mistakes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'quantity',
            'status',
            'create_at',
            //'head_mistakes_group_code',
            //'mistakes_group_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Mistakes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'code' => $model->code]);
                }
            ],
        ],
    ]); ?>
    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
        'firstPageLabel' => 'Boshi',
        'lastPageLabel' => 'Oxiri',
    ]) ?>


</div>
