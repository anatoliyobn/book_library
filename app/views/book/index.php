<?php

use app\models\Book;
use yii\grid\SerialColumn;
use app\models\Author;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            'id',
            'name',
            'year',
            'isbn',
            'description:ntext',
            //'main_image',
            [
                'label' => 'Авторы',
                'format' => 'html',
                'filter' => Author::authorsListName(),
                'value' => static function(Book $model) {
                    return $model->getAuthorsInStr();
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'authors' => static function (string $url, Book $model) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', yii\helpers\Url::to(['book-author/create', 'id_book' => $model->id]), ['title' => 'Авторы',]);
                    },
                ],
            ],
        ],

    ]); ?>


</div>
