<?php
/**
 * Отображение для index:
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
    Yii::t('SubscribeModule.subscribe', 'Управление'),
];

$this->pageTitle = Yii::t('SubscribeModule.subscribe', 'Подписки - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('SubscribeModule.subscribe', 'Управление Подписками'), 'url' => ['/backend/subscribe/subscribe/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SubscribeModule.subscribe', 'Добавить Подписку'), 'url' => ['/backend/subscribe/subscribe/create']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('SubscribeModule.subscribe', 'Экспортировать'), 'url' => ['/backend/subscribe/subscribe/export']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('SubscribeModule.subscribe', 'Подписки'); ?>
        <small><?=  Yii::t('SubscribeModule.subscribe', 'управление'); ?></small>
    </h1>
</div>

<p> <?=  Yii::t('SubscribeModule.subscribe', 'В данном разделе представлены средства управления Подписками'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'subscribe-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'email',
            'dateAdd',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
