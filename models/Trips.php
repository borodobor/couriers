<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "trips".
 *
 * @property integer $id
 * @property integer $region
 * @property integer $courier
 * @property string $date_departure
 * @property string $date_arrival
 *
 * @property Regions $region0
 * @property Couriers $courier0
 */
class Trips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region', 'courier'], 'integer'],
            [['date_departure', 'date_arrival'], 'safe'],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region' => 'id']],
            [['courier'], 'exist', 'skipOnError' => true, 'targetClass' => Couriers::className(), 'targetAttribute' => ['courier' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'courier' => 'Courier',
            'date_departure' => 'Date Departure',
            'date_arrival' => 'Date Arrival',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourier0()
    {
        return $this->hasOne(Couriers::className(), ['id' => 'courier']);
    }
}
