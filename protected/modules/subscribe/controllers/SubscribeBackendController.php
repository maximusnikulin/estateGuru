<?php

/**
 * SubscribeBackendController контроллер для subscribe в панели управления
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2017 amyLabs && Yupe! team
 * @package yupe.modules.subscribe.controllers
 * @since 0.1
 *
 */
class SubscribeBackendController extends \yupe\components\controllers\BackController
{
    /**
     * Отображает Подписку по указанному идентификатору
     *
     * @param integer $id Идинтификатор Подписку для отображения
     *
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    /**
     * Создает новую модель Подписки.
     * Если создание прошло успешно - перенаправляет на просмотр.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Subscribe;

        if (Yii::app()->getRequest()->getPost('Subscribe') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Subscribe'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SubscribeModule.subscribe', 'Запись добавлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('create', ['model' => $model]);
    }

    /**
     * Редактирование Подписки.
     *
     * @param integer $id Идинтификатор Подписку для редактирования
     *
     * @return void
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('Subscribe') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('Subscribe'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('SubscribeModule.subscribe', 'Запись обновлена!')
                );

                $this->redirect(
                    (array)Yii::app()->getRequest()->getPost(
                        'submit-type',
                        [
                            'update',
                            'id' => $model->id
                        ]
                    )
                );
            }
        }
        $this->render('update', ['model' => $model]);
    }

    /**
     * Удаляет модель Подписки из базы.
     * Если удаление прошло успешно - возвращется в index
     *
     * @param integer $id идентификатор Подписки, который нужно удалить
     *
     * @return void
     */
    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            // поддерживаем удаление только из POST-запроса
            $this->loadModel($id)->delete();

            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('SubscribeModule.subscribe', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('SubscribeModule.subscribe', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }

    /**
     * Управление Подписками.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Subscribe('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('Subscribe') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('Subscribe'));
        $this->render('index', ['model' => $model]);
    }

    /**
     * Возвращает модель по указанному идентификатору
     * Если модель не будет найдена - возникнет HTTP-исключение.
     *
     * @param integer идентификатор нужной модели
     *
     * @return void
     */
    public function loadModel($id)
    {
        $model = Subscribe::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('SubscribeModule.subscribe', 'Запрошенная страница не найдена.'));

        return $model;
    }

    public function actionExport()
    {
        $model = Subscribe::model()->findAll();
        $result = [];
        foreach ($model as $subscribe) {
            $result[] = [
                'Код' => $subscribe->id,
                'Почта' => $subscribe->email,
                'Дата добавления' => $subscribe->dateAdd,
            ];
        }
        $this->download_send_headers('export '.date('d.m.Y').".csv");
        echo $this->arrayToCsv($result);
        die;
    }

    protected function arrayToCsv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        foreach ($array as $key => $item) {
            foreach ($item as $fieldName => $value) {
                unset($array[$key][$fieldName]);
                $array[$key][iconv('UTF-8', 'WINDOWS-1251', $fieldName)] = iconv('UTF-8', 'WINDOWS-1251', $value);
            }
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)), ';');
        foreach ($array as $row) {
            fputcsv($df, $row, ';');
        }
        fclose($df);
        return ob_get_clean();
    }

    protected function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
}