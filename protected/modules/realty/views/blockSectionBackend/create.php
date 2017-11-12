<?php
/**
 * Отображение для create:
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
    Yii::t('RealtyModule.realty', 'Добавление блок-секции'),
];

$this->pageTitle = Yii::t('RealtyModule.realty', 'Блок-секции - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RealtyModule.realty', 'Управление Блок-секциями'), 'url' => ['/realty/blockSectionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RealtyModule.realty', 'Добавить Блок-секции'), 'url' => ['/realty/blockSectionBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RealtyModule.realty', 'Блок-секции'); ?>
        <small><?=  Yii::t('RealtyModule.realty', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>