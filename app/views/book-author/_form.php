<?php

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_book')->textInput()->label(false)->hiddenInput() ?>

    <?= $form->field($model, 'id_author')->label(false)->dropDownList(Author::authorsListName(), ['prompt' => 'Выберите автора...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>