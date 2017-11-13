<?php
/** @var Building $data */
$title = $data->adres;
// die(var_export($_GET["page"],true));
// if ($_GET["page"] > 1) {

//     $title .= ", страница " . $_GET["page"];
// }

// $this->title = [$data->seo_title, Yii::app()->getModule('yupe')->siteName];
$this->description = $data->seo_description;
$this->keywords = $data->seo_keywords;

$images = $data->getImages();
if (!empty($images)) {
    $mainImage = array_shift($images);
} else {
    $mainImage = false;
}
$apartments = $data->apartments;

//die($data->id);
$type = "building";
$blockSections = $data->getBlockSection()->search()->getData();

$ids = array_map(function($item) {
    return $item->id;
}, $blockSections);
$blocks = [];
foreach ($blockSections as $item) {
    $blocks[$item->id] = $item->name;
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
$apts = [];
$apts = array_map(function($item) {
    return array(
        'idLocation' => $item->getIdFloor(),
        'svgPath' => $item->getSvgPath(),
        'floor' => $item->getLocationAsString(),
        'rooms' => $item->getRoomsAsString(),
        'link' => $item->getUrl(),
        'price' => $item->cost,
        'size' => $item->size
    );
},$apartments);
// var_dump($blocks)
var_dump($locs)
// var_dump($apartments)
?>

<div class="object">
    <div class="object__title">
        <h1 class="text"><?= $data->adres; ?></h1>
        <h2 class="caption">Жилой дом г. <?= $data->city; ?></h2>
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
                <?php if (!empty($data->rayon)): ?>
                <div class="row">
                    <div class="row__cell">Район</div>
                    <div class="row__cell row__cell--right"><?= $data->getRayon()->value; ?></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($data->adres)): ?>
                <div class="row">
                    <div class="row__cell">Адрес</div>
                    <div class="row__cell row__cell--right"><?= $data->adres; ?></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($data->idBuilder)): ?>
                    <div class="row">
                        <div class="row__cell">Застройщик</div>
                        <div class="row__cell row__cell--right"><?= $data->builder->name; ?></div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data->walls)): ?>
                <div class="row">
                    <div class="row__cell">Стены</div>
                    <div class="row__cell row__cell--right"><?= $data->getWallsType()->value; ?></div>
                </div>
                <?php endif; ?>

                
                <?php if (!empty($data->floor)): ?>
                <div class="row">
                    <div class="row__cell">Этажей</div>
                    <div class="row__cell row__cell--right"><?= $data->floor; ?></div>
                </div>
                <?php endif; ?>



                <?php if (!empty($data->readyTime)): ?>
                <div class="row">
                    <div class="row__cell">Сдача</div>
                    <div class="row__cell row__cell--right"><?= $data->getReadyTimes()[$data->readyTime] ?></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($data->priceForMeter)): ?>
                <div class="row">
                    <div class="row__cell">Цена за м²</div>
                    <div class="row__cell row__cell--right"><?= $data->priceForMeter; ?></div>
                </div>
                <?php endif; ?>
            </div>
            <div class="object__desc-on-map" data-geo = "<?=$data->latitude . ',' . $data->longitude;?>">
            </div>
            <h2 class="object__desc-title">Описание</h2>
            <article class="object__desc-text">
                <?= $data->longDescription; ?>
            </article>
            <div class="object__desc-concl">
                <div class="price">
                    <span class="caption">Цены от</span> <span class="value"><?=number_format($data->getMinimalPrice(), 0, '', ' ');  ?>&nbsp;&#8381;</span>
                    <span class = 'warning'>* - об актуальных ценах уточняйте по <span class = "inner-link js-callback">телефону</span></span>
                </div>
                <div class="callback">
                    <div class="button button--action js-callback">Узнать больше</div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- <section class = "section-search-cards" >
    <div  id = "vue-search-cards"></div>
</section> -->

<section class="section-switcher js-visual-container">
    <h2 class="section-switcher__title">
        Планировки квартир
    </h2>
    <div class="section-switcher__tabs">
        <h2 class = "section-switcher__tabs-title">Выберите блок секцию</h2>
        <div class = "section-switcher__tabs-content">
            <ul class="js-visual-tabs">            
            </ul>        
        </div>
    </div> 
    <div class="section-switcher__content">
        <ul class="js-visual-contents">            
            
        </ul>        
    </div>      
    <div class="section-switcher__legend">
        <i class="cube"></i>
        <p class="caption">&nbsp;&nbsp;* Кликните на зеленую область для перехода к квартире</p>
    </div>
</section>

<script type = "text/javascript">
    window.settingsFilter = {
        typeEstate: "<?= $type ?>",
        cost: [
            <?=Yii::app()->realty->getMinimumAvailableCost($type); ?>,
            <?=Yii::app()->request->getParam("maximalCost", Yii::app()->realty->getMaximumAvailableCost($type)); ?>
        ],
        size: [
            <?=Yii::app()->request->getParam("minimalSize", Yii::app()->realty->getMinimumAvailableSize($type)); ?>,
            <?=Yii::app()->request->getParam("maximalSize", Yii::app()->realty->getMaximumAvailableSize($type)); ?>
        ],
        building:[
            {
                id: "<?= $data->id ?>",
                label: "<?= preg_replace('/"/', '\"', $data->adres)?>"
            }
        ],
        rayon: [
            {
                id:"",
                label:"Любой"
            }
        ]
    }
    window.visualModel = {        
        apartments: <?= json_encode($apts )  ?>,
        blocks: <?= json_encode($blocks)  ?>,
        locations: <?= json_encode($locs)  ?>
    }
</script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>