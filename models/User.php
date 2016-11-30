<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    public function getIsAdmin()
    {
        return
            (\Yii::$app->getAuthManager() && $this->module->adminPermission ?
                \Yii::$app->user->can($this->module->adminPermission) : false)
            || in_array($this->username, $this->module->admins)
            || $this->isAdminActual !== null;
   }

    public function setAdmin()
    {
        return (bool)$this->updateAttributes(['isAdminActual' => 1]);
    }


    public function removeAdmin()
    {

        return (bool)$this->updateAttributes(['isAdminActual' => null]);
    }


}
