<?php
/**
* Класс SubscribeController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class SubscribeController extends \yupe\components\controllers\FrontController
{
    public function actionSubscribe() {
        $model = new Subscribe();
        $model->email = Yii::app()->request->getParam("email");
        $model->dateAdd = date('Y-m-d H:i:s');
        $result = $model->save();
        echo json_encode([
            'success' => $result,
            'error' => $model->getError('email'),
        ]);
    }

}
