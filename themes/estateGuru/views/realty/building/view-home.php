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

//var_dump($data->longDescription);
//die;

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
                    <figure class="photo" href="<?= $mainImage->getImageUrl(); ?>"><img src="<?= $mainImage->getImageUrl(468,480); ?>" alt=""></figure>
                </div>
            <?php endif; ?>
            <div class="object__photo-grid ">
                <?php foreach ($images as $image): ?>
                    <figure class="photo" href="<?= $image->getImageUrl(); ?>"><img src="<?= $image->getImageUrl(468,480); ?>" alt=""></figure>
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

                <?php if (!empty($data->type)): ?>
                <div class="row">
                    <div class="row__cell">Тип</div>
                    <div class="row__cell row__cell--right"><?= $data->getBuildingType()->value; ?></div>
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
                    <span class = 'warning'>* - об актуальных ценах уточняйте по телефону</span>
                </div>
                <div class="callback">
                    <div class="button button--action js-callback">Узнать больше</div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php if ($data->svgBackground): ?>
<section class="section-switcher">
    <h2 class="section-switcher__title">
        Наличие квартир
    </h2>
    <!-- <nav class="section-switcher__nav">
      <div class="slider-nav js-slider-nav">
        <div data-number="1" class="slider-nav__item active">
          <div class="button button--nav-link">Секция 1</div>
        </div>
      </div>
    </nav> -->
    <div class="section-switcher__content">
        <div class="visual js-visual active" data-number="1">
            <div class="visual__image-lr">
                <figure class="image">
                    <img src="<?= $data->getImageUrl(1000, 1000); ?>" alt="">
                </figure>
            </div>
            <div class="visual__polygons-lr">                
                        <div class="polygon">
                            <svg height="100%" width="100%" class = "polygon__svg">                               
                                    <?php foreach ($apartments as $apartment): ?>
                                        <a href = '<?= $apartment->getUrl() ?>' >
                                            <?= $apartment->getSvg(); ?>
                                            <foreignObject>
                                                <div class="polygon__toggler-mb "><span>Подробнее</span></div>    
                                                <div class="polygon__card-mb ">
                                                    <p class="row">
                                                        Этаж: <?= $apartment->getFloor()?>
                                                    </p>
                                                    <p class="row">
                                                        Комнат: <?= $apartment->rooms; ?>
                                                    </p>
                                                    <p class="row">
                                                        Площадь: <?= $apartment->size; ?> м<sup>2</sup>
                                                    </p>
                                                    <p class="row">
                                                        Цена: <?= number_format($apartment->cost, 0, '', ' '); ?> руб.
                                                    </p>
                                                    <a class = "link" href = "<?= $apartment->getUrl();?>"> Перейти </a>
                                                </div> 
                                            </foreignObject>    
                                        </a>
                                    <?php endforeach; ?>    
                            </svg>                          
                        </div>
            </div>
            <div class="visual__tooltips-lr">
                <?php foreach ($apartments as $apartment): ?>
                    <div class="tooltip hidden" data-id="<?= $apartment->id; ?>">
                        <div class="tooltip__content">
                            <p class="row">
                                Этаж: <?= $apartment->getFloor()?>
                            </p>
                            <p class="row">
                                Комнат: <?= $apartment->rooms; ?>
                            </p>
                            <p class="row">
                                Площадь: <?= $apartment->size; ?> м<sup>2</sup>
                            </p>
                            <p class="row">
                                Цена: <?= number_format($apartment->cost, 0, '', ' '); ?> руб.
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <div class="section-switcher__legend">
        <i class="cube"></i>
        <p class="caption">&nbsp;&nbsp;* Кликните на зеленую область для просмотра планировок</p>
    </div>
</section>
<?php endif; ?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>