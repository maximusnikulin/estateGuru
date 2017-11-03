<?php
/**
 * Отображение для _form:
 *
 * @category YupeView
 * @package  yupe
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 *
 * @var $model BlockSection
 * @var $form TbActiveForm
 * @var $this BlockSectionBackendController
 **/
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Common"); ?></a></li>
    <li class=""><a href="#locations" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Locations"); ?></a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="common">
        <?
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm', [
                'id' => 'block-section-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'htmlOptions' => ['class' => 'well'],
            ]
        );
        ?>

        <div class="alert alert-info">
            <?= Yii::t('RealtyModule.realty', 'Поля, отмеченные'); ?>
            <span class="required">*</span>
            <?= Yii::t('RealtyModule.realty', 'обязательны.'); ?>
        </div>

        <?= $form->errorSummary($model); ?>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->textFieldGroup($model, 'name', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('name'),
                            'data-content' => $model->getAttributeDescription('name')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <?= $form->hiddenField($model, 'idBuilding'); ?>

        <?php $this->widget(
            'bootstrap.widgets.TbButton', [
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => Yii::t('RealtyModule.realty', 'Сохранить Блок-секции и продолжить'),
            ]
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton', [
                'buttonType' => 'submit',
                'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
                'label' => Yii::t('RealtyModule.realty', 'Сохранить Блок-секции и закрыть'),
            ]
        ); ?>

        <?php $this->endWidget(); ?>
    </div>
    <div class="tab-pane" id="locations">
        <?php if ($model->isNewRecord): ?>
            <h2>Сначала сохраните основную информацию о блок-секции</h2>
        <?php else: ?>
            <?php
            $this->widget(
                'yupe\widgets\CustomGridView',
                [
                    'actionsButtons' => [
                        CHtml::link(
                            Yii::t('YupeModule.yupe', 'Add'),
                            $this->createUrl("/backend/realty/location/create?idBlockSection=" . $model->id),
                            ['class' => 'btn btn-success pull-right btn-sm']
                        ),
                    ],
                    'ajaxUpdate' => false,
                    'id' => 'apartment-grid',
                    'type' => 'striped condensed',
                    'dataProvider' => $model->getLocation()->search(),
                    'filter' => $model->getLocation(),
                    'columns' => [
                        [
                            'name' => 'image',
                            'filter' => false,
                            'type' => 'raw',
                            'value' => function ($data) {
                                return CHtml::image($data->getImageUrl(40, 40), $data->image, ["width" => 40, "height" => 40, "class" => "img-thumbnail"]);
                            },
                        ],
                        'name',
                        [
                            'class' => 'yupe\widgets\CustomButtonColumn',
                            "updateButtonUrl" => function ($data) {
                                return $this->createUrl("/backend/realty/location/update?id=" . $data->id);
                            },
                            "deleteButtonUrl" => function ($data) {
                                return $this->createUrl("/backend/realty/location/delete?id=" . $data->id);
                            },
                        ],
                    ],
                ]
            ); ?>
        <?php endif; ?>
    </div>
</div>

