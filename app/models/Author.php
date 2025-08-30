<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $firstname имя
 * @property string $lastname фамилия
 * @property string|null $middlename отчество
 *
 * @property BookAuthor[] $bookAuthors
 * @property Book[] $books
 */
class Author extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['middlename'], 'default', 'value' => null],
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname', 'middlename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'firstname' => 'имя',
            'lastname' => 'фамилия',
            'middlename' => 'отчество',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['id_author' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'id_book'])->via('bookAuthors');
    }

    public static function authorsListName(): array
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'fullName');
    }

    public function getFullName(): string
    {
        return sprintf('%s %s %s', $this->lastname, $this->firstname, $this->middlename);
    }
}
