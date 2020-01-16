<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use app\models\search\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

use app\models\search\ProfileSearch;
use app\models\Profile;
use app\models\EntityType;
use app\models\AccountType;
use app\models\search\AccountTransactionSearch;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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

    public function actionAccounts()
    {

        $theCreator = (\Yii::$app->user->can('theCreator')) ? true : false;

        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->searchAccount(Yii::$app->request->queryParams,$theCreator);

        return $this->render('accounts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $profile = Profile::findOne($id);
        $searchModel = new AccountSearch();
        $searchModel->status = Account::IS_STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'profile' => $profile
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchTransaction = new AccountTransactionSearch();
        $dataTransaction = $searchTransaction->searchAccountMember(Yii::$app->request->queryParams,$id);

        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'searchTransaction' => $searchTransaction,
            'dataTransaction' => $dataTransaction
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Account();

        /*$entityType = EntityType::find()
            ->joinWith(['accounts'])
            ->where('not exists(select * from account WHERE account.status = '.Account::IS_STATUS_ACTIVE.' AND
                entity_type.id = account.entity_type_id AND account.user_id = '.$id.')')
            ->all();

        $accountType = AccountType::find()
            ->joinWith(['accounts'])
            ->where('not exists(select * from account WHERE account.status = '.Account::IS_STATUS_ACTIVE.' AND
                account_type.id = account.entity_type_id AND account.user_id = '.$id.')')
            ->all();
        */
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = $id;

            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'record saved!');
                return 1;
            }else{

                Yii::$app->session->setFlash('error', 'record not saved!');
                return 0;
            }
        }else{
            return $this->renderAjax('create', [
            'model' => $model,
            'id'=> $id,

            ]);
        }
           
    }

    public function actionAccountValidate($id) {
        $model = new Account();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $model->user_id = $id;
           \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Account model.
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
     * Deletes an existing Account model.
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
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
