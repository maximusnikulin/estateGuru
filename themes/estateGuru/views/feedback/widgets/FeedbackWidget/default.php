<?php
/**
 * @var FeedbackForm $model
 * @var TbActiveForm $form
 * @var FeedbackModule $module
 */
?>
<div class="form">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', [
        'id' => 'feedback-widget-form',
        'htmlOptions' => [
                'class' => 'popup popup--data',
        ],
        'action' => ['/feedback/contact/index'],
    ]); ?>
      <h2 class="popup__title">
            <span>Свяжитесь с нами</span>
        </h2>
        <div class="popup__field">
            <label for="name" class = "label">Имя</label>
            <label for="name" class = "error">Ошибка</label>
            <?= $form->textField($model, 'name', ['class' => 'input']); ?>
        </div>
        <div class="popup__field">
            <label for="email" class = "label">E-mail</label>
            <label for="email" class = "error">Ошибка</label>
            <?= $form->textField($model, 'email', ['class' => 'input']); ?>
        </div>
        <div class="popup__field">
            <label for="message" class = "label">Сообщение</label>
            <label for="message" class = "error">Ошибка</label>
            <?= $form->textArea($model, 'name', ['class' => 'textarea']); ?>
        </div>
        <div class="popup__button">
            <button type = "submit" class = "button button--popup">Отправить</button>
        </div>
    <?php $this->endWidget(); ?>
</div>