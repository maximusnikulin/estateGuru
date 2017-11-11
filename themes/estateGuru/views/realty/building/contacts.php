<div class="visit">
    <h1 class="visit__title">
        Контакты
    </h1>
    <div class="visit__info">
        <ul class="shedule">
            <li class = "shedule__item ">
                <h2 class="title">Адрес</h2>
                <p class="text"><?= Yii::app()->getModule("realty")->adres; ?></p>
            </li>
            <li class = "shedule__item ">
                <h2 class="title">Телефон</h2>
                <?
                    $phone = Yii::app()->getModule("realty")->phone;
                ?>
                <a href = "<?= Yii::app()->getModule("realty")->getPhoneForLink($phone); ?>" class="link"><?= $phone; ?></a>

                <?
                $phone = Yii::app()->getModule("realty")->phone2;
                ?>
                <a href = "<?= Yii::app()->getModule("realty")->getPhoneForLink($phone); ?>" class="link"><?= $phone; ?></a>
            </li>
            <li class = "shedule__item ">
                <h2 class="title">E-mail</h2>
                <a class="link" href = "email:estate-guru@mail.ru">estate-guru@mail.ru</a>                

            </li>
            <li class = "shedule__item ">
                <h2 class="title">Время работы</h2>
                <p class="text">пн-пт: с 09:00 до 18:00</p>
                <p class="text">сб-вс: Выходной</p>
            </li>
        </ul>

        <?php $this->widget('application.modules.feedback.widgets.FeedbackWidget'); ?>
    </div>

    <div class="visit__map " id = "map-contacts">
    </div>
</div>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>