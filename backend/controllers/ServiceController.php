<?php

namespace backend\controllers;

use common\models\Hairdresser;
use common\models\ServiceToHairdresser;
use Yii;
use common\models\Service;
use backend\models\search\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $service_id
     * @return string
     */
    public function actionAddHairdresser($service_id) {
        $model = new ServiceToHairdresser();
        $model->service_id = $service_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $service_id]);
        }

        // Получение парикмахеров к которым еще не привязанна данная услуга
        $busy_hairdressers = (new \yii\db\Query())->select('hairdresser_id')->from('service_to_hairdresser')->where(['service_id' => $service_id]);
        $hairdresser_list = Hairdresser::find()
            ->where(['NOT IN', 'hairdresser.id', $busy_hairdressers])
            ->andWhere(["<>", 'hairdresser.status', Hairdresser::STATUS_FIRED])
            ->all();

        return $this->render('add-hairdresser', [
            'model' => $model,
            'hairdresser_list' => $hairdresser_list,
        ]);
    }

    /**
     * @param $service_id
     * @param $hairdresser_id
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteHairdresser($service_id, $hairdresser_id) {
        $model = ServiceToHairdresser::find()->where(['service_id' => $service_id, 'hairdresser_id' => $hairdresser_id])->one();
        if ($model === null){
            throw new NotFoundHttpException("The requested record does not exist");
        }

        $model->delete();

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
