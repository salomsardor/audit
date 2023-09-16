<?php

use app\models\data\Departaments;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Work $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'year')->textInput(['value'=>2023]) ?>
            <?= $form->field($model, 'farmoyish_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(ArrayHelper::map(\app\models\data\Orders::find()->all(),'code','code'),
                [
                    'prompt'  => '.......',
                ]); ?>
            <?= $form->field($model, 'region_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'2']])->dropDownList(ArrayHelper::map($regions,'id','name'),
                [
                    'prompt'  => '.......',
                    'onchange'=> '
                $.post( "index.php?r=my%2Flistbranches&id='.'"+$(this).val(), function (data){
                $("select#work-branch_id").html(data);});'
                ]); ?>

            <?= $form->field($model, 'branch_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'2']])->dropDownList([],
                [
                    'prompt'  => '.......',
                ]); ?>

        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'unical')->textInput() ?>
            <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mistak_from_user')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'departament_id')->dropDownList(ArrayHelper::map(Departaments::find()->all(),'id','name'),[
                'prompt'  => '.......',
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'head_mistakes_group_code', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(ArrayHelper::map(\app\models\data\HeadMistakesGroup::find()->all(),'code','name'),
                [
                    'prompt'  => '.......',
                    'onchange'=> '
                $.post( "index.php?r=my%2Flistheadmistakes&id='.'"+$(this).val(), function (data){
                    $("select#work-mistake_code").html(data);});'
                ]); ?>

            <?= $form->field($model, 'mistake_code', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList([],
                [
                    'prompt'  => '.......',
                    'onchange'=> '
                $.post( "index.php?r=my%2Flistmistakes&id='.'"+$(this).val(), function (data){
                $("select#work-status").html(data);});'
                ]); ?>
            <?= $form->field($model, 'status')->dropDownList([]); ?>
            <?= $form->field($model, 'mistake_soni')->textInput() ?>
            <?= $form->field($model, 'mistake_sum')->textInput() ?>
<!--            --><?//= $form->field($model, 'mistake_sum')->textInput([
//                'type' => 'text',
//                'id' => 'numberInput', // Id ni beramiz, JavaScript ichida foydalanish uchun
//                'class' => 'form-control',
//            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'bartaraf_soni')->textInput(['value'=>0]) ?>
            <?= $form->field($model, 'bartaraf_sum')->textInput(['value'=>0]) ?>
<!--            --><?//= $form->field($model, 'bartaraf_sum')->textInput([
//                'value'=>0,
//                'type' => 'text',
//                'id' => 'numberInput', // Id ni beramiz, JavaScript ichida foydalanish uchun
//                'class' => 'form-control',
//            ]); ?>


        </div>

    </div>
    <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< JS
const numberInput = document.getElementById("numberInput");

numberInput.addEventListener("input", function () {
    const value = this.value.replace(/\D/g, "");
    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    this.value = formattedValue;
});
JS;
$this->registerJs($js);
?>