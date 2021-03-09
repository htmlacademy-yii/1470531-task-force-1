<?php


namespace frontend\controllers;


use frontend\models\Profile;
use frontend\models\User;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $users = User::find()
            ->joinWith('profile')
            ->joinWith('userSpecializations')
            ->joinWith('tasks')
            ->all();

        return $this->render('index', ['users' => $users]);
    }
}
