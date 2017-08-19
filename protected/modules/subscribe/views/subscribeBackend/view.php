<?php
/**
 * Отображение для view:
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
    $model->id,
];

$this->pageTitle = Yii::t('SubscribeModule.subscribe', 'Подписки - просмотр');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SubscribeModule.subscribe', 'Управление Подписками'), 'url' => ['/subscribe/subscribe/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SubscribeModule.subscribe', 'Добавить Подписку'), 'url' => ['/subscribe/subscribe/create']],
    ['label' => Yii::t('SubscribeModule.subscribe', 'Подписка') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('SubscribeModule.subscribe', 'Редактирование Подписки'), 'url' => [
        '/subscribe/subscribe/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('SubscribeModule.subscribe', 'Просмотреть Подписку'), 'url' => [
        '/subscribe/subscribe/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('SubscribeModule.subscribe', 'Удалить Подписку'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/subscribe/subscribe/delete', 'id' => $model->id],
        'confirm' => Yii::t('SubscribeModule.subscribe', 'Вы уверены, что хотите удалить Подписку?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SubscribeModule.subscribe', 'Просмотр') . ' ' . Yii::t('SubscribeModule.subscribe', 'Подписки'); ?>        <br/>
        <small>&laquo;<?=  $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'email',
        'dateAdd',
    ],
]); ?>
