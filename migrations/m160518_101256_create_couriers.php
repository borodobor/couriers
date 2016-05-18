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
            'name'=>$this->string()->notNull(),
        ]);
        $this->batchInsert('couriers', ['name'],[['Иванов Иван'], ['Петров Петр'], ['Сидоров Сидор'], ['Семенов Семен'], ['Сергеев Сергей'],
            ['Павлов Павел'], ['Пупкин Василий'],['Дмитриев Дмитрий'], ['Васильев Василий'], ['Кириллов Кирилл']]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('couriers');
    }
}
