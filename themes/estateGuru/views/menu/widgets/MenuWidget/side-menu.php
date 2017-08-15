<?php
Yii::import('application.modules.menu.components.YMenu');

foreach ($this->params['items'] as $key => $item) {
    if (is_array($item['url'])) {
        $url = reset($item['url']);
    } else {
        $url = $item['url'];
    }

    $active = ($_SERVER['REQUEST_URI'] == $url);
    $this->params['items'][$key]['url'] = $url;
    $this->params['items'][$key]['active'] = $active;
}
?>

<div class="menu">
    <div class="menu__overlay"></div>

    <menu class = "menu__container">
        <a href = "/" class = "menu__item"><img src="/svg-icons/logo.svg" width = "120" alt=""></a>
        <?php foreach ($this->params['items'] as $item): ?>
            <?php
            $url = $item['url'];
            $active = $item['active'];
            ?>
            <a class = "menu__item" href="<?= $url ?>"><?= $item['label'] ?></a>
        <?php endforeach; ?>
    </menu>
</div>




