<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m250830_081250_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('название'),
            'year' => $this->integer(4)->notNull()->comment('год выпуска'),
            'isbn' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull()->notNull()->comment('описание'),
            'main_image' => $this->string()->notNull()->unique()->comment('идентификатор файла в minio'),
        ]);

        $this->createIndex(
            'idx-book-year',
            '{{%book}}',
            'year'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
