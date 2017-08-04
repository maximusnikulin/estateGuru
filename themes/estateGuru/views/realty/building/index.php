<?php
/**
 * @var Building[] $sliderItems
 */

?>
<div class="slider-promo js-slider-promo">
    <?php foreach ($sliderItems as $item): ?>
    <div class="slider-promo__item">
        <div class="slider-promo__item-content">
            <!--//TITLE BG-->
            <h1 class="title-bg">Европейский</h1>
            <!--//REVIEW-->
            <div class="poster">
                <div class="poster__content">
                    <figure class="square square--right"></figure>
                    <img class="image" src="./images/house_promo.jpg" alt="">
                    <a class="button button--action" href="#">
                        Выбрать квартиру
                    </a>
                </div>
            </div>
            <div class="review">
                <div class="review__title">
                    <h1 class="title">Европейский</h1>
                    <div class="caption">Жилой дом на Малахова 46</div>
                </div>

                <p class="review__text">Проектируемый жилой дом представляет собой многоэтажный (этажность – 25, количество этажей – 26) этажный жилой
                    многоквартирный дом со встроенными объектами общественного назначения.</p>
                <a class="review__link" href="#">Подробнее о доме</a>
            </div>
            <!--//POSTER-->
        </div>
    </div>
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
        <section class="section-cards" data-id = "1">
            <div class="section-cards__title">
                <div class="title">
                    <i class="title__icon title__icon--estate"></i>
                    <h2 class="title__text">Новостройки</h2>
                </div>
            </div>
            <ul class="section-cards__content">
                <li class="section-cards__content-item">
                    <a class="card-estate" href="#">
                        <div class="card-estate__head">
                            <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                            <div class="price">
                                <span class="price__title">Цена</span>
                                <span class="price__val">от 2 500 000 &#8381;</span>
                            </div>
                            <ul class="tags">
                                <li class="tags__item tags__item--action">Акция</li>
                                <li class="tags__item tags__item--sale">Скидка -10%</li>
                            </ul>
                        </div>
                        <div class="card-estate__name">
                            <h2 class="address">ЖК БАЛТИЙСКАЯ КРЕПОСТЬ</h2>
                            <span class="type">пр. Северный Власихинский, 104</span>
                        </div>
                        <div class="card-estate__more">
                            <div class="row">
                                <div class="row__name"></div>
                                <div class="row__val"></div>
                            </div>
                            <div class="row">
                                <div class="row__name"></div>
                                <div class="row__val"></div>
                            </div>
                            <div class="row">
                                <div class="row__name"></div>
                                <div class="row__val"></div>
                            </div>
                        </div>
                        <div class="card-estate__info">
                            <div class="cell">
                                <p class="cell__title">ЭТАЖность</p>
                                <p class="cell__val">1-12</p>
                            </div>
                            <div class="cell">
                                <p class="cell__title">площадь</p>
                                <p class="cell__val">26.5 - 56.5м²</p>
                            </div>
                            <div class="cell">
                                <p class="cell__title">Статус</p>
                                <p class="cell__val">Строится</p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="section-cards__button">
                <a href="#" class="button button--empty button--green">Перейти к поиску</a>
            </div>
        </section>
        <section class="section-cards" data-id = "2" style = "display:none;">
            <div class="section-cards__title">
                <div class="title">
                    <i class="title__icon title__icon--estate"></i>
                    <h2 class="title__text">Вторичное жилье</h2>
                </div>
            </div>
            <ul class="section-cards__content">
                <li class="section-cards__content-item">
                    <a class="card-estate" href="#">
                        <div class="card-estate__head">
                            <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                            <div class="price">
                                <span class="price__title">Цена</span>
                                <span class="price__val">5 500 000 P</span>
                            </div>
                            <ul class="tags">
                                <li class="tags__item tags__item--sale">Скидка -10%</li>
                            </ul>
                        </div>
                        <div class="card-estate__name">
                            <h2 class="address">Красноармейский 42Б</h2>
                            <span class="type">2x комнатная</span>
                        </div>
                        <div class="card-estate__info">
                            <div class="cell">
                                <p class="cell__title">ЭТАЖ</p>
                                <p class="cell__val">2</p>
                            </div>
                            <div class="cell">
                                <p class="cell__title">площадь</p>
                                <p class="cell__val">54 м²</p>
                            </div>
                            <div class="cell">
                                <p class="cell__title">Ремонт</p>
                                <p class="cell__val">С отделкой</p>
                            </div>
                        </div>
                    </a>
                </li>


            </ul>
            <div class="section-cards__button">
                <a href="#" class="button button--empty button--green">Перейти к поиску</a>
            </div>
        </section>
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
