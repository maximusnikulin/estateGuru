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
                <div class="photo" style="background-image:url(<?= $mainImage->getImageUrl(); ?>)"></div>
            <?php else: ?>
                <div class="photo" style="background-image:url(/images/plug.png)"></div>
            <?php endif; ?>
            <div class="price">
                <span class="price__title">Цена</span>
                <span class="price__val"><?= number_format($item->cost, 0, '', ' '); ?> &nbsp;&#8381;</span>
            </div>
            <? if ($item->getIsPromo()): ?>
                <ul class="tags">
                    <li class="tags__item tags__item--sale">Скидка</li>
                </ul>
            <? endif;?>
           
        </div>
        <div class="card-estate__name">
            <h2 class="address"><?= $item->building->adres; ?></h2>
<!--            <span class="type">--><?//= $item->getRoomsAsString(); ?><!--</span>-->
        </div>
        <div class="card-estate__more">
            <!-- <div class="row">
                <div class="row__name">Тип</div>
                <div class="row__val"><?= $item->getStudioAsString(); ?></div>
            </div> -->
            <?php if (!is_null($item->building->getRayon())):?>
                <div class="row">
                    <div class="row__name">Район</div>
                    <div class="row__val"><?= $item->building->getRayon()->value; ?></div>
                </div>
            <?php endif;?>
            <?php if ($item->building->idBuilder):?>
                <div class="row">
                    <div class="row__name">Застройщик</div>
                    <div class="row__val"><?= $item->building->builder->name; ?></div>
                </div>
            <?php endif;?>
            <!-- <?php if ($item->building->status != Building::STATUS_SECOND) :?> -->
                <div class="row">
                    <div class="row__name">Срок сдачи</div>
                    <div class="row__val"><?= $item->building->readyTimeObj->text; ?></div>
                </div>
            <!-- <?php endif;?> -->
        </div>
        <div class="card-estate__info">
            <div class="cell">
                <p class="cell__title">Этаж</p>
                <p class="cell__val"><?= $item->getLocationAsString(); ?></p>
            </div>
            <div class="cell">
                <p class="cell__title">Площадь</p>
                <p class="cell__val"><?= rtrim(rtrim($item->size, 0), "."); ?> м²</p>
            </div>
            <div class="cell">
                <p class="cell__title">Комнат</p>
                <p class="cell__val"><?= $item->rooms; ?></p>
            </div>
        </div>
    </a>
</li>
