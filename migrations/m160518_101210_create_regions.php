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
            'name'=> $this->string()->notNull(),
            'time'=>$this->integer()->notNull()
        ]);
        $this->batchInsert('regions', ['name','time'],[
                                                        ['Санкт-Петербург', 3],
                                                        ['Уфа',4],
                                                        ['Нижний Новгород',3],
                                                        ['Владимир',1],
                                                        ['Кострома',2],
                                                        ['Екатеринбург',5],
                                                        ['Ковров',1],
                                                        ['Воронеж',3],
                                                        ['Самара', 4],
                                                        ['Астрахань',5]
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
