<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Worklist $model */

$this->title = 'Kamchilikni bartaraf qilish ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'lists', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="worklist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
