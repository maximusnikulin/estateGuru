<?php
/**
 * @var Building[] $sliderItems
 */
?>
<div class="slider-promo js-slider-promo">
    <?php foreach ($sliderItems as $item): ?>
        <?php $this->renderPartial('/building/slider-item', ['item' => $item]); ?>
    <?php endforeach; ?>
</div>
<section class="section-tabs main__estate js-navbar-cards">
    <div class="section-tabs__switcher">
        <div class="navbar ">
            <nav class="navbar__menu">
                <li class="link active" data-id = "1"><a href="javascript:;" >Новостройки</a></li>
                <li class="link" data-id = "2"><a href="javascript:;" >Вторичное жилье</a></li>
            </nav>
        </div>
    </div>
    <div class="section-tabs__content">
        <?= $this->renderPartial('/apartment/section-cards', ['id' => 1, 'needHide' => false, 'title' => 'Новостройки', 'items' => $apartments[STATUS_HOME]]); ?>
        <?= $this->renderPartial('/apartment/section-cards', ['id' => 2, 'needHide' => true, 'title' => 'Вторичное жилье', 'items' => $apartments[STATUS_COMMERCIAL]]); ?>
    </div>

</section>
<section class="section-to-map main__link-to-map">
    <a href="#" class="link-to-map">
        <div class="link-to-map__title">
            <h2 class="name">Поиск по карте</h2>
            <p class="slogan">Уникальная возможность быстро найти квартиру в нужном районе</p>
        </div>
        <i class="link-to-map__icon"></i>
    </a>
</section>
<section class="section-cards main__news">
    <div class="section-cards__title">
        <div class="title">
            <i class="title__icon title__icon--news"></i>
            <h2 class="title__text">Новости компании</h2>
        </div>
    </div>
    <?php $this->widget('application.modules.news.widgets.LastNewsWidget'); ?>
    <!--<div class="section-cards__button">
      <a href="#" class="button button--empty button--blue">Все новости</a>
    </div>-->
</section>
