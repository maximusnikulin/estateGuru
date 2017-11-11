<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="ru-RU" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/images/favicon.png" type="image/png" />
    <title><?= $this->title;?></title>
    <meta name="description" content="<?= $this->description;?>" />
    <meta name="keywords" content="<?= $this->keywords;?>" />

    <?php if ($this->canonical): ?>
        <link rel="canonical" href="<?= $this->canonical ?>" />
    <?php endif; ?>

    <?php
      Yii::app()->getClientScript()->registerCssFile('/css/style.css');
      Yii::app()->getClientScript()->registerScriptFile('/js/bundle.js', CClientScript::POS_END);
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

        <!-- MENU -->

        <div class="menu">
            <div class="menu__overlay"></div>
            <menu class = "menu__container">
                <a href = "/" class = "menu__item"><img src="/svg-icons/logo.svg" width = "120" alt=""></a>                
                <a class = "menu__item" href="/contacts">Контакты</a>
                <a class = "menu__item" href="/news">Новости</a>
                <a class = "menu__item" href="/service">Услуги</a>
                <a class = "menu__item" href="/search/cards/apartments">Квартиры в новостройках</a>
                <a class = "menu__item" href="/search/cards/second">Вторичная недвижимость</a></li>   
                <a class = "menu__item" href="/search/cards/commercial">Коммерческая недвижимость</a>
                <a class = "menu__item" href="/search/cards/earth">Земельные участки</a></li>   
                <a class = "menu__item" href="/search/cards/cotage">Коттеджи</a>
                <a class = "menu__item js-callback" href="javascript:;" class="button button--callback js-callback">Обратный звонок</a>
            </menu>
        </div>

        <!-- ENDMENU -->
       <header class="header">
      <div class="header__content">
        <div class="header__bar">
          <div class="button button--bar"></div>
        </div>
        <div class="header__logo">
          <a href="/" class="logo">
            <img src="/svg-icons/logo.svg" alt="" >
          </a>
        </div>
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
        <div class="header__callback">
          <div class="header__callback-phone">
              <?
              $phone = Yii::app()->getModule("realty")->phone2;
              ?>
              <a href = "<?= Yii::app()->getModule("realty")->getPhoneForLink($phone); ?>" class="phone"><?= $phone; ?></a>
              <a class = "phone"  href="<?= Yii::app()->getModule("realty")->getPhoneForLink(); ?>"><?= Yii::app()->getModule("realty")->phone; ?></a>
          </div>
          <div class="header__callback-button-mb">
            <a href="javascript:;" class="button button--callback-mb js-callback"></a>
          </div>
          <div class="header__callback-button">
            <a href="javascript:;" class="button button--callback js-callback">Обратный звонок</a>
          </div>
        </div>
      </div>
        <?php if (isset($this->menuWithMapLinks) && $this->menuWithMapLinks): ?>
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'kategoriiWithMap', 'layout' => 'navbar']); ?>
        <?php else: ?>
            <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'kategorii', 'layout' => 'navbar']); ?>
         <?php endif; ?>
    </header>
       <?= $content; ?>
       <?php $this->widget('application.modules.callback.widgets.CallbackWidget'); ?>
       
    <footer class="footer">
      <div class="footer__subscribe">
        <section class="section-subscribe ">
          <div class="section-subscribe__content">
            <label for="email" class="section-subscribe__title">Подписывайтесь, чтобы быть в курсе новостей, акций и спецпредложений:</label>            
            <label for="email" class="section-subscribe__message">Вы успешно подписались на рассылку акций и спецпредложений от Estate Guru.</br> Спасибо за подписку!</label>
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
      <div class="footer__content">
        <div class="footer__content-logo">        
          <a href="<?= $this->createUrl('/'); ?>" class="logo"><img width = "160px" src="/svg-icons/logo.svg" alt=""></a>
        </div>       
        <ul class="footer__content-list">
        <li class="link">
            <?
            $phone = Yii::app()->getModule("realty")->phone2;
            ?>
            <a href = "<?= Yii::app()->getModule("realty")->getPhoneForLink($phone); ?>" class="phone"><?= $phone; ?></a>
            <a href="<?= Yii::app()->getModule("realty")->getPhoneForLink(); ?>" class="phone"><?= Yii::app()->getModule("realty")->phone; ?></a>
        </li>
        <li class="link">
          <p href="" class="adress"><?= Yii::app()->getModule("realty")->adres; ?></p>
        </li>
        <li class="link"><a href="/search/cards/apartments">Поиск недвижимости</a></li>
        <li class="link"><a href="/contacts">Контакты</a></li>
        <li class="link"><a href="/news">Новости</a></li>
        <li class="link"><a href="/service">Услуги</a></li>
        <li class="link"><a href="/search/cards/apartments">Квартиры в новостройках</a></li>
        <li class="link"><a href="/search/cards/second">Вторичная недвижимость</a></li>        
        <li class="link"><a href="/search/cards/commercial">Коммерческая недвижимость</a></li>
        <li class="link"><a href="/search/cards/earth">Земельные участки</a></li>        
        <li class="link"><a href="/search/cards/cottage">Коттеджи</a></li>
        <li class="link"><a href="javascript:;" class="button button--callback js-callback">Обратный звонок</a></li>  
</ul>  
        
</div>
    </footer>
  </div>
</body>
</html>
