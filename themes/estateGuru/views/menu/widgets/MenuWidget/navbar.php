  <?php
Yii::import('application.modules.menu.components.YMenu');
?>

    <div class="header__navbar">
    <div class="navbar">
        <nav class="navbar__menu">
        <?php foreach ($this->params['items'] as $item): ?>
        <?php 
            if (is_array($item['url'])) {
                $url = reset($item['url']);
            } else {
                $url = $item['url'];
            }
        ?>
        <li class="link"><a href="<?= $url ?>"><?= $item['label'] ?></a></li>
        <?php endforeach; ?>
        </nav>
    </div>
    </div>
