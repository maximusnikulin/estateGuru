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
    Yii::t('SubscribeModule.subscribe', 'Подписки') => ['/backend/subscribe/subscribe/index'],
    Yii::t('SubscribeModule.subscribe', 'Добавление'),
];

$this->pageTitle = Yii::t('SubscribeModule.subscribe', 'Подписки - добавление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SubscribeModule.subscribe', 'Управление Подписками'), 'url' => ['/subscribe/subscribe/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SubscribeModule.subscribe', 'Добавить Подписку'), 'url' => ['/subscribe/subscribe/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SubscribeModule.subscribe', 'Подписки'); ?>
        <small><?=  Yii::t('SubscribeModule.subscribe', 'добавление'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>