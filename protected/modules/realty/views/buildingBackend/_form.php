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
 *   @var $model Building
 *   @var $form TbActiveForm
 *   @var $this BuildingController
 **/
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Common"); ?></a></li>
    <li class="js-item js-item-cottage js-item-earth js-item-commercial js-item-home"><a href="#images" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Images"); ?></a></li>
    <li class="js-item js-item-cottage"><a href="#planning" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Planning"); ?></a></li>
    <li class="js-item js-item-home js-item-second"><a href="#block-sections" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Blocksections"); ?></a></li>
    <li class="js-item js-item-home js-item-second"><a href="#apartments" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Apartments"); ?></a></li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="common">

    <?php


    $form = $this->beginWidget(
        '\yupe\widgets\ActiveForm',
        [
            'id' => 'product-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'type' => 'vertical',
            'htmlOptions' => ['enctype' => 'multipart/form-data', 'class' => 'well'],
            'clientOptions' => [
                'validateOnSubmit' => true,
            ],
        ]
    );
    ?>

    <div class="alert alert-info">
        <?=  Yii::t('RealtyModule.realty', 'Поля, отмеченные'); ?>
        <span class="required">*</span>
        <?=  Yii::t('RealtyModule.realty', 'обязательны.'); ?>
    </div>

    <?=  $form->errorSummary($model); ?>

    <div class="row js-status">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'status', [
                'widgetOptions' => [
                    'data' => Building::getStatuses(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content' => $model->getAttributeDescription('status')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'adres', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('adres'),
                        'data-content' => $model->getAttributeDescription('adres')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'adres']); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'rayon', [
                'widgetOptions' => [
                    'data' => $model->getRayons(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('rayon'),
                        'data-content' => $model->getAttributeDescription('rayon')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-home js-item-cottage">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'floor', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('floor'),
                        'data-content' => $model->getAttributeDescription('floor')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-commercial">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'floorPos', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('floorPos'),
                        'data-content' => $model->getAttributeDescription('floorPos')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <!-- <div class="row js-item js-item-home js-item-commercial">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'priceForMeter', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('priceForMeter'),
                        'data-content' => $model->getAttributeDescription('priceForMeter')
                    ]
                ]
            ]); ?>
        </div>
    </div> -->

    <div class="row js-item js-item-home js-item-cottage">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'walls', [
                'widgetOptions' => [
                    'data' => $model->getWallsTypes(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('walls'),
                        'data-content' => $model->getAttributeDescription('walls')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row" >
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'longitude', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help js-map-long',
                        'data-original-title' => $model->getAttributeLabel('longitude'),
                        'data-content' => $model->getAttributeDescription('longitude')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'latitude', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help js-map-lat',
                        'data-original-title' => $model->getAttributeLabel('latitude'),
                        'data-content' => $model->getAttributeDescription('latitude'),                        
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class = "row" style = "margin-bottom:20px" >
        <div class="col-sm-7">
            <div class="js-map-admin" id = "js-map-admin" style = "min-height:400px">
            </div>
        </div>               
    </div>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&mode=debug" type="text/javascript"></script>
    <script src = "/js/map-admin.js" ></script>

    <div class="row js-item js-item-earth js-item-cottage js-item-commercial">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'square', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('square'),
                        'data-content' => $model->getAttributeDescription('square')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'city', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'disabled' => true,
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('city'),
                        'data-content' => $model->getAttributeDescription('city')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-cottage">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'water', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('water'),
                        'data-content' => $model->getAttributeDescription('water')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-cottage">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'basement', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('basement'),
                        'data-content' => $model->getAttributeDescription('basement')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-cottage js-item-earth js-item-commercial">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'price', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('price'),
                        'data-content' => $model->getAttributeDescription('price')
                    ]
                ]
            ]); ?>
        </div>
    </div>

<!-- 
    <div class="row js-item js-item-commercial">
        <div class="col-sm-7">                        
            <?=  $form->textFieldGroup($model, 'usefulSquare', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('usefulSquare'),
                        'data-content' => $model->getAttributeDescription('usefulSquare')
                    ]
                ]
            ]); ?>
        </div>
    </div> -->


    <div class="row js-item js-item-commercial">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'whereObject', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('whereObject'),
                        'data-content' => $model->getAttributeDescription('whereObject')
                    ]
                ]
            ]); ?>
        </div>
    </div>

