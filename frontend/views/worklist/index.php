<?php

//use app\models\Worklist;
use frontend\models\Worklist;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\WorklistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bartaraf qilingan kamchiliklar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worklist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Worklist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'work_id',
            'file',
            [
                'attribute'=>'Fayl',
                'format' => 'raw',
//                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\data\Regions::find()->all(),'id','name'),
                'value' => function ($model) {
                    $yuklash = $model->file;
                    return Html::a('Скачать', ['worklist/download', 'id' => $model->work_id], ['class' => 'btn btn-success']) ;
                },
            ],
            'commet',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Worklist $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
