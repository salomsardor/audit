<?php

/** @var yii\web\View $this */

use app\models\data\HeadMistakesGroup;
use app\models\Work;

$this->title = 'Hisobot';
$umumiy = Work::find()->count();
$departaments = \app\models\data\Departaments::find()->all();

?>
<div class="site-index">
    <div class="  bg-transparent rounded-3">
        <div class="  text-center">
            <h1 class="display-4">Hisobot</h1>
            <table class="table table-striped table-bordered">
                <tr>
                    <th rowspan="3">Таркибий бўлинмалар номи</th>
                    <th colspan="4">Кредит амалиётлари бўйича камчиликлар</th>
                    <th colspan="4">Бухгалтерия амалиёти бўйича</th>
                    <th colspan="4">Чакана амалиётлар</th>
                    <th colspan="4">Банк карталари сектори</th>
                    <th colspan="4">Касса амалиётлари бўйича</th>
                    <th colspan="4">Узлаштириш</th>

                </tr>
                <tr>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>
                    <th rowspan="2">Сони</th>
                    <th rowspan="2">Суммаси</th>
                    <th colspan="2">Шундан бартараф қилинди</th>

                </tr>
                <tr>
                    <th>Сони</th>
                    <th>Суммаси</th>
                    <th>Сони</th>
                    <th>Суммаси</th>
                    <th>Сони</th>
                    <th>Суммаси</th>
                    <th>Сони</th>
                    <th>Суммаси</th>
                    <th>Сони</th>
                    <th>Суммаси</th>
                    <th>Сони</th>
                    <th>Суммаси</th>
                </tr>

                <?php
                $head_mistakes = HeadMistakesGroup::find()->all();
                foreach ($departaments as $departament) {
                    echo "<tr>";
                    echo "<td>" . $departament->name . "</td>";
                    foreach ($head_mistakes as $head_mistake) {
                        $son0 = Work::find()->where(['work_status' => 0, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->count();
                        $son1 = Work::find()->where(['work_status' => 1, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->count();
                        $son0 = is_numeric($son0) ? $son0 : 0;
                        $son1 = is_numeric($son1) ? $son1 : 0;
                        $son = $son1 + $son0;

                        if ($son > 0) {

                            $sum0 = Work::find()->where(['work_status' => 0, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->sum('mistake_sum');
                            $sum1 = Work::find()->where(['work_status' => 1, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->sum('mistake_sum');
                            $sum0 = is_numeric($sum0) ? $sum0 : 0;
                            $sum1 = is_numeric($sum1) ? $sum1 : 0;
                            $sum = $sum0 + $sum1;

                            $bartaraf_son = Work::find()->where(['work_status' => 2, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->count();
                            $bartaraf_sum = Work::find()->where(['work_status' => 2, 'departament_id' => $departament->id, 'head_mistakes_group_code' => $head_mistake->code])->sum('mistake_sum');

                            $son = is_numeric($son) ? $son : 0;
                            $sum = is_numeric($sum) ? $sum : 0;
                            $bartaraf_son = is_numeric($bartaraf_son) ? $bartaraf_son : 0;
                            $bartaraf_sum = is_numeric($bartaraf_sum) ? $bartaraf_sum : 0;

                            $son = $son + $bartaraf_son;
                            $sum = $sum + $bartaraf_sum;

                            $son = is_numeric($son) ? number_format($son, 0, '', ' ') : 0;
                            $sum = is_numeric($sum) ? number_format($sum, 0, '', ' ') : 0;
                            $bartaraf_son = is_numeric($bartaraf_son) ? number_format($bartaraf_son, 0, '', ' ') : 0;
                            $bartaraf_sum = is_numeric($bartaraf_sum) ? number_format($bartaraf_sum, 0, '', ' ') : 0;



                        } else {
                            $son = '-';
                            $sum = '-';
                            $bartaraf_son = '-';
                            $bartaraf_sum = '-';

                        }

                        echo "<td>" . $son . "</td>";
                        echo "<td>" . $sum . "</td>";
                        echo "<td>" . $bartaraf_son . "</td>";
                        echo "<td>" . $bartaraf_sum . "</td>";
                    }


                    echo "</tr>";
                }


                ?>

            </table>


        </div>
    </div>

    <div class="body-content">

    </div>
</div>
