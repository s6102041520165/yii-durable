<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Teachers;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        
        return [
            //VerbFilter ใช้เช็คการรับ HTTP Method ของแต่ละ action
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create','update','delete','view'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex() {
        
        $teacherModel = Teachers::find()->all();
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (!Yii::$app->user->can('createOrders')) {
            throw new ForbiddenHttpException('Permision access denined.');
        }
        $model = new Orders();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            $id = $model->id;
            $withdraws = \app\models\Withdraw::find()->where('created_by = '.Yii::$app->user->id)->all();
            foreach ($withdraws as $withdraw){
                $orderDetail = new \app\models\OrdersDetail();
                //สร้าง Object เพื่อ ตัดสต็อก
                $material = \app\models\Materials::findOne($withdraw->material_id);
                $material->stock = $material->stock - $withdraw->items;
                $orderDetail->orders_id = $id;
                $orderDetail->items = $withdraw->items;
                $orderDetail->material_id = $withdraw->material_id;
                
                $material->save();
                $orderDetail->save();
            }
            \app\models\Withdraw::deleteAll('created_by = '.Yii::$app->user->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }
              
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
