<?php
namespace app\controllers;

use app\models\Couriers;
use app\models\Regions;
use app\models\Trips;
use yii;

trait ActionMakeTrip{
    public function actionMaketrip(){
        $post=Yii::$app->request->post();
        if($post==[]) {
            $trip = new Trips();
            $couriers = Couriers::find()->all();
            $regions = Regions::find()->all();
            return $this->render('maketrip', ['trip' => $trip, 'couriers' => $couriers, 'regions' => $regions]);
        }else{

            $trip=new Trips();
            $trip->load($post);
            $ts=strtotime($trip->date_departure);
            $date_arr=date("Y-m-d", strtotime("+10 day",$ts));
            $trip->date_arrival=$date_arr;
            if($trip->save()){
                echo '<pre>';
                print_r($trip);
            }
        }
    }
}