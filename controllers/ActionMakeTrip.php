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
        }
    }
}