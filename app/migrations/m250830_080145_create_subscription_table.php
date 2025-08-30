<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription}}`.
 */
class m250830_080145_create_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscription}}', [
            'id_author' => $this->integer()->notNull(),
            'phone' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('id_sub-pk', '{{%subscription}}', ['id_author', 'phone']);
        $this->addForeignKey('fk-sub-id_author', '{{%subscription}}', 'id_author', '{{%author}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex(
            'idx-subscription-id_author',
            '{{%subscription}}',
            'id_author'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscription}}');
    }
}
