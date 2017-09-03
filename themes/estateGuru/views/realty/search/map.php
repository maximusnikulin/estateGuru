
<?php
Yii::import("application.modules.dictionary.models.*");
    $rayons = DictionaryData::model()->findAll("group_id = 3");
?>

<section class = "section-search-map" >
        <div class = "section-search-map__title">
            <h1 class="text">Поиск Квартир</h1>
        </div>
        <div  id = "vue-search-map"></div>
</section>
<script type = "text/javascript">
    window.settingsFilterMap = {
        cost: [
            0,
            <?=Yii::app()->request->getParam("maximalCost", Yii::app()->realty->getMaximumAvailableCost()); ?>            
        ],
        size: [
            <?=Yii::app()->request->getParam("minimalSize", Yii::app()->realty->getMinimumAvailableSize()); ?>,
            <?=Yii::app()->request->getParam("maximalSize", Yii::app()->realty->getMaximumAvailableSize()); ?>
        ],
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
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&mode=debug" type="text/javascript"></script>