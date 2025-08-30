<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord as ActiveRecordAlias;

/**
 * This is the model class for table "book_author".
 *
 * @property int $id_book
 * @property int $id_author
 *
 * @property Author $author
 * @property Book $book
 */
class BookAuthor extends ActiveRecordAlias
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_book', 'id_author'], 'required'],
            [['id_book', 'id_author'], 'integer'],
            [['id_book', 'id_author'], 'unique', 'targetAttribute' => ['id_book', 'id_author'], 'message' => 'Такой автор уже добавлен для данной книги'],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['id_author' => 'id']],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['id_book' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id_book' => 'Книга',
            'id_author' => 'Автор',
        ];
    }

    /**
     * Gets query for [[Author]].
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }

    public function getAuthorModel(): Author
    {
        return $this->getAuthor()->one();
    }

    /**
     * Gets query for [[Book]].
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'id_book']);
    }

    public static function findByIdBook(int $bookId): ActiveQuery
    {
        return static::find()
            ->where(['id_book' => $bookId])
            ->orderBy(['id_author' => SORT_DESC]);
    }
}
