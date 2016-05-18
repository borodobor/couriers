<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

// переформируем присланные массивы регионов и курьеров для выпадающего списка
$region=[];
$courier=[];
foreach ($regions as $value){
    $region[$value['id']]=$value['name'];
}

foreach ($couriers as $v){
    $courier[$v->id]=$v->name;
}

?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($trip, 'region', ['options'=>['id' => 'region']])->dropDownList($region)->label('Регион') ?>
<?= $form->field($trip, 'courier', ['options'=>['id' => 'courier']])->dropDownList($courier)->label('Курьер') ?>
<?= $form->field($trip, 'date_departure', ['options'=>['id' => 'departure']])->label('Дата выезда из Москвы') ?>
<div id="arrive"></div>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>

<script>
    $('#region').change(function(){

    })
</script>