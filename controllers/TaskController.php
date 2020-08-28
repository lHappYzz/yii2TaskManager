<?php


namespace app\controllers;


use app\models\Task;
use app\models\TaskSearch;
use yii\behaviors\TimestampBehavior;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function behaviors() {
        return [
            TimestampBehavior::class,
        ];
    }
    public function actionIndex() {
        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /*$dataProvider = new ArrayDataProvider([
            'allModels' => $tasks,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionView($id) {
        $task = Task::findOne($id);
        if ($task === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'task' => $task,
        ]);
    }

    public function actionCreate() {
        $task = new Task();

        if($task->load(Yii::$app->request->post()) && $task->save()){
            Yii::$app->session->setFlash('success', 'Task created');
            return $this->redirect('/task/index');
        }

        return $this->render('create', ['task' => $task]);
    }

    public function actionUpdate($id) {
        $task = Task::findOne($id);
        if ($task === null) {
            throw new NotFoundHttpException;
        }

        if($task->load(Yii::$app->request->post()) && $task->save()){
            return self::actionIndex();
        }

        return $this->renderAjax('update', [
            'task' => $task,
        ]);
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            $id = Yii::$app->request->post('id');
            $task = Task::findOne($id);
            try {
                $task->delete();
            } catch (\Throwable $e) {
                return $e->getTraceAsString();
            }
            $result = [
                'message' => 'Task deleted',
                'deletedTaskId' => $id,
            ];
            return json_encode($result);
        }
    }
}