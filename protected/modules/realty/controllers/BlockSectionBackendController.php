<?php
/**
* Класс BlockSectionBackendController:
*
*   @category Yupe\yupe\components\controllers\BackController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class BlockSectionBackendController extends \yupe\components\controllers\BackController
{
    /**
    * Отображает Блок-секции по указанному идентификатору
    *
    * @param integer $id Идинтификатор Блок-секции для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }
    
    /**
    * Создает новую модель Блок-секции.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate($idBuilding)
    {
        $model = new BlockSection();
        $model->idBuilding = $idBuilding;

        if (Yii::app()->getRequest()->getPost('BlockSection') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('BlockSection'));
        
            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('RealtyModule.realty', 'Запись добавлена!')
                );

                $this->rightRedirect($model);
            }
        }
        $this->render('create', ['model' => $model]);
    }

    public function rightRedirect($model)
    {
        if (Yii::app()->getRequest()->getPost("submit-type") !== null)
            $this->redirect(
                $this->createUrl("/backend/realty/building/update?id=".$model->idBuilding)
            );
        else
            $this->redirect(
                $this->createUrl("/backend/realty/blockSection/update?id=".$model->id)
            );
    }


    /**
    * Редактирование Блок-секции.
    *
    * @param integer $id Идинтификатор Блок-секции для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (Yii::app()->getRequest()->getPost('BlockSection') !== null) {
            $model->setAttributes(Yii::app()->getRequest()->getPost('BlockSection'));

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('RealtyModule.realty', 'Запись обновлена!')
                );

                $this->rightRedirect($model);
            }
        }
        $this->render('update', ['model' => $model]);
    }
    
    /**
    * Удаляет модель Блок-секции из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Блок-секции, который нужно удалить
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
                Yii::t('RealtyModule.realty', 'Запись удалена!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
            }
        } else
            throw new CHttpException(400, Yii::t('RealtyModule.realty', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
    }
    
    /**
    * Управление Блок-секциями.
    *
    * @return void
    */
    public function actionIndex()
    {
        $model = new BlockSection('search');
        $model->unsetAttributes(); // clear any default values
        if (Yii::app()->getRequest()->getParam('BlockSection') !== null)
            $model->setAttributes(Yii::app()->getRequest()->getParam('BlockSection'));
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
        $model = BlockSection::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('RealtyModule.realty', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
