<?php
/**
 * Отображение для update:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('RealtyModule.realty', 'Дома') => ['/backend/realty/building/index'],
    "Дом ".$model->getBlockSection()->getBuilding()->adres => ['/backend/realty/building/update/'.$model->getBlockSection()->idBuilding],
    "Блок-секция ".$model->getBlockSection()->name => ['/backend/realty/blockSection/update/'.$model->idBlockSection],
    Yii::t('RealtyModule.realty', 'Редактирование местоположения'),
];

$this->pageTitle = Yii::t('RealtyModule.realty', 'Местоположения - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RealtyModule.realty', 'Управление Местоположениями'), 'url' => ['/realty/locationBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RealtyModule.realty', 'Добавить Местоположение'), 'url' => ['/realty/locationBackend/create']],
    ['label' => Yii::t('RealtyModule.realty', 'Местоположение') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('RealtyModule.realty', 'Редактирование Местоположения'), 'url' => [
        '/realty/locationBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('RealtyModule.realty', 'Просмотреть Местоположение'), 'url' => [
        '/realty/locationBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('RealtyModule.realty', 'Удалить Местоположение'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/realty/locationBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('RealtyModule.realty', 'Вы уверены, что хотите удалить Местоположение?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RealtyModule.realty', 'Редактирование') . ' ' . Yii::t('RealtyModule.realty', 'Местоположения'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>