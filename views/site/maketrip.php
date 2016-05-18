<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use \dosamigos\datepicker\DatePicker;

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
<?= $form->field($trip, 'region')->dropDownList($region)->label('Регион') ?>
<?= $form->field($trip, 'courier')->dropDownList($courier)->label('Курьер') ?>
<?= $form->field($trip, 'date_departure')->widget(
    DatePicker::className(), [
    'options'=>['style'=>'float:left'],
    'inline' => true,
    'language' =>'ru',
    'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
    ]
])->label('Дата отъезда');?>
<div id="arrive"></div>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary','style'=>'float:right']) ?>
</div>
<?php ActiveForm::end();?>

<script>
    function validateTrip() {
        $cour=$('#trips-courier').val();
        $reg=$('#trips-region').val();
        $datedep=$('#trips-date_departure').val();
        $.post('/site/validtrip',{'courier':$cour,'region':$reg,'datedep':$datedep},
            function(data){
                $result=JSON.parse(data);
                $('#arrive').html('Дата прибытия из поездки: '+$result[0]);
                console.log($result);
            });
//        console.log($datedep);
    }
    $('#trips-courier').on('click',function () {
        validateTrip();
    })
    $(document).on('ready',function (){
//        validateTrip();
    })
</script>