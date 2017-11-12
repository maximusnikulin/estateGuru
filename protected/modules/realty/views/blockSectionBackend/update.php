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
    "Дом ".$model->getBuilding()->adres => ['/backend/realty/building/update/'.$model->idBuilding],
    Yii::t('RealtyModule.realty', 'Редактирование блок-секции'),
];

$this->pageTitle = Yii::t('RealtyModule.realty', 'Блок-секции - редактирование');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RealtyModule.realty', 'Управление Блок-секциями'), 'url' => ['/realty/blockSectionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RealtyModule.realty', 'Добавить Блок-секции'), 'url' => ['/realty/blockSectionBackend/create']],
    ['label' => Yii::t('RealtyModule.realty', 'Блок-секция') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('RealtyModule.realty', 'Редактирование Блок-секции'), 'url' => [
        '/realty/blockSectionBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('RealtyModule.realty', 'Просмотреть Блок-секции'), 'url' => [
        '/realty/blockSectionBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('RealtyModule.realty', 'Удалить Блок-секции'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/realty/blockSectionBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('RealtyModule.realty', 'Вы уверены, что хотите удалить Блок-секции?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RealtyModule.realty', 'Редактирование') . ' ' . Yii::t('RealtyModule.realty', 'Блок-секции'); ?>        <br/>
        <small>&laquo;<?=  $model->name; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>