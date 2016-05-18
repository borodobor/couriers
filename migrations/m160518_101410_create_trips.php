<?php

use yii\db\Migration;

/**
 * Handles the creation for table `trips`.
 */
class m160518_101410_create_trips extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('trips', [
            'id' => $this->primaryKey(),
            'region'=>$this->integer(),
            'courier'=>$this->integer(),
            'date_departure'=>$this->date(),
            'date_arrival'=>$this->date()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('trips');
    }
}
