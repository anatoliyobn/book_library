<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name название
 * @property int $year год выпуска
 * @property string $isbn
 * @property string $description описание
 * @property UploadedFile $main_image идентификатор файла в minio
 *
 * @property Author[] $authors
 * @property BookAuthor[] $bookAuthors
 */
class Book extends ActiveRecord
{
    private const COUNT_TOP = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'description', 'year', 'isbn', 'main_image'], 'required'],
            [['year'], 'integer'],
            [['description'], 'string'],
            [['name', 'isbn', 'main_image'], 'string', 'max' => 255],
            [['isbn', 'main_image'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'название',
            'year' => 'год выпуска',
            'isbn' => 'Isbn',
            'description' => 'описание',
            'main_image' => 'идентификатор файла в minio',
        ];
    }

    /**
     * Gets query for [[Authors]].
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'id_author'])->via('bookAuthors');
    }

    /**
     * Gets query for [[BookAuthors]].
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasMany(BookAuthor::class, ['id_book' => 'id']);
    }

    public function getAuthorsInStr(): string
    {
        $authors = $this->authors;
        $authorsList = [];

        foreach ($authors as $author) {
            $authorsList[] = $author->getFullName();
        }

        return !empty($authorsList) ? implode("<br>", $authorsList): '';
    }

    /**
     * @return array<int>
     */
    public static function listYears(): array
    {
        return self::find()
            ->select('year')
            ->distinct()
            ->column();
    }

    public static function findAuthorsByYearSortByCountBooks(int $year): array
    {
        return self::find()
            ->select([
                new Expression('CONCAT(lastname, " ", firstname, " ", middlename) as fullname'),
                new Expression('COUNT(*) AS cnt'),
            ])
            ->innerJoin(BookAuthor::tableName(), BookAuthor::tableName().'.id_book = ' . self::tableName().'.id')
            ->innerJoin(Author::tableName(), Author::tableName().'.id = ' . BookAuthor::tableName().'.id_author')
            ->where([self::tableName().'.year' => $year])
            ->groupBy(Author::tableName().'.id')
            ->orderBy(['cnt' => SORT_DESC, 'fullname' => SORT_ASC])
            ->limit(self::COUNT_TOP)
            ->asArray()
            ->all();
    }
}
