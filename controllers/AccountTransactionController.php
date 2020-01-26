<?php

namespace app\controllers;

use Yii;
use app\models\AccountTransaction;
use app\models\search\AccountTransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\AccountType;
use app\models\Account;

/**
 * AccountTransactionController implements the CRUD actions for AccountTransaction model.
 */
class AccountTransactionController extends Controller
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
     * Lists all AccountTransaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountTransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccountTransaction model.
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

    public function actionSubLedger($id)
    {
        $accountType = AccountType::find()->where(['chart_of_account_code'=>$id])->one();

        $accounts =  Account::find()->where(['account_type_id'=> $accountType->id])->all();

        $account_ids = array();

        foreach ($accounts as $account) {

            $account_ids[] = $account->id;
        }


        $searchModel = new AccountTransactionSearch();
        $dataProvider = $searchModel->searchSubLedger(Yii::$app->request->queryParams,$account_ids);

        return $this->render('sub-ledger', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'account_ids' => $account_ids,
            'accountType' => $accountType
        ]);
    }

    /**
     * Creates a new AccountTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new AccountTransaction();

       
        if ($model->load(Yii::$app->request->post())) {

            $model->getTransactionAccountProcess();
            
            if($model->xact_type_code_ext == 'Wd')
            {

                $total = $model->getCheckNegative($model->account_no,$model->amount);
                if($total >= 0)
                {
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Transaction saved!');
                    return 1;

                }else{

                    Yii::$app->session->setFlash('error', 'Please check your amount you want to widraw');
                    return 2;
                }
            }else{

                if($model->save())
                {
                    Yii::$app->session->setFlash('success', 'Transaction saved!');
                    return 1;

                }else{

                    return 2;
                }
            }
            
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'id' => $id
        ]);
    }

    /**
     * Updates an existing AccountTransaction model.
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
     * Deletes an existing AccountTransaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountTransaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
