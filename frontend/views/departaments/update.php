<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\data\Departaments $model */

$this->title = 'Update Departaments: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departaments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
