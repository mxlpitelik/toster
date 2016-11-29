<?php
use yii\helpers\Html;
use \app\models\Order;
?>

<?= \pistol88\liqpay\widgets\PaymentForm::widget([
    'autoSend' => true,
    'orderModel' => $model,
    'description' => 'Order Payment'
]);


$model->setPaymentStatus(Order::ORDER_SENT_TO_GATEWAY);
$model->save();

?>

