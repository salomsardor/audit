<?php

namespace frontend\controllers;

use app\models\data\Departaments;
use app\models\data\Regions;
use app\models\search\WorklistSearch;

use app\models\Work;
use frontend\models\Worklist;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\User;

/**
 * WorklistController implements the CRUD actions for Worklist model.
 */
class WorklistController extends MyController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Worklist models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WorklistSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMylist()
    {
        $user_id = Yii::$app->user->id;
        $dep_id = \common\models\User::findOne($user_id)->dep_id;
        $list = Worklist::find()->where(['dep_id' => $dep_id])->all();
        $dep_name = Departaments::findOne($dep_id)->name;


        return $this->render('mylist', [
            'list' => $list,
            'dep_name' => $dep_name,
        ]);
    }

    public function actionList()
    {
        $user_id = Yii::$app->user->id;
        $dep_id = \common\models\User::findOne($user_id)->dep_id;
        $list = Work::find()->where(['departament_id' => $dep_id, 'work_status'=>0])->all();
        $dep_name = Departaments::findOne($dep_id)->name;


        return $this->render('list', [
            'list' => $list,
            'dep_name' => $dep_name,
        ]);
    }

    public function actionEdit($id)
    {
        $model = new Worklist();

        if ($this->request->isPost) {
            $user_id = Yii::$app->user->id;
            $dep_id = \common\models\User::findOne($user_id)->dep_id;
            $model->dep_id = $dep_id;

            if ($model->upload($id)) {
                $fileExtension = pathinfo($model->file, PATHINFO_EXTENSION); // Faylning uzantisi
                $file = $id . '.' . $fileExtension;
                $model->save();
            }

            if ($model->load($this->request->post())) {
                $model->file = $file;
                $work = Work::findOne($id);
                $work->work_status = 1;
                if ($model->save() && $work->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('edit', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Worklist model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Worklist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Worklist();
        $user_id = Yii::$app->user->id;

        $work = Work::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'work' => $work,
        ]);
    }

    /**
     * Updates an existing Worklist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $work = Work::find()->all();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'work' => $work,
        ]);
    }


    /**
     * Deletes an existing Worklist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionDownload($id) {
        $path = Yii::getAlias('@frontend/web/uploads/depbartaraf/') . $id . '.pdf';

        if (file_exists($path)) {
            $response = Yii::$app->response;
            $doc_name = $id."-sonli xizmat farmoyish.pdf";
            $response->sendFile($path, $doc_name, ['inline' => true]);
        } else {
            throw new \Exception('File not found');
        }
    }

    /**
     * Finds the Worklist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Worklist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Worklist::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModellist($id)
    {
        if (($model = Work::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
