<?php Yii::import('application.modules.news.NewsModule'); ?>
<ul class="section-cards__content">
    <?php if (isset($models) && $models != []): ?>
        <?php foreach ($models as $model): ?>
            <?= $this->render('_item', ['data' => $model]); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
