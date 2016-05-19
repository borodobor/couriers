<?php
namespace app\controllers\actions;

use app\models\Couriers;
use app\models\Regions;
use app\models\Trips;
use yii;

trait ActionMakeTrip
{
    public function actionMaketrip()
    {
        $post=Yii::$app->request->post();

        if($post!=[]) {
            $period=$post['period'];
            $trip=new Trips();
            $trip->load($post);
            $ts = strtotime($trip->date_departure);
            $date_arr = date("Y-m-d", strtotime("+$period days", $ts));
            $trip->date_arrival = $date_arr;
            if ($trip->save()) {
                $success=1;
            }
            else{
                $success=0;
            }
        }
        else {
            $success=2;
        }
        $trip = new Trips();
        $couriers = Couriers::find()->all();
        $regions = Regions::find()->all();
        return $this->render('maketrip', ['trip' => $trip, 'couriers' => $couriers, 'regions' => $regions, 'success'=>$success]);
        
    }
}