<?php

namespace app\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id_author
 * @property string $phone
 *
 * @property Author $author
 */
class Subscription extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_author', 'phone'], 'required'],
            [['id_author'], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['id_author', 'phone'], 'unique', 'targetAttribute' => ['id_author', 'phone'], 'message' => 'Такая подписка уже существует'],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['id_author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id_author' => 'Id Author',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Author]].
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'id_author']);
    }

    /**
     * @return array<string>
     */
    public static function listPhonesByAuthorId(int $authorId): array
    {
        return static::find()
            ->select('phone')
            ->where(['id_author' => $authorId])
            ->column();
    }
}
