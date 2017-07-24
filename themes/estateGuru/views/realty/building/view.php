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

Yii::app()->getModule("realty")->addCardTags($data);

$images = $data->getImages();
if (!empty($images)) {
    $mainImage = array_shift($images);
} else {
    $mainImage = false;
}
$apartments = $data->apartments;

?>

<div class="object">
    <div class="object__title">
        <h1 class="text"><?= $data->adres; ?></h1>
        <h2 class="caption">Жилой дом г. Барнаул</h2>
    </div>
    <div class="object__content">
        <div class="object__photo js-gallery-photos">
            <?php if ($mainImage !== false): ?>
                <div class="object__photo-main">
                    <figure class="photo" href="<?= $mainImage->getImageUrl(1000,1000); ?>"><img src="<?= $mainImage->getImageUrl(1000, 1000); ?>" alt=""></figure>
                </div>
            <?php endif; ?>
            <div class="object__photo-grid ">
                <?php foreach ($images as $image): ?>
                    <figure class="photo" href="<?= $image->getImageUrl(1000,1000); ?>"><img src="<?= $image->getImageUrl(1000,1000); ?>" alt=""></figure>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="object__desc">
            <h2 class="object__desc-title">Общая информация</h2>
            <div class="object__desc-common">
                <?php if (!empty($data->rayon)): ?>
                <div class="row">
                    <div class="row__cell">Район</div>
                    <div class="row__cell row__cell--right"><?= $data->rayon; ?></div>
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
                    <div class="row__cell row__cell--right"><?= $data->walls; ?></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($data->type)): ?>
                <div class="row">
                    <div class="row__cell">Тип</div>
                    <div class="row__cell row__cell--right"><?= $data->type; ?></div>
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
            <div class="object__desc-to-map">
                <span class="text">Показать на карте</span>
            </div>
            <h2 class="object__desc-title">Описание</h2>
            <p class="object__desc-text">
                <?= $data->longDescription; ?>
            </p>
            <div class="object__desc-concl">
                <div class="price">
                    <span class="caption">Цена за м²</span> <span class="value"><?= $data->priceForMeter; ?></span>
                </div>
                <div class="callback">
                    <div class="button button--action js-callback">Узнать больше</div>
                </div>
            </div>
        </div>

    </div>
</div>
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
                <?php foreach ($apartments as $apartment): ?>                    
                        <div class="polygon">
                            <?= $apartment->getSvg(); ?>
                        </div>                    
                <?php endforeach; ?>
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
                                Цена: <?= $apartment->cost; ?> руб.
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
