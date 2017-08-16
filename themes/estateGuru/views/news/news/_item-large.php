<?php
/* @var News $data */
?>
<li class="section-cards__content-item section-cards__content-item--2x">
    <a class="card-news card-news--full" href="<?= CHtml::normalizeUrl(['/news/news/view/', 'slug' => $data->slug]); ?>">
        <div class="card-news__head">
            <div class="photo" style="background-image:url(<?= $data->getImageUrl(); ?>)"></div>
        </div>
        <div class="card-news__name">
            <h2 class="title"><?= $data->title?></h2>
            <article class="preview"><?= $data->short_text?></article>
        </div>
        <div class="card-news__info">
            <!--            <div class="views"></div>-->
            <div class="date">
                <?= $data->getFormattedDate(); ?>
            </div>
        </div>
    </a>
</li>