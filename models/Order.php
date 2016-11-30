<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $status
 * @property integer $user_id
 *
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{

    const ORDER_PREPARED = 0;
    const ORDER_SENT_TO_GATEWAY = 1;
    const ORDER_FINISHED_SUCCESS = 2;
    const ORDER_FAILURE = 3;



    public function getId()
    {
        return $this->id;
    }

    public function getCost()
    {
        return 1;
    }

    public function setPaymentStatus($status)
    {
        if (!$this->user_id)
            return false;

        $this->status = $status;

        return $this;
    }

    public function setUserId($userId)
    {
        $this->user_id = intval($userId);
        return $this;
    }

    public static function getUserOrderCountForStatus($status,$userId){
        return Order::find()->where(['user_id' => $userId,'status'=>$status])->count();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
