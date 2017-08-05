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
?>

<div class="object">
    <div class="object__title">
        <h1 class="text"><?= $data->adres; ?></h1>
        <h2 class="caption">Земельный участок  <?= $data->city; ?></h2>
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
                <?php if (!empty($data->square)): ?>
                    <div class="row">
                        <div class="row__cell">Площадь</div>
                        <div class="row__cell row__cell--right"><?= $data->square; ?> м<sup>2</sup></div>
                    </div>
                <?php endif; ?>

            </div>
            <div class="object__desc-to-map js-show-on-map">
                <span class="text">Показать на карте</span>
            </div>
            <h2 class="object__desc-title">Описание</h2>
            <p class="object__desc-text">
                <?= $data->longDescription; ?>
            </p>
            <div class="object__desc-concl">
                <div class="price">
                    <span class="caption">Цена</span> <span class="value"><?= number_format($data->price, 0, '', ' '); ?></span>
                </div>
                <div class="callback">
                    <div class="button button--action js-callback">Узнать больше</div>
                </div>
            </div>
        </div>

    </div>
</div>