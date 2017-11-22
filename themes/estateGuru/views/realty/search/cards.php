
<?php
Yii::import("application.modules.dictionary.models.*");
    $rayons = DictionaryData::model()->findAll("group_id = 3");
?>

<section class = "section-search-cards" >
    <div  id = "vue-search-cards"></div>
</section>

<section class="section-to-map main__link-to-map">
    <a href="/search/map/<?= $type ?>" class="link-to-map">
        <div class="link-to-map__title">
            <h2 class="name">Поиск по карте</h2>
            <p class="slogan">Уникальная возможность быстро найти квартиру в нужном районе</p>
        </div>
        <i class="link-to-map__icon"></i>
    </a>
</section>

<script type = "text/javascript">
    window.settingsFilter = {
        typeEstate: "<?= $type ?>",
        cost: [
            <?=Yii::app()->realty->getMinimumAvailableCost($type); ?>,
            <?=Yii::app()->request->getParam("maximalCost", Yii::app()->realty->getMaximumAvailableCost($type)); ?>
        ],
        size: [
            <?=Yii::app()->request->getParam("minimalSize", Yii::app()->realty->getMinimumAvailableSize($type)); ?>,
            <?=Yii::app()->request->getParam("maximalSize", Yii::app()->realty->getMaximumAvailableSize($type)); ?>
        ],        
        building: <?= json_encode(Yii::app()->realty->getHousesForCards(), JSON_UNESCAPED_UNICODE)?>,
        rayon: [
            {
                id:"",
                label:"Любой"
            },
            <?php foreach ($rayons as $rayon): ?>
            {
                id: "<?= $rayon->code; ?>",
                label: "<?= $rayon->value; ?>"
            },
            <?php endforeach; ?>
        ]
    }
</script>