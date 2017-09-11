<?php
/**
 * @var Building $item
 */

?>
<div class="slider-promo__item">
    <div class="slider-promo__item-content">
        <!--//TITLE BG-->
        <h1 class="title-bg"><?= $item->adres;?></h1>
        <!--//REVIEW-->
        <div class="poster">
            <div class="poster__content">
                <figure class="square square--right"></figure>                
                <img class="image" src="<?= !is_null($item->getMainImage()) ? $item->getMainImage()->getImageUrl(320,480) : '/images/plug.png'; ?>" alt="">
                <a class="button button--action" href="<?= $item->getUrl()?>">
                    Выбрать квартиру
                </a>
            </div>
        </div>
        <div class="review">
            <div class="review__title">
                <h1 class="title"><?= $item->adres;?></h1>
                <div class="caption">Жилой дом</div>
            </div>
            <article class="review__text"><?= $item->shortDescription; ?></article>
            <a class="review__link" href="<?= $item->getUrl()?>">Подробнее о доме</a>
        </div>
        <!--//POSTER-->
    </div>
</div>
