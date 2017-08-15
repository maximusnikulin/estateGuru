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

<nav class="header__menu">

<?php foreach ($this->params['items'] as $item): ?>
    <?php
        $url = $item['url'];
        $active = $item['active'];
    ?>
    <li class="header__menu-item <?= $active ? 'active' : ''; ?>"><a href="<?= $url ?>"><?= $item['label'] ?></a></li>
<?php endforeach; ?>
</nav>



