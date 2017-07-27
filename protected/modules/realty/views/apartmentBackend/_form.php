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
 *   @var $model Apartment
 *   @var $form TbActiveForm
 *   @var $this ApartmentBackendController
 **/
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#common" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Common"); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Images"); ?></a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="common">

        <?
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm', [
                'id'                     => 'apartment-form',
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

        <?=  $form->hiddenField($model, 'idBuilding'); ?>


        <div class="row">
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
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'maxFloor', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('maxFloor'),
                            'data-content' => $model->getAttributeDescription('maxFloor')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->dropDownListGroup($model, 'rooms', [
                    'widgetOptions' => [
                        "data" => Apartment::getRoomsArray(),
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('rooms'),
                            'data-content' => $model->getAttributeDescription('rooms')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'size', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('size'),
                            'data-content' => $model->getAttributeDescription('size')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'cost', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('cost'),
                            'data-content' => $model->getAttributeDescription('cost')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7 <?= $model->hasErrors('shortDescription') ? 'has-error' : ''; ?>">
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
            <div class="col-sm-7 <?= $model->hasErrors('longDescription') ? 'has-error' : ''; ?>">
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

        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'seo_title', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('seo_title'),
                            'data-content' => $model->getAttributeDescription('seo_title')
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'seo_description', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('seo_description'),
                            'data-content' => $model->getAttributeDescription('seo_description')
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'seo_keywords', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('seo_keywords'),
                            'data-content' => $model->getAttributeDescription('seo_keywords')
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <?=  $form->textFieldGroup($model, 'number', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('number'),
                            'data-content' => $model->getAttributeDescription('number')
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="svg-background js-svg-background">
                <img src="<?= $model->building->getImageUrl(); ?>" alt="">
                <div class="point-container js-point-container">
                    <svg class="js-svg">

                    </svg>
                </div>
            </div>
            <a href="javascript:void(0)" class="js-clear-points">Очистить</a>
        </div>
        <?=  $form->hiddenField($model, 'svgPoints', ['class' => 'js-points']); ?>

        <style>
            .svg-background {
                position: relative;
            }

            .point-container {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            .point-container svg {
                width: 100%;
                height: 100%;
            }

            .point-container svg polygon{
                background: red;
            }
        </style>

        <script>
            $(function() {
                function Polygon () {
                    var pointList = [];
                    function build (arg) {
                        var res = [];
                        for (var i=0,l=arg.length;i<l;i++) {
                            res.push(arg[i].join(','));
                        }
                        return res.join(' ');
                    }
                    this.setNodePoints = function (val) {
                        this.node = ' <polygon points="' + val + '" style="fill:lime;stroke:purple;stroke-width:1" />';
                        $('.js-svg').empty().html(this.node);
                        $('.js-points').val(this.toString());
                    }
                    this.getPoint = function (i) {return pointList[i]}
                    this.setPoint = function (i,x,y) {
                        pointList[i] = [x,y];
                        this.setNodePoints(build(pointList));
                    }
                    this.points = function () {
                        for (var i=0,l=arguments.length;i<l;i+=2) {
                            pointList.push([arguments[i],arguments[i+1]]);
                        }
                        this.setNodePoints(build(pointList));
                    }
                    this.pointsFromArray = function (arr) {
                        for (var i=0,l=arr.length;i<l;i+=2) {
                            pointList.push([arr[i],arr[i+1]]);
                        }
                        this.setNodePoints(build(pointList));
                    }
                    this.clear = function() {
                        pointList = [];
                        this.setNodePoints(build(pointList));
                    }
                    this.fromString = function(str) {
                        console.log(str);
                        if (typeof str == 'undefined' || str == '') {
                            return;
                        }
                        var points = str.split(",");
                        this.pointsFromArray(points);
                    }
                    this.toString = function() {
                        var result = [];
                        pointList.forEach(function(item) {
                            result.push(item[0], item[1]);
                        });
                        return result.join(",");
                    }
                    // initialize 'points':
                    this.points.apply(this,arguments);
                }

                var value = $('.js-points').val();

                var points = new Polygon();
                window.points = points;
                points.fromString(value);

                $('.js-svg-background').click(function(e) {
                    window.points.points(e.offsetX, e.offsetY);
                });

                $('.js-clear-points').click(function() {
                    points.clear();
                })


            })
        </script>



        <?php $this->widget(
            'bootstrap.widgets.TbButton', [
                'buttonType' => 'submit',
                'htmlOptions'=> ['class' => 'btn-primary'],
                'label'      => Yii::t('RealtyModule.realty', 'Сохранить Квартиру и закрыть'),
            ]
        ); ?>

        <?php $this->widget(
            'bootstrap.widgets.TbButton', [
                'buttonType' => 'submit',
                'htmlOptions'=> ['name' => 'submit-type', 'value' => 'update'],
                'label'      => Yii::t('RealtyModule.realty', 'Сохранить Квартиру и продолжить'),
            ]
        ); ?>

        <?php $this->endWidget(); ?>
    </div>
    <div class="tab-pane" id="images">
        <?php if ($model->isNewRecord):?>
            <h2>Сначала сохраните основную информацию о квартире</h2>
        <?php else:?>
            <?php
            $imageModel = new RealtyImage();
            $imageModel->idTable = RealtyImage::$TABLE_APARTMENT;
            $imageModel->idRecord = $model->id;
            $this->renderPartial("/realtyImageBackend/_form",["model" => $imageModel]);
            ?>
        <?php endif; ?>
    </div>
</div>
