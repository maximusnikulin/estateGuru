<?php
/**
 * @var int $id
 * @var bool $needHide
 * @var string $title
 * @var Apartment[] $i
 */
if (is_null($items)) {
    $items = [];
}
?>
<section class="section-cards" data-id = "<?= $id; ?>" <?= $needHide ? 'style = "display:none;"' : ''; ?>>
    <div class="section-cards__title">
        <div class="title">
            <i class="title__icon title__icon--estate"></i>
            <h2 class="title__text"><?= $title; ?></h2>
        </div>
    </div>
    <ul class="section-cards__content">
        <?php foreach ($items as $item): ?>
            <?php $this->renderPartial('/apartment/card', ['item' => $item]); ?>
        <?php endforeach; ?>
    </ul>
    <div class="section-cards__button">
        <?php if ($type == "second"): ?>
        <a href="/search/cards/second" class="button button--empty button--green">Перейти к поиску</a>
        <?php elseif($type == 'apartments'): ?>
            <a href="/search/cards/apartments" class="button button--empty button--green">Перейти к поиску</a>
        <?php endif; ?>
        
    </div>
</section>
