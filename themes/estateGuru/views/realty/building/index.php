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
        <?= $this->renderPartial('/apartment/section-cards', ['id' => 2, 'needHide' => true, 'title' => 'Вторичное жилье', 'items' => $apartments[STATUS_SECOND]]); ?>
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
    <div class="section-cards__button">
      <a href="/news" class="button button--empty button--blue">Все новости</a>
    </div>
</section>
<section class="section-tab main__logos">
    <div class="section-tabs__switcher">
        <div class="navbar">
            <nav class="navbar__menu">
                <li class="link active" data-id="1"><a href="javascript:;" >Банки-партнеры</a></li>
                <li class="link" data-id="2"><a href="javascript:;" >Застройщики</a></li>
            </nav>
        </div>
    </div>
    <?php
        $bankLogos = Image::model()->findAll('category_id = '.Image::CATEGORY_BANK_LOGOS);
        $builders = Builder::model()->findAll();
    ?>
    <div class="section-tabs__content">

        <?php if (count($bankLogos) >= 4): ?>
        <div class="slider-logos js-slider-logos" data-id = "1">
            <?php foreach ($bankLogos as $item): ?>
                <div class="slider-logos__item">
                    <figure class="logo">
                        <img src="<?= $item->getImageUrl(); ?>" alt="<?= $item->alt; ?>">
                    </figure>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (count($builders) >= 4): ?>
            <div class="slider-logos js-slider-logos" data-id = "2" style = "display:none">
                <?php foreach ($builders as $item): ?>
                    <div class="slider-logos__item">
                        <figure class="logo">
                            <img src="<?= $item->getImageUrl(); ?>" alt="<?= $item->name; ?>">
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
