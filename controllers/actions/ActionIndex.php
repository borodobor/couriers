<?php
namespace app\controllers\actions;

use app\models\Couriers;
use app\models\Regions;
use app\models\Trips;
use yii;

trait ActionIndex
{
    public function actionIndex()
    {
        $post=Yii::$app->request->post();

        if($post==[]){
            $date=date('Y-m-d');
            $dateend=date("Y-m-d", strtotime("+1 month",strtotime($date)));
        }
        else{
            $date=$post['date_from'];
            $dateend=$post['date_to'];
        }
        // получаем поездки за текущий период
        $trips=Trips::find()->where("`date_departure` between '$date' and '$dateend'")->orWhere("`date_arrival` between '$date' and '$dateend'")->orderBy('courier')->asArray()->all();
        // получаем регионы
        $regions=Regions::find()->asArray()->all();
        // получаем курьеров
        $couriers=Couriers::find()->asArray()->all();
        // готовим массивы для замены id регионов на их названия
        $ids=[];
        $names=[];
        foreach ($regions as $val){
            $ids[]=$val['id'];
            $names[]=$val['name'];
        }
        // готовим массивы для замены id курьеров на их имена
        $cids=[];
        $cnames=[];
        foreach ($couriers as $val){
            $cids[]=$val['id'];
            $cnames[]=$val['name'];
        }
        $cids=array_reverse($cids);
        $ids=array_reverse($ids);
        $names=array_reverse($names);
        $cnames=array_reverse($cnames);
        // формируем массив для отображения графика
        $result=[];
        $count=1;
        foreach ($trips as $k=>$v){
            $name=$v['courier'];
            $name=str_replace($cids, $cnames,$name,$count);
            $region=$v['region'];
            $region=str_replace($ids, $names, $region);
            $dated=date('Y, n, j',strtotime($v['date_departure']));
            $datear=date('Y, n, j',strtotime($v['date_arrival']));
            $result[]="['$name', '$region', new Date($dated), new Date($datear)],";

        }

        return $this->render('index',['data'=>$result]);
    }
}