<!--    <div class="row">
        <div class="col-sm-7">
            <?php /**/?>
            <?/*=  $form->dropDownListGroup($model, 'idDistrict', [
                'widgetOptions' => [
                    'data' => District::getForDropdown(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('idDistrict'),
                        'data-content' => $model->getAttributeDescription('idDistrict')
                    ]
                ]
            ]); */?>
        </div>
    </div>-->

    <div class="row js-item js-item-home">
        <div class="col-sm-7">
            <?php ?>
            <?=  $form->dropDownListGroup($model, 'idBuilder', [
                'widgetOptions' => [
                    'data' => Builder::getForDropdown(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('idBuilder'),
                        'data-content' => $model->getAttributeDescription('idBuilder')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->checkboxGroup($model, 'isPublished', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('isPublished'),
                        'data-content' => $model->getAttributeDescription('isPublished')
                    ]
                ]
            ]); ?>
        </div>
    </div>


    <div class="row js-item js-item-commercial js-item-cottage js-item-earth">
        <div class="col-sm-7">
            <?=  $form->checkboxGroup($model, 'isPromo', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('isPromo'),
                        'data-content' => $model->getAttributeDescription('isPromo')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->checkboxGroup($model, 'isShowedOnMap', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('isShowedOnMap'),
                        'data-content' => $model->getAttributeDescription('isShowedOnMap')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row js-item js-item-home">
        <div class="col-sm-7">
            <?=  $form->checkboxGroup($model, 'showOnIndex', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('showOnIndex'),
                        'data-content' => $model->getAttributeDescription('showOnIndex')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row js-item js-item-home">
        <div class="col-sm-12" <?= $model->hasErrors('shortDescription') ? 'has-error' : ''; ?>">
        <?= $form->labelEx($model, 'shortDescription'); ?>
        <?php $this->widget(
            $this->module->getVisualEditor(),
            [
                'model' => $model,
                'attribute' => 'shortDescription',
            ]
        ); ?>
        <p class="help-block"></p>
        <?= $form->error($model, 'shortDescription'); ?>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-12 <?= $model->hasErrors('longDescription') ? 'has-error' : ''; ?>">
            <?= $form->labelEx($model, 'longDescription'); ?>
            <?php $this->widget(
                $this->module->getVisualEditor(),
                [
                    'model' => $model,
                    'attribute' => 'longDescription',
                ]
            ); ?>
            <p class="help-block"></p>
            <?= $form->error($model, 'longDescription'); ?>
        </div>
    </div>

    <div class="row js-item js-item-home">
        <div class="col-sm-7">
            <?=  $form->dropDownListGroup($model, 'readyTime', [
                'widgetOptions' => [
                    'data' => Building::getReadyTimes(),
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('readyTime'),
                        'data-content' => $model->getAttributeDescription('readyTime')
                    ]
                ]
            ]); ?>
        </div>
    </div>

   <div class='row js-item js-item-home hidden'>
        <div class="col-sm-7">
            <div class="preview-image-wrapper<?= !$model->getIsNewRecord() && $model->svgBackground ? '' : ' hidden' ?>">
                <?=
                CHtml::image(
                    !$model->getIsNewRecord() && $model->svgBackground? $model->getImageUrl(200, 200, true) : '#',
                    $model->svgBackground,
                    [
                        'class' => 'preview-image img-thumbnail',
                        'style' => !$model->getIsNewRecord() && $model->svgBackground ? '' : 'display:none',
                    ]
                ); ?>
            </div>

            <?php if (!$model->getIsNewRecord() && $model->svgBackground): ?>
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
                'svgBackground',
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
            'label'      => Yii::t('RealtyModule.realty', 'Сохранить Объект и продолжить'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('RealtyModule.realty', 'Сохранить Объект и закрыть'),
        ]
    ); ?>

    <?php $this->endWidget(); ?>
</div>
<div class="tab-pane" id="apartments">
    <?php if ($model->isNewRecord):?>
        <h2>Сначала сохраните основную информацию об объекте недвижимости</h2>
    <?php else:?>
        <?php
        $this->widget(
            'yupe\widgets\CustomGridView',
            [
                'actionsButtons' => [
                    CHtml::link(
                        Yii::t('YupeModule.yupe', 'Add'),
                        $this->createUrl("/backend/realty/apartment/create?idBuilding=".$model->id),
                        ['class' => 'btn btn-success pull-right btn-sm']
                    ),
                ],
                'ajaxUpdate' => false,
                'id'           => 'apartment-grid',
                'type'         => 'striped condensed',
                'dataProvider' => $model->getApartment()->search(),
                'filter'       => $model->getApartment(),
                'columns'      => [
                    [
                        'name' => 'image',
                        'filter' => false,
                        'type' => 'raw',
                        'value' => function ($data) {
                            return CHtml::image($data->getImageUrl(40,40), $data->image, ["width" => 40, "height" => 40, "class" => "img-thumbnail"]);
                        },
                    ],
                    [
                        'name' => 'floor',
                        'value' => '$data->getFloor()',
                    ],
                    'size',
                    'cost',
                    [
                        'name' => 'rooms',
                        'value' => '$data->getRoomsAsString()',
                    ],
                    [
                        'class' => 'yupe\widgets\CustomButtonColumn',
                        "updateButtonUrl" => function($data)
                        {
                            return $this->createUrl("/backend/realty/apartment/update?id=".$data->id);
                        },
                        "deleteButtonUrl" => function($data)
                        {
                            return $this->createUrl("/backend/realty/apartment/delete?id=".$data->id);
                        },
                    ],
                ],
            ]
        ); ?>
    <?php endif; ?>
</div>
<div class="tab-pane" id="block-sections">
    <?php if ($model->isNewRecord):?>
        <h2>Сначала сохраните основную информацию об объекте недвижимости</h2>
    <?php else:?>
        <?php
        $this->widget(
            'yupe\widgets\CustomGridView',
            [
                'actionsButtons' => [
                    CHtml::link(
                        Yii::t('YupeModule.yupe', 'Add'),
                        $this->createUrl("/backend/realty/blockSection/create?idBuilding=".$model->id),
                        ['class' => 'btn btn-success pull-right btn-sm']
                    ),
                ],
                'ajaxUpdate' => false,
                'id'           => 'block-section-grid',
                'type'         => 'striped condensed',
                'dataProvider' => $model->getBlockSection()->search(),
                'filter'       => $model->getBlockSection(),
                'columns'      => [
                    'name',
                    [
                        'class' => 'yupe\widgets\CustomButtonColumn',
                        "updateButtonUrl" => function($data)
                        {
                            return $this->createUrl("/backend/realty/blockSection/update?id=".$data->id);
                        },
                        "deleteButtonUrl" => function($data)
                        {
                            return $this->createUrl("/backend/realty/blockSection/delete?id=".$data->id);
                        },
                    ],
                ],
            ]
        ); ?>
    <?php endif; ?>
</div>
<style>
    .no-captions .row-for-caption{         
            display:none !important;
        }    
</style>
<div class="tab-pane no-captions" id="images">
    <?php if ($model->isNewRecord):?>
        <h2>Сначала сохраните основную информацию об объекте недвижимости</h2>
    <?php else:?>
        <?php
        $imageModel = new RealtyImage();
        $imageModel->idTable = RealtyImage::$TABLE_BUILDING;
        $imageModel->idRecord = $model->id;
        $this->renderPartial("/realtyImageBackend/_form",[
                "model" => $imageModel               
        ]);
        ?>
    <?php endif; ?>
</div>
<div class="tab-pane no-main" id="planning ">
    <?php if ($model->isNewRecord):?>
        <h2>Сначала сохраните основную информацию об объекте недвижимости</h2>
    <?php else:?>
        <?php
        $imageModel = new RealtyImage();
        $imageModel->idTable = RealtyImage::$TABLE_BUILDING_PLANNING;
        $imageModel->idRecord = $model->id;
        $this->renderPartial("/realtyImageBackend/_form",[
                "model" => $imageModel,
                "nomain" => true
        ]);
        ?>
    <?php endif; ?>
</div>
</div>
<script>
    $(function() {
        var statusClasses = ['null-class', 'js-item-home', 'js-item-cottage', 'js-item-earth', 'js-item-commercial', 'js-item-second'];
        var $items = $('.js-item');
        $('.js-status select').change(function() {
            var val = $(this).val();
            $items.hide()
                .filter('.' + statusClasses[val])
                .show();
        }).change();
    });
</script>