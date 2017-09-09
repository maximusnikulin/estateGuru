
<?php
Yii::import("application.modules.dictionary.models.*");
    $rayons = DictionaryData::model()->findAll("group_id = 3");
?>

<section class = "section-search-map" >
        <div  id = "vue-search-map"></div>
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