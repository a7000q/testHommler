<?php

namespace app\controllers;

use app\repositories\UserGoodsColumnsRepository;
use yii\filters\AccessControl;


class UserGoodsColumnsController extends \yii\web\Controller
{
    private $userColumnsRepository;

    public function __construct($id, $module, UserGoodsColumnsRepository $userColumnsRepository, $config = [])
    {
        $this->userColumnsRepository = $userColumnsRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

    public function actionSave(){
        $this->userColumnsRepository->saveColumnsByUserId(\Yii::$app->user->id, \Yii::$app->request->post());
        return $this->redirect(['/goods/index']);
    }
}
