<?php
namespace app\controllers\actions;

use app\models\Couriers;
use app\models\Regions;
use app\models\Trips;
use yii;
use yii\helpers\ArrayHelper;
/*
 * 
 * 
 * Генератор работает только если в базе нет ни одной поездки. 
 * Если поездки уже были созданы, то удалите их
 * 
 * 
 * 
 * 
 * */
trait ActionGenerator
{
    public function actionGenerator()
    {
        if(Trips::find()->where(1)->exists()){
            echo 'В базе уже есть записи поездок. Для использования генератора сначала нужно удалить их.';
            die();
        }
        $date_start='2015-06-01';
        $date_end=date('Y-m-d');
        $date_last=$date_start;
        // получаем массивы курьеров и регионов
        $couriers=Couriers::find()->asArray()->all();
        $regions=Regions::find()->asArray()->all();
        // заполняем по очереди для каждого курьера
        foreach ($couriers as $value){
            while (strtotime($date_last)<strtotime($date_end)){
                // добавляем случайный промежуток между поездками, выходные/отсутствие необходимости поездки/прочее
                $holydays=rand(1,5);
                // берем рандомный регион
                $a=rand(0,count($regions)-1);
                // берем время на поездку в него
                $time=$regions[$a]['time'];
                // создаем поездку
                $trip=new Trips();
                $trip->courier=$value['id'];
                $trip->region=$regions[$a]['id'];
                // дата отправления равна дате окончания последней поездки + простой
                $trip->date_departure= date('Y-m-d',strtotime("+$holydays days",strtotime($date_last)));
                // дата прибытия равна дате отправления + продолжительность поездки
                $trip->date_arrival= date('Y-m-d',strtotime("+$time days",strtotime($trip->date_departure)));
                // меняем дату окончания последней поездки
                $date_last=$trip->date_arrival;
                // сохраняем поездку
                $trip->save();
            }
            // обнуляем дату последней поездки перед заполнением следующего курьера
            $date_last=$date_start;
        }
        echo 'База заполнена'; die();
    }
}