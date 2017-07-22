<?php
Yii::import('application.modules.menu.components.YMenu');
?>

<nav class="header__menu">
<?php foreach ($this->params['items'] as $item): ?>
    <?php 
        if (is_array($item['url'])) {
            $url = reset($item['url']);
        } else {
            $url = $item['url'];
        }
    ?>
    <li class="header__menu-item"><a href="<?= $url ?>"><?= $item['label'] ?></a></li>
<?php endforeach; ?>
</nav>



