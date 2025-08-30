<?php

use app\models\Book;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'year',
            'isbn',
            'description:ntext',
            'main_image',
            [
                'label'  => 'Изображение',
                'format' => 'raw',
                'value'  => Html::img(Yii::$app->minio->getObjectUrl($model->main_image), ['style' => 'width:300px;']),
            ],
            [
                'label' => 'Авторы',
                'format' => 'html',
                'value' => static function(Book $model) {
                    return $model->getAuthorsInStr();
                }
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a('Управление авторами  ', ['book-author/authors-by-book-id', 'bookId' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

</div>
