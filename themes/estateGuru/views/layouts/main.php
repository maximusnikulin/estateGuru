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
   <div class="menu">
      <div class="menu__overlay"></div>
      <menu class = "menu__container">
        <a href = "#" class = "menu__item"><img src="/svg-icons/logo.svg" width = "120" alt=""></a>
        <a href = "#" class = "menu__item">Услуги</a>
        <a href = "#" class = "menu__item">Новости</a>
        <a href = "#" class = "menu__item">Контакты</a>
        <a href = "#" class = "menu__item">Новостройки</a>
        <a href = "#" class = "menu__item">Коммерческая недвижимость</a>
        <a href = "#" class = "menu__item">Вторичное жилье</a>
        <a href = "#" class = "menu__item">Коттеджи</a>
        <a href = "#" class = "menu__item">Земля</a>
      </menu>
    </div>
    <header class="header">
      <div class="header__content">
        <div class="header__bar">
          <div class="button button--bar"></div>
        </div>
        <div class="header__logo">
          <a href="<?= $this->createUrl('/'); ?>" class="logo">
            <img src="/svg-icons/logo.svg" alt="" >
          </a>
        </div>
        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
        <div class="header__callback">
          <div class="header__callback-phone">
            <a href="<?= Yii::app()->getModule("realty")->getPhoneForLink(); ?>"><?= Yii::app()->getModule("realty")->phone; ?></a>
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
       <?php $this->widget('application.modules.callback.widgets.CallbackWidget'); ?>
       
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
          <a href="<?= $this->createUrl('/'); ?>" class="logo"><img width = "160px" src="/svg-icons/logo.svg" alt=""></a>
          <a href="<?= Yii::app()->getModule("realty")->getPhoneForLink(); ?>" class="phone"><?= Yii::app()->getModule("realty")->phone; ?></a>
        </li>
        <li class="link">
          <p href="" class="adress"><?= Yii::app()->getModule("realty")->adres; ?></p>
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
</body>
</html>
