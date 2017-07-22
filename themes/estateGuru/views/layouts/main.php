<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
<head>
  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="ru-RU" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= $this->title;?></title>
    <meta name="description" content="<?= $this->description;?>" />
    <meta name="keywords" content="<?= $this->keywords;?>" />

    <?php if ($this->canonical): ?>
        <link rel="canonical" href="<?= $this->canonical ?>" />
    <?php endif; ?>

    <?php
    Yii::app()->getClientScript()->registerCssFile('/public/estateGuru/public/css/style.css');    
    ?>
    <script type="text/javascript">
        var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
    </script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->ß
 </head>

<body>

        <?= $content; ?>

   <div class="wrapper main">
    <header class="header">
      <div class="header__content">
        <div class="header__bar">
          <div class="button button--bar"></div>
        </div>
        <div class="header__logo">
          <a href="#" class="logo">
            <img src="/svg-icons/logo.svg" alt="" >
          </a>
        </div>
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
        <div class="header__callback">
          <div class="header__callback-phone">
            <a href="#">8 (3852) 56 34 55</a>

          </div>
          <div class="header__callback-button-mb">
            <a href="javascript:;" class="button button--callback-mb"></a>
          </div>
          <div class="header__callback-button">
            <a href="javascript:;" class="button button--callback">Обратный звонок</a>
          </div>
        </div>
      </div>
    
      <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'kategorii', 'layout' => 'navbar']); ?>
    </header>
   <div class="slider-promo js-slider-promo">
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
        <div class="slider-promo__item">
          <div class="slider-promo__item-content">
            <!--//TITLE BG-->
            <h1 class="title-bg">Комсомольский</h1>
            <!--//REVIEW-->
            <div class="poster">
              <div class="poster__content">
                <figure class="square square--right"></figure>
                <img class="image" src="./images/house_promo2.jpeg" alt="">
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
                        
          </div>
        </div>
      </div>
    <section class="section-tabs main__estate">
      <div class="section-tabs__switcher">
        <div class="navbar">
          <nav class="navbar__menu">
            <li class="link active"><a href="#">Вторичное жилье</a></li>
            <li class="link"><a href="#">Новостройки</a></li>
          </nav>
        </div>
      </div>
      <div class="section-tabs__content ">
        <section class="section-cards">
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
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
             <li class="section-cards__content-item">
              <a class="card-estate" href="#">
                <div class="card-estate__head">
                  <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                  <div class="price">
                    <span class="price__title">Цена</span>
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
             <li class="section-cards__content-item">
              <a class="card-estate" href="#">
                <div class="card-estate__head">
                  <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                  <div class="price">
                    <span class="price__title">Цена</span>
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
             <li class="section-cards__content-item">
              <a class="card-estate" href="#">
                <div class="card-estate__head">
                  <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                  <div class="price">
                    <span class="price__title">Цена</span>
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
             <li class="section-cards__content-item">
              <a class="card-estate" href="#">
                <div class="card-estate__head">
                  <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                  <div class="price">
                    <span class="price__title">Цена</span>
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
            <li class="section-cards__content-item">
              <a class="card-estate" href="#">
                <div class="card-estate__head">
                  <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
                  <div class="price">
                    <span class="price__title">Цена</span>
                    <span class="price__val">2 500 000 P</span>
                  </div>
                  <ul class="tags">
                    <li class="tags__item tags__item--action">Акция</li>
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
      <ul class="section-cards__content">
        <li class="section-cards__content-item">
          <a class="card-news" href="#">
            <div class="card-news__head">
              <div class="photo" style="background-image:url(./images/flat_1.jpg)"></div>
            </div>
            <div class="card-news__name">
              <h2 class="title">Поделитесь своей страстью со всем миром.</h2>
              <p class="preview">Делитесь своими увлечениями, опытом и уникальностьaю своего района, создавая мероприятия для путешественников.</p>
            </div>
            <div class="card-news__info">
              <div class="views">
                149
              </div>
              <div class="date">
                24 сентября 2017
              </div>
            </div>
          </a>
        </li>
      </ul>
      <div class="section-cards__button">
        <a href="#" class="button button--empty button--green">Все новости</a>
      </div>
    </section>
    <section class="section-tab main__logos">
      <div class="section-tabs__switcher">
        <div class="navbar">
          <nav class="navbar__menu">
            <li class="link active"><a href="#">Застройщики</a></li>
            <li class="link"><a href="#">Банки-партнеры</a></li>
          </nav>
        </div>
      </div>
      <div class="section-tabs__content">
        <div class="slider-logos js-slider-logos">
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
          <div class="slider-logos__item">
            <figure class="logo">
              <img src="https://upload.wikimedia.org/wikipedia/ru/d/d6/Sberbank.svg" alt="">
            </figure>
          </div>
        </div>
      </div>

    </section>
    <footer class="footer">
      <div class="footer__subscribe">
        <section class="section-subscribe ">
          <div class="section-subscribe__content">
            <label for="email" class="section-subscribe__title">Подписывайтесь, чтобы быть в курсе новостей, акций и спецпредложений:</label>
            <form class="section-subscribe__form-group">
              <input class="input" type="text" placeholder="Укажите ваш e-mail" id="email">
              <button class="button button--action" type="text">Подписаться</button>
            </form>
            <ul class="section-subscribe__social">
              <li class="vk"><a href="#"></a></li>
              <li class="ok"><a href="#"></a></li>
              <li class="igrm"><a href="#"></a></li>
            </ul>
          </div>
        </section>
      </div>
      <ul class="footer__content">
        <li class="link">
          <a href="/" class="logo"><img width = "160px" src="/svg-icons/logo.svg" alt=""></a>
          <a href="" class="phone">8 (3852) 56-34-55</a>
        </li>
        <li class="link">
          <p href="" class="adress">656049, Россия</br> Алтайский край г. Барнаул,</br> ул. Партизанская, 82 </p>
        </li>
        <li class="link"><a href="#">Поиск недвижимости</a></li>
        <li class="link"><a href="#">Контакты</a></li>
        <li class="link"><a href="#">Новости</a></li>
        <li class="link"><a href="#">Услуги</a></li>
        <li class="link"><a href="#">Новостройки</a></li>
        <li class="link"><a href="#">Вторичное жилье</a></li>
        <li class="link"><a href="#">Сдача квартир</a></li>
        <li class="link"><a href="#">Коммерческая недвижимость</a></li>
        <li class="link"><a href="#">Продажа зумли</a></li>
        <li class="link"><a>Сдача земли в аренду</a></li>
        <li class="link"><a>Продажа котеджей</a></li>
        <li class="link"><a href="javascript:;" class="button button--callback">Обратный звонок</a></li>
      </ul>
    </footer>
  </div>


<?php
    Yii::app()->getClientScript()->registerScriptFile('/public/estateGuru/public/js/build.js');    
    ?>

</body>
</html>
