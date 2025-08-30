<?php

namespace app\controllers;

use app\domain\Subcription\SubscriptionInterface;
use app\models\Book;
use app\models\BookAuthor;
use app\models\Subscription;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BookAuthorController implements the CRUD actions for BookAuthor model.
 */
class BookAuthorController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionAuthorsByBookId(int $bookId): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BookAuthor::findByIdBook($bookId),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'bookModel' => Book::findOne($bookId),
        ]);
    }

    public function actionAddAuthorToBook(int $bookId, SubscriptionInterface $smsPilotService): Response|string
    {
        $model = new BookAuthor();
        $model->id_book = $bookId;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // по хорошему надо закинуть в очередь и обработать асинхронно, но по времени в ТЗ не вписывается
                $smsPilotService->send(Subscription::listPhonesByAuthorId($model->id_author));
                return $this->redirect(['authors-by-book-id', 'bookId' => $bookId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BookAuthor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id_book, int $id_author): Response
    {
        $this->findModel($id_book, $id_author)->delete();

        return $this->redirect(['book-author/authors-by-book-id', 'bookId' => $id_book]);
    }

    /**
     * Finds the BookAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id_book, int $id_author): BookAuthor
    {
        if (($model = BookAuthor::findOne(['id_book' => $id_book, 'id_author' => $id_author])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
