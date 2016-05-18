<?php

use yii\db\Migration;

/**
 * Handles the creation for table `regions`.
 */
class m160518_101210_create_regions extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('regions', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'time'=>$this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('regions');
    }
}
