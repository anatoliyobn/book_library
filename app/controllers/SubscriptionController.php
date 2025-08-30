<?php

namespace app\controllers;

use app\models\Subscription;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class SubscriptionController extends Controller
{
    /**
     * @throws Exception
     * @throws BadRequestHttpException
     */
    public function actionAdd(): Response
    {
        $model = new Subscription();

        if ($this->request->isPost) {
            $model->setAttribute('id_author', $this->request->post('id_author'));
            $model->setAttribute('phone', $this->request->post('phone'));
            if ($model->validate()) {
                $model->save(false);
            } else {
                throw new BadRequestHttpException('Не валидные данные');
            }

        }

        return $this->redirect(['author/view', 'id' => $model->id_author]);
    }
}
