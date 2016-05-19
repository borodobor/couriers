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
                                                        ['Санкт-Петербург', 6],
                                                        ['Уфа',4],
                                                        ['Нижний Новгород',4],
                                                        ['Владимир',2],
                                                        ['Кострома',3],
                                                        ['Екатеринбург',8],
                                                        ['Ковров',2],
                                                        ['Воронеж',6],
                                                        ['Самара', 8],
                                                        ['Астрахань',10]
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
