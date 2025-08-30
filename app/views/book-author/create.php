<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookAuthor */

$this->title = 'Добавить автора для книги: ' . $model->book->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['book/index']];
$this->params['breadcrumbs'][] = ['label' => $model->book->name, 'url' => ['book/view', 'id' => $model->id_book]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-create">

    <h1 class="text-danger"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>