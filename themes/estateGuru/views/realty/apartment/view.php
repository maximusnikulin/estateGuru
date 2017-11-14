<?php
/***
 * @var Apartment $data
 */
$images = $data->getImages();

/*$this->title = [$data->seo_title, Yii::app()->getModule('yupe')->siteName];
$this->description = $data->seo_description;
$this->keywords = $data->seo_keywords;*/

$images = $data->getImages();
if (!empty($images)) {
    $mainImage = array_shift($images);
} else {
    $mainImage = false;
};

 $isNewAppartment = $data->building->getStatusAsString() !== "Вторичная продажа";
 function filterAdress($adr) {
    return preg_replace('/<\/br>/', ",&nbsp", $adr);
 }

    $adr = filterAdress($data->building->adres);
?>


<div class="object">
    <div class="object__title">
        <h1 class="text"><?= $data->building->adres; ?></h1>
        <h2 class="caption">Квартира г. Барнаул</h2>
    </div>
    <div class="object__content">
        <div class="object__photo js-gallery-photos">
            <?php if ($mainImage !== false): ?>
                <div class="object__photo-main">
                    <figure class="photo" href="<?= $mainImage->getImageUrl(); ?>"><img src="<?= $mainImage->getImageUrl(); ?>" alt=""></figure>
                </div>
            <?php endif; ?>
            <div class="object__photo-grid ">
                <?php foreach ($images as $image): ?>
                    <figure class="photo" href="<?= $image->getImageUrl(); ?>"><img src="<?= $image->getImageUrl(170,170); ?>" alt=""></figure>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="object__desc">
            <h2 class="object__desc-title">Общая информация</h2>
            <div class="object__desc-common">
                <?php if (!empty($data->rooms)): ?>
                    <div class="row">
                        <div class="row__cell">Количество комнат</div>
                        <div class="row__cell row__cell--right"><?= $data->rooms; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->building->rayon)): ?>
                    <div class="row">
                        <div class="row__cell">Район</div>
                        <div class="row__cell row__cell--right"><?= $data->building->getRayon()->value; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->building->adres)): ?>
                    <div class="row">
                        <div class="row__cell">Адрес</div>
                        <div class="row__cell row__cell--right"><?= $adr ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->getLocationAsString())): ?>
                    <div class="row">
                        <div class="row__cell">Этаж</div>
                        <div class="row__cell row__cell--right"><?= $data->getLocationAsString(); ?></div>
                    </div>
                <?php endif; ?>  
                <?php if (!empty($data->size)): ?>
                        <div class="row">
                            <div class="row__cell">Площадь</div>
                            <div class="row__cell row__cell--right"><?= rtrim(rtrim($data->size, 0), '.'); ?> м²</div>
                        </div>
                <?php endif; ?>                          
            </div>
            <h2 class="object__desc-title">Дополнительная информация</h2>            
            <div class="object__desc-common">               
                <?php if (!empty($data->squareKitchen)): ?>
                        <div class="row">
                            <div class="row__cell">Площадь Кухни</div>
                            <div class="row__cell row__cell--right"><?= rtrim(rtrim($data->squareKitchen, 0), '.'); ?> м²</div>
                        </div>
                    <?php endif; ?>
                <?php if (!empty($data->squareLive)): ?>
                    <div class="row">
                        <div class="row__cell">Площадь жилая</div>
                        <div class="row__cell row__cell--right"><?= rtrim(rtrim($data->squareLive, 0), '.'); ?> м²</div>
                    </div>
                <?php endif; ?>
                </div>
            <div class="object__desc-on-map" data-geo = 
                "<?=$data->building->latitude . ',' . $data->building->longitude;?>">
            </div>            
            <? if ($isNewAppartment): ?>
                <a class="object__desc-to-map" href = "<?= $data->getBuildingUrl()?>">
                    <span class="text">Показать еще квартиры в доме</span>
                </a>
            <? endif; ?>
            <h2 class="object__desc-title">Описание</h2>
            <article class="object__desc-text">
                <?= $data->longDescription; ?>
            </article>
            <div class="object__desc-concl">
                <div class="price">
                    <span class="caption">Цена от</span> <span class = "value"><?= number_format($data->cost, 0, ".", " "); ?> &#8381;</span>
                    <span class = 'warning'>* - об актуальных ценах уточняйте по <span class = "inner-link js-callback">телефону</span></span>
                </div>
                <div class="callback">
                    <div class="button button--action js-callback">Узнать больше</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $images = $data->getPlannings();    
    $criteria = new CDbCriteria();
    $criteria->addInCondition('idBlockSection', [$data->idBlockSection]);
    $criteria->addInCondition('id', [$data->idFloor]);
    $location = Location::model()->findAll($criteria)[0];        
?>

<?php if (!is_null($location)): ?>
<section class = "section-switcher">   
    <div class="section-switcher__title">Положение на этаже</div>
    <div class = "section-switcher__content">
        <div class="visual ">                            
                <div class="visual__content">
                    <figure class="visual__content-image">                                    
                        <img src="<?= $location->getImageUrl(); ?>" alt=""/>
                    </figure>
                    <div class="visual__content-svgs">                                                                        
                        <svg class = "freeze">
                            <path d= "<?= $data->getSvgPath()?>"/>
                        </svg>
                    </div>                
                </div>                    
            </div>
    </div>       
</section>
<?php endif; ?>

<?php if (!empty($images)): ?>
    <section class = "section-switcher">   
        <div class="section-switcher__title">Планировки</div> 
        <div class = "section-switcher__content">   
            <div class="slider-layouts js-slider-layouts js-gallery-layouts">
                <?php foreach ($images as $image): ?>
                    <div class="slider-layouts__item" href = "<?= $image->getImageUrl(); ?>">
                        <img class = "layout"  src="<?= $image->getImageUrl(); ?>" alt="<?= $image->label; ?>">
                    </div>
                <?php endforeach; ?>           
            </div>    
        </div>    
    </section>
<?php endif; ?>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>