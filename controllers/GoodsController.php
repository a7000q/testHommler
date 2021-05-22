<?php

namespace app\controllers;

use app\models\GoodsSearchModel;
use app\repositories\GoodsRepository;
use app\repositories\UserGoodsColumnsRepository;
use Yii;
use app\models\Goods;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
{
    private $goodsRepository;
    private $userColumnsRepository;

    public function __construct($id, $module, GoodsRepository $goodsRepository, UserGoodsColumnsRepository $userColumnsRepository, $config = [])
    {
        $this->goodsRepository = $goodsRepository;
        $this->userColumnsRepository = $userColumnsRepository;
        parent::__construct($id, $module, $config);
    }

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
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearchModel();

        if (Yii::$app->request->isPost){
            $searchModel->load(Yii::$app->request->post());
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $searchModel->search(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'columns' => $this->userColumnsRepository->getColumnsByUserId(Yii::$app->user->id),
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if (Yii::$app->request->isPost) {
            $model = $this->goodsRepository->saveByRequest($model, Yii::$app->request);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model = $this->goodsRepository->saveByRequest($model, Yii::$app->request);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->goodsRepository->delete($this->findModel($id));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
