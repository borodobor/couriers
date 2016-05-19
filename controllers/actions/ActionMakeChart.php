<?php
namespace app\controllers\actions;

use app\models\Couriers;
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
        $trips=Couriers::find()->where(1)->joinWith('trips')->
                where("`date_departure` between '$date' and '$dateend' or `date_arrival` between '$date' and '$dateend'")->
                joinWith('region')->asArray()->all();
        echo '<pre>';
        print_r($trips);
        die();
//        $result=[]
//        foreach ($trips as $k=>$v){
//            $result[]=[$v['name'],];
//        }
    }
}
//            [ 'President', 'John Adams', new Date(1797, 2, 4), new Date(1801, 2, 4) ],
//            [ 'President', 'Thomas Jefferson', new Date(1801, 2, 4), new Date(1809, 2, 4) ],
//            [ 'Vice President', 'John Adams', new Date(1789, 3, 21), new Date(1797, 2, 4)],
//            [ 'Vice President', 'Thomas Jefferson', new Date(1797, 2, 4), new Date(1801, 2, 4)],