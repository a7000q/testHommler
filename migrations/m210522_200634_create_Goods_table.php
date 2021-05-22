<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Goods}}`.
 */
class m210522_200634_create_Goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Goods}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'sku' => $this->string(),
            'name' => $this->string(),
            'count' => $this->integer(),
            'type' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Goods}}');
    }
}
