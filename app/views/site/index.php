<?php

/** @var yii\web\View $this */
/** @var $year int|null */
/** @var $listYears array<int,int> */
/** @var $top array<array<string,int>> */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Каталог книг</h1>

        <p class="lead">Отчет - ТОП 10 авторов выпуствиших больше книг за какой-то год.</p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th>Количество книг</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($top as $item) { ?>
            <tr>
                <td><?=htmlspecialchars($item['fullname'])?></td>
                <td><?=htmlspecialchars($item['cnt'])?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php $form = ActiveForm::begin(); ?>
        <p><?= Html::dropDownList('year', $year, $listYears) ?></p>

        <div class="form-group">
            <?= Html::submitButton('Показать', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
