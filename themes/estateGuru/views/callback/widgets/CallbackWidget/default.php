<?php
/**
 * @var Callback $model
 * @var string $phoneMask
 * @var TbActiveForm $form
 */
$model->time = '12:00';
?>
<section class="section-callback">
    <div class="section-callback__overlay"></div>
    <div class="section-callback__popup">
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'action' => Yii::app()->createUrl('/callback/callback/send'),
                'htmlOptions' => [
                    'class' => 'popup popup--data',
                ]
            ]
        ); ?>
            <h2 class="popup__title">
                <span>Заказать звонок</span>
                <a class="popup__close" href="javascript:;"></a>
            </h2>
            <div class="popup__field">
                <label for="name" class="label">Имя</label>
                <label for="name" class="error">Ошибка</label>
                <?= $form->textField($model, 'name', ['id' => 'name','class' => 'input']); ?>
            </div>
            <div class="popup__field">
                <label for="phone" class="label">Телефон</label>
                <label for="phone" class="error">Ошибка</label>
                <?= $form->textField($model, 'phone', ['id' => 'phone', 'class' => 'input']); ?>
            </div>
            <?= $form->hiddenField($model, 'time'); ?>
            <div class="popup__button">
                <button type="submit" class="button button--popup ">Заказать звонок</button>
            </div>
        <?php $this->endWidget(); ?>
        <form class="popup popup--result">
            <h2 class="popup__title">
                <span></span>
                <a class="popup__close" href="javascript:"></a>
            </h2>
            <p class="popup__message">
            </p>
        </form>
    </div>
</section>