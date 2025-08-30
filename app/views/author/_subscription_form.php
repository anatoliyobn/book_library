<?php

use yii\helpers\Html;

/** @var app\models\Author $model */

?>

<?= Html::beginForm(['/subscription/add'], 'POST', ['id' => $model->id]) ?>
    <div class="form-group">
        <p><?= Html::textInput('phone', '', ['label' => 'номер телефона']) ?></p>
        <p><?= Html::textInput('id_author', $model->id, ['hidden' => true]) ?></p>
        <p><?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?></p>
    </div>
<?= Html::endForm() ?>