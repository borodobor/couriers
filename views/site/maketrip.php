<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$region='';
$courier='';
foreach ($regions as $k=>$v){
    $region.="'$k'=>'$v',";
}
foreach ($couriers as $k=>$v){
    $courier="'$k'=>'$v',";
}

?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($trip, 'region', ['options'=>['id' => 'region']])->dropDownList([$region])->label('Регион') ?>
<?= $form->field($trip, 'courier', ['options'=>['id' => 'courier']])->dropDownList([$courier])->label('Курьер') ?>
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