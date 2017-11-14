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
    "Дом ".$model->getBlockSection()->getBuilding()->adres => ['/backend/realty/building/update/'.$model->getBlockSection()->idBuilding],
    "Блок-секция ".$model->getBlockSection()->name => ['/backend/realty/blockSection/update/'.$model->idBlockSection],
    Yii::t('RealtyModule.realty', 'Добавление местоположения'),
];

$this->pageTitle = Yii::t('RealtyModule.realty', 'Местоположения - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RealtyModule.realty', 'Управление Местоположениями'), 'url' => ['/realty/locationBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RealtyModule.realty', 'Добавить Местоположение'), 'url' => ['/realty/locationBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RealtyModule.realty', 'Местоположения'); ?>
        <small><?=  Yii::t('RealtyModule.realty', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>