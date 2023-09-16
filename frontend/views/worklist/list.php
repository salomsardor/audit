<?php


use app\models\data\Branches;
use app\models\data\Mistakes;
use app\models\data\Regions;
use frontend\models\Worklist;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\WorklistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $dep_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worklist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Id</th>
            <th>Viloyat</th>
            <th>Filial</th>
            <th>Kamchilik nomi</th>
            <th>Kamchilik soni</th>
            <th>Kamchilik summasi</th>
            <th>...</th>
        </tr>
        <pre>
        <?php
        foreach ($list as $item) {
            echo "<tr>";
            echo "<td>" . $item->id . "</td>";
            echo "<td>" . Regions::findOne($item->region_id)->name . "</td>";
            echo "<td>" . Branches::findOne($item->branch_id)->name . "</td>";
            echo "<td>" . Mistakes::findOne($item->mistake_code)->name . "</td>";
            echo "<td>" . $item->mistake_soni . "</td>";
            echo "<td>" . $item->mistake_sum . "</td>";
            echo "<td>" . Html::a('ochish', ['edit', 'id' => $item->id], ['class' => 'btn btn-primary']) . "</td><tr>";

        }
        ?>

    </table>

