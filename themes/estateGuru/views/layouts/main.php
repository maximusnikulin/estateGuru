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
    Yii::app()->getClientScript()->registerCssFile('/public/estateGuru-FD/public/css/style.css');
    ?>
    <script type="text/javascript">
        var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
    </script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
 </head>

<body>
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
       <?= $content; ?>
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
    Yii::app()->getClientScript()->registerScriptFile('/public/estateGuru-FD/public/js/build.js');
    ?>

</body>
</html>
