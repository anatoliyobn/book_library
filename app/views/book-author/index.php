<?php

use app\models\Author;
use yii\grid\SerialColumn;
use app\models\BookAuthor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var $bookModel app\models\Book */

$this->title = 'Авторы для книги: '.$bookModel->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить автора', ['add-author-to-book', 'bookId' => $bookModel->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            [
                'attribute' => 'id_author',
                'label' => 'ФИО автора',
                'value' => static function(BookAuthor $model) {
                    return $model->getAuthorModel()->getFullName();
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',
                'urlCreator' => static function ($action, BookAuthor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_book' => $model->id_book, 'id_author' => $model->id_author]);
                 }
            ],
        ],
    ]); ?>


</div>
