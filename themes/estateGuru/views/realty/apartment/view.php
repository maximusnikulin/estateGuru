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
}
//$apartments = $data->apartments;

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
                    <figure class="photo" href="<?= $mainImage->getImageUrl(1000, 1000); ?>"><img
                                src="<?= $mainImage->getImageUrl(1000, 1000); ?>" alt=""></figure>
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
                <?php if (!empty($data->rooms)): ?>
                    <div class="row">
                        <div class="row__cell">Количество комнат</div>
                        <div class="row__cell row__cell--right"><?= $data->rooms; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->building->rayon)): ?>
                    <div class="row">
                        <div class="row__cell">Район</div>
                        <div class="row__cell row__cell--right"><?= $data->building->rayon; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->building->adres)): ?>
                    <div class="row">
                        <div class="row__cell">Адрес</div>
                        <div class="row__cell row__cell--right"><?= $data->building->adres; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->floor)): ?>
                    <div class="row">
                        <div class="row__cell">Этаж</div>
                        <div class="row__cell row__cell--right"><?= $data->floor; ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data->size)): ?>
                    <div class="row">
                        <div class="row__cell">Площадь</div>
                        <div class="row__cell row__cell--right"><?= $data->size; ?></div>
                    </div>
                <?php endif; ?>
            </div>
            <h2 class="object__desc-title">Дополнительная информация</h2>
            <div class="object__desc-common">
                <?php if (!empty($data->building->rayon)): ?>
                    <div class="row">
                        <div class="row__cell">Район</div>
                        <div class="row__cell row__cell--right"><?= $data->building->rayon; ?></div>
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
                    <span class="caption">Цена от</span> <span class = "value"><?= number_format($data->cost, 0, ".", " "); ?> &#8381;</span>
                </div>
                <div class="callback">
                    <div class="button button--action">Узнать больше</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="slider-layouts js-slider-layouts js-gallery-layouts">
    <div class="slider-layouts__item" href = "./images/layout.png">
        <img class = "layout"  src="./images/layout.png" alt="">
    </div>
    <div class="slider-layouts__item" href = "./images/layout.png">
        <img class = "layout" src="./images/layout.png" alt="">
    </div>
</div>
