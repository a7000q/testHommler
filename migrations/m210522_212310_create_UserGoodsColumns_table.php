<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%UserGoodsColumns}}`.
 */
class m210522_212310_create_UserGoodsColumns_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%UserGoodsColumns}}', [
            'id' => $this->primaryKey(),
            'column' => $this->string(),
            'visible' => $this->boolean(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%UserGoodsColumns}}');
    }
}
