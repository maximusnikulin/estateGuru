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
 *   @var $model RealtyImage
 *   @var $form TbActiveForm
 *   @var $this RealtyImageBackendController
 **/

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'action' => $this->createUrl("/backend/realty/realtyImage/create"),
        'id'                     => 'realty-image-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
    ]
);
?>

     <?=  $form->hiddenField($model, 'idRecord') ;?>
     <?=  $form->hiddenField($model, 'idTable'); ?>

    <div class="row row-for-caption">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'label', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('label'),
                        'data-content' => $model->getAttributeDescription('label')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class='row'>
        <div class="col-sm-7">
            <div class="preview-image-wrapper<?= !$model->getIsNewRecord() && $model->path ? '' : ' hidden' ?>">
                <div class="btn-group image-settings">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse"
                            data-target="#image-settings"><span class="fa fa-gear"></span></button>
                </div>
                <?=
                CHtml::image(
                    !$model->getIsNewRecord() && $model->path? $model->getImageUrl(200, 200, true) : '#',
                    $model->path,
                    [
                        'class' => 'preview-image img-thumbnail',
                        'style' => !$model->getIsNewRecord() && $model->path ? '' : 'display:none',
                    ]
                ); ?>
            </div>
            
            <?php if (!$model->getIsNewRecord() && $model->path): ?>
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
                'path',
                [
                    'widgetOptions' => [
                        'htmlOptions' => [
                              'required' => true
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
            'label'      => Yii::t('RealtyModule.realty', 'Загрузить изображение'),
        ]
    ); ?>



<?php
$criteria = new CDbCriteria();
$criteria->compare("idTable",$model->idTable);
$criteria->compare("idRecord",$model->idRecord);
$images = RealtyImage::model()->findAll($criteria);
?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($images as $index=>$image): ?>
            <tr>
                <td>
                    
                    <img src="<?= $image->getImageUrl(100, 100); ?>" alt="" class="img-responsive" style = "display: inline-block;margin-right: 20px;"/>
                    <input type="radio" class="js-main row-for-main" name="is-main" id = "is-main-<?= $index ?>" value="<?= $image->id; ?>" data-href="<?= $this->createUrl(
                        '/backend/realty/realtyImage/check?id='.$image->id); ?>" <?= ($image->isMain) ? 'checked' : ''; ?>>
                    <label class = "row-for-main" for="is-main-<?= $index ?>">Является основным</label>
                </td>
                <td class="text-center">
                    <br>
                    <b><?= $image->label; ?></b>
                    <br>
                    <br>
                    <a data-id="<?= $image->id; ?>" href="<?= $this->createUrl(
                        '/backend/realty/realtyImage/delete?id='.$image->id); ?>"
                       class="btn btn-default product-delete-image"><i
                            class="fa fa-fw fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php $this->endWidget(); ?>

<script>
    $('.js-main').click(function() {
        $.get($(this).data('href'));
    });
    if ($('.js-main').length == 1) {
        $('.js-main').trigger('click')
    }
</script>
