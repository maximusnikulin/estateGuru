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
    <li><a href="#planning" data-toggle="tab"><?= Yii::t("RealtyModule.realty", "Planning"); ?></a></li>
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


        <?
            $blockSections = $model->building->getBlockSection()->search()->getData();
            $ids = array_map(function($item) {
                return $item->id;
            }, $blockSections);
            $bs = [];
            foreach ($blockSections as $item) {
                $bs[$item->id] = $item->name;
            }
            $criteria = new CDbCriteria();
            $criteria->addInCondition('idBlockSection', $ids);
            $locations = Location::model()->findAll($criteria);
            $locs = array_map(function($item) {
                return [
                    'idBlockSection' => $item->idBlockSection, 
                    'name' => $item->name, 
                    'id' => $item->id,
                    'image' => $item->getImageUrl()
                ];
            }, $locations);
        ?>
        <!-- var_dump($locs); -->
        <div class="alert alert-info">
            <?=  Yii::t('RealtyModule.realty', 'Поля, отмеченные'); ?>
            <span class="required">*</span>
            <?=  Yii::t('RealtyModule.realty', 'обязательны.'); ?>
        </div>

        <?=  $form->errorSummary($model); ?>

        <?=  $form->hiddenField($model, 'idBuilding'); ?>

        <div class="row">
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
        <div class="row ">
            <div class="col-sm-7">
                <?=  $form->dropDownListGroup($model, 'idBlockSection', [                    
                    'widgetOptions' => [
                        'data' => $bs,
                        'htmlOptions' => [
                            'class' => 'popover-help',                            
                            'id' => 'js-bs',
                            'data-original-title' => $model->getAttributeLabel('idBlockSection'),
                            'data-content' => $model->getAttributeDescription('idBlockSection')
                        ]
                    ]
                ]); ?>
            </div>
        </div>
        <div class="row">                
        <div class="col-sm-7">
                <?=  $form->dropDownListGroup($model, 'idFloor', [                    
                    'widgetOptions' => [
                        'data' => [],
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'id' => 'js-loc',
                            'data-value' => $model->idFloor,
                            'data-locations' => json_encode($locs),
                            'data-original-title' => $model->getAttributeLabel('idFloor'),
                            'data-content' => $model->getAttributeDescription('idFloor')
                        ]
                    ]
                ]); ?>
            </div>
        </div>  
        <script>
            var bsSelect = $("#js-bs");
            var locSelect = $("#js-loc");   
            var locations = locSelect.data('locations');
            $(window).on('load', function() {            
                bsSelect.change(function(e) {                
                        console.log('asdasd')
                        var curVal = $(this).val();
                        locSelect.empty();
                        locations
                            .filter(function(el, i) {                    
                                return curVal == el.idBlockSection;
                            })
                            .forEach(function(el,i) {                                            
                                locSelect.append('<option value = "' + el.id + '" ' + (el.id == locSelect.data('value') ? 'selected' : '') + '>' + el.name + '</option>');                        
                            });
                            locSelect.change();                    
                }).change();                 
                locSelect.change(function(e) {
                    var curValue = $(this).val();
                    var imgSrc = null;
                    locations.forEach(function(el) {
                        if (curValue == el.id) {
                            imgSrc = el.image
                        }
                    });                
                    console.log(imgSrc)
                    $('.svg-maker__image img').attr('src', imgSrc);
                }).change();
            });
            
            
        </script>                   
        <div class="row hidden">
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
        <div class="row hidden">
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


        <!-- <div class="row">
            <div class="col-sm-7">
                <?=  $form->checkboxGroup($model, 'isStudio', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('isStudio'),
                            'data-content' => $model->getAttributeDescription('isStudio')
                        ]
                    ]
                ]); ?>
            </div>
        </div> -->

        <div class="row">
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
                <?=  $form->textFieldGroup($model, 'rooms', [
                    'widgetOptions' => [
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
        <div class="row hidden">
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


    <style>
            .svg-maker  {
                width:840px;
                margin:100px 10px 100px;
                border:1px solid red;
                position: relative;
            }
            .svg-maker__image img{
                max-width:100%;
            }
            .svg-maker{
                
            }
            .svg-maker__svg {
                position: absolute;
                width:100%;
                height:100%;
                top:0;
            }
            </style>             
       
            <div class="row">
                <section id = "vue-svg-maker">
                    <div class="svg-maker" ref = "svg-maker" >
                        <div class="svg-maker__image">
                            <img src="#" alt="" width="100%" ref = "image">
                        </div>
                        <div class="svg-maker__svg" v-on="{ mousemove: mouseMove, mousedown:mouseDown}"> 
                            <svg width = "100%" height = "100%" >                
                                <path v-bind:d = "pathPoints" v-bind:fill = "fill" v-bind:stroke = "constants.COLOR_LINE" stroke-width = "1"/>
                                <line v-bind:x1 = "lineNext[0][0]" v-bind:y1 = "lineNext[0][1]" v-bind:x2 = "lineNext[1][0]" v-bind:y2 = "lineNext[1][1]" stroke = "violet" stroke-width = "1"></line>            
                                <circle v-for = "point in points" v-bind:cx = "point[0]" v-bind:cy = "point[1]" v-bind:r = "constants.RADIUS_CIRCLE" v-bind:fill = "constants.COLOR_CIRCLE" ></circle>
                                 <circle  v-show = "!closePath" v-bind:cx = "pointNext[0]" v-bind:cy = "pointNext[1]" v-bind:r = "constants.RADIUS_CIRCLE" v-bind:fill = "constants.COLOR_CIRCLE" ></circle>                 
                            </svg>
                        </div>
                    </div>
                    <?=  $form->hiddenField($model, 'svgPoints', ['class' => 'js-points','v-model:value' => "result", "initValue" => "$model->svgPoints", 'ref' => "svg-input"]); ?>
                </section>    
            </div>      

            <script type = "text/javascript" src = "/js/svg-maker.js"></script>
      


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
    
    <style>
    .no-captions .row-for-caption{         
            display:none !important;
        }    
    </style>
    <div class="tab-pane no-captions" id="images">
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
    <style>
    .no-main .row-for-main{         
            display:none !important;
        }    
    </style>
    <div class="tab-pane no-main" id="planning">
        <?php if ($model->isNewRecord):?>
            <h2>Сначала сохраните основную информацию о квартире</h2>
        <?php else:?>
            <?php
            $imageModel = new RealtyImage();
            $imageModel->idTable = RealtyImage::$TABLE_APARTMENT_PLANNING;
            $imageModel->idRecord = $model->id;
            $this->renderPartial("/realtyImageBackend/_form",[
                    "model" => $imageModel                                   
            ]);
            ?>
        <?php endif; ?>
    </div>
</div>