<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Work $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'farmoyish_id',
            'region_id',
            'branch_id',
            'year',
            'unical',
            'client_name',
            'head_mistakes_group_code',
            'mistake_code',
            'mistake_soni',
            [
                'attribute'=>'mistake_sum',
//                'filter'=>ArrayHelper::map(\app\models\data\Mistakes::find()->all(),'code','name'),
                'value'=> function($model){
                    $soni = $model->mistake_sum;
                    $soni = number_format($soni, 0, '', ' ');
                    return $soni;
                },
            ],
//            'mistake_sum',
            'mistak_from_user',
            'user_id',
            'departament_id',
            'bartaraf_soni',
            'bartaraf_sum',
            'work_status',
            'comment',
        ],
    ]) ?>

</div>
