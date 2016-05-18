<?php
namespace app\controllers;

use app\models\Regions;
use app\models\Trips;
use yii;
use \DateInterval;
use \DatePeriod;
use \DateTime;

trait ActionValidTrip{
    public function actionValidtrip(){
        $post=Yii::$app->request->post();
        $cour=$post['courier'];
        // timestamp даты отправления
        $datedep=strtotime($post['datedep']);
        // сколько времени длится поездка в регион
        $period=Regions::find()->where(['id'=>$post['region']])->one();
        $period=$period->time;
        // получаем дату прибытия
        $datearr=date("Y-m-d", strtotime("+$period days",$datedep));
        // получаем дни поездки
        $begin=new DateTime($post['datedep']);
        $end=new DateTime($datearr);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        // ищем пересечение временных интервалов, если есть, то $res ставим 1
        $res='';
        foreach($daterange as $date){
            $d=$date->format("Y-m-d");
            if(Trips::find()->where("`courier`='$cour' and '$d' between `date_departure` and `date_arrival`")->exists()){
                $res=1;
            }
        }
        $data=json_encode([$datearr,$res]);
        return $data;
    }
}