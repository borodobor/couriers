<?php
namespace app\controllers\actions;

use app\models\Couriers;
use app\models\Regions;
use app\models\Trips;
use yii;

trait ActionMakeChart{
    public function actionMakechart(){
        $post=Yii::$app->request->post();
        if($post==[]){
            $date=date('Y-m-d');
            $dateend=date("Y-m-d", strtotime("+1 month",strtotime($date)));
        }
        else{
            $date=date('Y-m-d');
            $dateend=date("Y-m-d", strtotime("+1 month",strtotime($date)));
        }
        $date=date('Y-m-d');
        // получаем поездки за текущий период
        $trips=Couriers::find()->where(1)->joinWith('trips')->
                where("`date_departure` between '$date' and '$dateend' or `date_arrival` between '$date' and '$dateend'")->
                asArray()->all();
        // получаем регионы
        $regions=Regions::find()->asArray()->all();
        // готовим массивы для замены id регионов на их названия
        $ids=[];
        $names=[];
        foreach ($regions as $val){
            $ids[]=$val['id'];
            $names[]=$val['name'];
        }
        // формируем массив для отображения графика
        $result=[];
        foreach ($trips as $k=>$v){
            $name=$v['name'];
            foreach ($v['trips'] as $key=>$value){
                $region=$value['region'];
                $region=str_replace($ids, $names, $region);
                $dated=date('Y, n, j',strtotime('-1 month',strtotime($value['date_departure'])));
                $datear=date('Y, n, j',strtotime('-1 month',strtotime($value['date_arrival'])));
                $result[]="['$name', '$region', new Date($dated), new Date($datear)],";
            }
        }

        return $this->render('makechart',['data'=>$result]);
    }
}
