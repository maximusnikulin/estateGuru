<?php
/**
 * @var Apartment $item
 */
$images = $item->getImages();
if (!empty($images)) {
    $mainImage = array_shift($images);
} else {
    $mainImage = false;
}
?>
<li class="section-cards__content-item">
    <a class="card-estate" href="<?= $item->getUrl(); ?>">
        <div class="card-estate__head">
            <?php if ($mainImage): ?>
            <div class="photo" style="background-image:url(<?= $mainImage->getImageUrl(1000, 1000); ?>)"></div>
            <?php endif; ?>
            <div class="price">
                <span class="price__title">Цена</span>
                <span class="price__val"><?= number_format($item->cost, 0, '', ' '); ?> P</span>
            </div>
           <!-- <ul class="tags">
                <li class="tags__item tags__item--sale">Скидка -10%</li>
            </ul>-->
        </div>
        <div class="card-estate__name">
            <h2 class="address"><?= $item->building->adres; ?></h2>
            <span class="type"><?= $item->getRoomsAsString(); ?></span>
        </div>
        <div class="card-estate__info">
            <div class="cell">
                <p class="cell__title">Этаж</p>
                <p class="cell__val"><?= $item->getFloor(); ?></p>
            </div>
            <div class="cell">
                <p class="cell__title">Площадь</p>
                <p class="cell__val"><?= $item->size; ?> м²</p>
            </div>
            <div class="cell">
                <p class="cell__title">Ремонт</p>
                <p class="cell__val">TODO::С отделкой</p>
            </div>
        </div>
    </a>
</li>
