<?php
$this->title = "EstateGuru - Новости";
$this->description= "EstateGuru - Новости";

$data = $dataProvider->getData();
$firstElem = array_shift($data)

?>
<section class="section-cards news__cards">
    <div class="section-cards__title">
        <div class="title">
            <h2 class="title__text">Новости </h2>
        </div>
    </div>
    <ul class="section-cards__content">
        <?= $this->renderPartial('/news/_item-large', ['data' => $firstElem]); ?>
        <?php foreach ($data as $item): ?>
            <?= $this->renderPartial('/news/_item', ['data' => $item]); ?>
        <?php endforeach; ?>
    </ul>
    <!-- <div class="section-cards__button">
        <a href="#" class="button button--empty button--blue">Все новости</a>
    </div> -->
</section>
