<?php
namespace app\controllers;

use app\common\models\Couriers;
use app\common\models\Regions;
use app\common\models\Trips;
use yii;

trait ActionMakeTrip{
    public function actionMaketrip(){
        $post=Yii::$app->request->post();
        if($post==[]) {
            $trip = new Trips();
            $couriers = Couriers::find()->asArray()->all();
            $regions = Regions::find()->asArray()->all();
            return $this->render('maketrip', ['trip' => $trip, 'couriers' => $couriers, 'regions' => $regions]);
        }else{
            $trip=new Trips();
            $trip->load($post);
        }
    }
}