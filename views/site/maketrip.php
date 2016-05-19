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
if($success==1){
    echo '<div style="color: green">Запись о поездке успешно сохранена</div>';
}
elseif($success==0){
    echo '<div style="color: red">Произошла ошибка</div>';
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
<input type="hidden" name="period" id="period" value="">
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
                console.log(data);
                if(data!=0) {
                    $result = JSON.parse(data);
                    if ($result[1] == 1) {
                        $('#arrive').html('<span style="color: red">У выбранного курьера на этот период назначена другая поездка. Выберите другого курьера или измените дату</span>');
                        $('.btn-primary').hide();
                    }
                    else {
                        $('#arrive').html('Дата прибытия из поездки: ' + $result[0]);
                        $('#period').val($result[2]);
                        $('.btn-primary').show();
                    }
                }
            });
    }

    $('#trips-courier').change(function(){
        validateTrip();
    });

    $('#trips-region').change(function(){
        validateTrip();
    });

    $('.well-sm').click(function(){
        validateTrip();
    });
</script>