<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "couriers".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Trips[] $trips
 */
class Couriers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'couriers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trips::className(), ['courier' => 'id']);
    }
    
    public function getRegions()
    {
        return $this->hasMany(Regions::className(),['id' => 'region'] )->via('trips');
    }
}
