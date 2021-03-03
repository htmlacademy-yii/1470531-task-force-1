<?php


namespace frontend\controllers;


use yii\db\Query;

class TasksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = new Query();
        $query
            ->select(['t.created_on', 't.title', 't.address', 't.budget', 't.description', 'c.title category'])
            ->from('task as t')
            ->join('INNER JOIN', 'category c', 't.category_id = c.id')
            ->orderBy(['t.created_on' => SORT_DESC]);
        $tasks = $query->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}
