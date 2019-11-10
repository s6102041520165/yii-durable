<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Materials;
use app\models\Withdraw;
use yii\web\ForbiddenHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','materials','add-withdraw','withdraw-update'],
                'rules' => [
                    [
                        'actions' => ['logout','index','materials','add-withdraw','withdraw-update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'add-withdraw' => ['post'],
                    'withdraw-update' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    { $searchModel = new \app\models\MaterialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
        ]);
    }
    
    /**
     * Displays Materails.
     *
     * @return string
     */
    public function actionMaterials()
    {
        $searchModel = new \app\models\MaterialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('materials', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
        ]);
    }
    /*
    stored materials id to withdraw and clear on actionSignout action.
     */
    public function actionAddWithdraw($id){
        $this->checkPermission();
        $model = new Withdraw();
        $data = Withdraw::find()->where('material_id='.$id)->andWhere('created_by='.Yii::$app->user->id)->one();
        
        if(isset($data)){
            $model = Withdraw::findOne($data->id);
            $model->items = ($data->items)+1;
            $model->save();
        } else {
            $model->material_id =(int)$id;
            $model->items = 1;
            $model->save();  
        }
        return $this->redirect('withdraw');
    }

    public function actionWithdraw(){
        $this->checkPermission();
        $searchModels = new \app\models\WithdrawSearch();
        $dataProvider = $searchModels->search();
        
        $orderModel = new \app\models\Orders();
        
        return $this->render('withdraw',['model' => $dataProvider,'orderModel'=>$orderModel]);
    }
    
    public function actionWithdrawUpdate($id) {
        //var_dump(Yii::$app->request->post('items'));
        $this->checkPermission();
        $model = Withdraw::findOne($id);
        $item = Yii::$app->request->post('items');
        if($item>0){
            $model->items = $item;
            $model->save();
        } else {
            Withdraw::findOne($id)->delete();
        }
        return $this->redirect('withdraw');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Withdraw::deleteAll('created_by = '.Yii::$app->user->id);
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    //Deleted model from id param.
    protected function findModel($id) {
        if (($model = Materials::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function checkPermission(){
        if (!Yii::$app->user->can('createOrders')) {
            throw new ForbiddenHttpException('Permision access denined.');
        }
    }
}
