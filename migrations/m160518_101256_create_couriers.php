<?php

use yii\db\Migration;

/**
 * Handles the creation for table `couriers`.
 */
class m160518_101256_create_couriers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('couriers', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('couriers');
    }
}
