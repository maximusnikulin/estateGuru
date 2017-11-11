<?php
/**
 * Отображение для _form:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 *
 *   @var $model Location
 *   @var $form TbActiveForm
 *   @var $this LocationBackendController
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'id'                     => 'location-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('RealtyModule.realty', 'Поля, отмеченные'); ?>
    <span class="required">*</span>
    <?=  Yii::t('RealtyModule.realty', 'обязательны.'); ?>
</div>

<?=  $form->errorSummary($model); ?>
    <?= $form->hiddenField($model, 'name', ['class' => 'js-name']); ?>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'minFloor', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help js-min-floor js-floor',
                        'data-original-title' => $model->getAttributeLabel('minFloor'),
                        'data-content' => $model->getAttributeDescription('minFloor')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'maxFloor', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help js-max-floor js-floor',
                        'data-original-title' => $model->getAttributeLabel('maxFloor'),
                        'data-content' => $model->getAttributeDescription('maxFloor')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?= $form->hiddenField($model, 'idBlockSection'); ?>

    <div class="row">
        <div class="col-sm-7">
            <div class="preview-image-wrapper<?= !$model->getIsNewRecord() && $model->image ? '' : ' hidden' ?>">
                <?=
                CHtml::image(
                    !$model->getIsNewRecord() && $model->image? $model->getImageUrl(200, 200, true) : '#',
                    $model->image,
                    [
                        'class' => 'preview-image img-thumbnail',
                        'style' => !$model->getIsNewRecord() && $model->image ? '' : 'display:none',
                    ]
                ); ?>
            </div>

            <?php if (!$model->getIsNewRecord() && $model->image): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="delete-file"> <?= Yii::t(
                            'YupeModule.yupe',
                            'Delete the file'
                        ) ?>
                    </label>
                </div>
            <?php endif; ?>

            <?= $form->fileFieldGroup(
                $model,
                'image',
                [
                    'widgetOptions' => [
                        'htmlOptions' => [
//                            'onchange' => 'readURL(this);',
                        ],
                    ],
                ]
            ); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('RealtyModule.realty', 'Сохранить Местоположение и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('RealtyModule.realty', 'Сохранить Местоположение и закрыть'),
        ]
    ); ?>

<?php $this->endWidget(); ?>

<script>
    $('.js-floor').keyup(function() {
        $('.js-name').val($('.js-min-floor').val() + '-' + $('.js-max-floor').val());
    });
</script>
