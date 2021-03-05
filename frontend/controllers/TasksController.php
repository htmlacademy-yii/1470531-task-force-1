<?php


namespace frontend\controllers;


use frontend\models\Task;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()
            ->joinWith('category')
            ->where(['>=', 'expire', time()])
            ->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}
