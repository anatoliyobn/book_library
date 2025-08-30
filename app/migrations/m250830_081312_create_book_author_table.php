<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m250830_081312_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'id_book' => $this->integer()->notNull(),
            'id_author' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('id_relation', '{{%book_author}}', ['id_book', 'id_author']);
        $this->addForeignKey('fk-id_book', '{{%book_author}}', 'id_book', '{{%book}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-id_author', '{{%book_author}}', 'id_author', '{{%author}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
