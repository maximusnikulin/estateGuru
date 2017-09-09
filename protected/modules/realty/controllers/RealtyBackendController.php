<?php
/**
* RealtyBackendController контроллер для realty в панели управления
*
* @author yupe team <team@yupe.ru>
* @link http://yupe.ru
* @copyright 2009-2016 amyLabs && Yupe! team
* @package yupe.modules.realty.controllers
* @since 0.1
*
*/

class RealtyBackendController extends \yupe\components\controllers\BackController
{
    public function actionGenerate($numBuildings, $numApartments)
    {
        $adresses = [
            'Солнечная поляна',
            'Ленина',
            'Комсомольский проспект',
            'Гущина',
            'Кавалерийская',
            'Юрина',
            'Северный Власихинский',
            'Власихинская',
            'Павловский тракт',
            'Попова'
        ];
        // $districts = [
        //     'Железнодорожный',
        //     'Ленинский',
        //     'Индустриальный',
        //     'Октяюрьский',
        // ]
        $minLat = 53.307366;
        $maxLat = 53.386068;
        $minLon = 83.641160;
        $maxLon = 83.754451;
                    

        
        for ($i = 0; $i < $numBuildings; $i++) {
            $model = new Building();

            $idRayons = array_keys($model->getRayons());
            $model->adres = $adresses[rand(0, count($adresses) - 1)]." ".rand(1, 100);
            $model->rayon = $idRayons[rand(0, count($idRayons) - 1)];

            $model->latitude = substr($minLat + mt_rand() / mt_getrandmax() * ($maxLat - $minLat), 0, 14);
            $model->longitude = substr($minLon + mt_rand() / mt_getrandmax() * ($maxLon - $minLon), 0 ,14);
            $model->floor = rand(6, 15);
            $model->priceForMeter = rand(8, 20) * 1000;
            $model->isPublished = 1;
            $model->isShowedOnMap = 1;
            
            $model->readyTime = rand(0, 20);
            $model->status = Building::STATUS_HOME;
            $model->shortDescription = $model->adres." очень классный дом";
            $model->save();

            for ($j = 0; $j < $numApartments; $j++) {
                $apartment = new Apartment();
                $apartment->idBuilding = $model->id;
                $apartment->isStudio = rand(0, 4) == 2 ? 1 : 0;
                $apartment->floor = rand(1, $model->floor);
                if (rand(1, 5) == 3) {
                    $apartment->maxFloor = $apartment->floor + 2;
                }                
                $apartment->size = rand(28, 60);
                $apartment->rooms = rand(1, 5);
                $apartment->cost = rand(1800, 6000) * 1000;
                $apartment->showOnIndex = true;
                $apartment->save();
            }
        }
    }

    public function actionGenerateSeoTags()
    {
        $classes = ["Apartment","Building","Builder","Disotrict"];
        foreach ($classes as $className)
        {
            $models = $className::model()->findAll();
            foreach ($models as $model)
            {
                $model->seo_title = $model->getPageTitle()[0];
                $model->seo_description = $model->getPageDescription();
                $model->seo_keywords = $model->getPageKeywords();
                if (!$model->save())
                    var_dump($model->getErrors());
            }
        }
    }

    public function actionGetRedirectList()
    {
        $classes = ["Apartment","Building","Builder","District"];
        foreach ($classes as $className)
        {
            $models = $className::model()->findAll();
            foreach ($models as $model)
            {
                echo "Redirect 301 ";
                echo $model->getOldUrl();
                echo " http://{url-dlya-avtozameny}";
                echo $model->getUrl();
                echo "<br>";
            }
        }
    }


    public function actionClearDescriptions()
    {
        $classes = ["Apartment","Building","Builder","District"];
        foreach ($classes as $className)
        {
            $models = $className::model()->findAll();
            foreach ($models as $model)
            {
                $model->shortDescription = strip_tags($model->shortDescription);
                $model->save();
            }
        }
        $classes = ["Apartment","Building","District"];
        foreach ($classes as $className)
        {
            $models = $className::model()->findAll();
            foreach ($models as $model)
            {
                $model->longDescription = strip_tags($model->longDescription);
                $model->save();
            }
        }

    }
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
	public function actionIndex()
	{
		$this->render('index');
	}
}