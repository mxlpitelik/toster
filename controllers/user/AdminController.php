<?php

namespace app\controllers\user;

use dektrium\user\controllers\AdminController as BaseAdminController;

use dektrium\user\filters\AccessRule;
use dektrium\user\Finder;
use dektrium\user\models\Profile;
use dektrium\user\models\User;
use dektrium\user\models\UserSearch;
use dektrium\user\Module;
use dektrium\user\traits\EventTrait;
use yii\base\ExitException;
use yii\base\Model;
use yii\base\Module as Module2;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AdminController extends BaseAdminController
{
    public function actionSetadmin($id)
    {
        if ($id == \Yii::$app->user->getId()) {
            \Yii::$app->getSession()->setFlash('danger', \Yii::t('user', 'You can not set admin on own account'));
        } else {
            $user  = $this->findModel($id);
            if ($user->getIsAdmin()) {
                $user->removeAdmin();
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User '.$user->username.' now isn\'t Admin'));
            } else {
                $user->setAdmin();
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User '.$user->username.' now is Admin'));
            }
        }

        return $this->redirect(Url::previous('actions-redirect'));
    }
}