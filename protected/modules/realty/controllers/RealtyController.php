<?php
/**
 * RealtyController контроллер для realty на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2016 amyLabs && Yupe! team
 * @package yupe.modules.realty.controllers
 * @since 0.1
 *
 */

class RealtyController extends \yupe\components\controllers\FrontController
{
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $building = new Building();
    }

    protected $menuWithMapLinks = false;

    public function actionServices() {
        $this->title = 'EstateGuru - Услуги';
        $this->render('/building/services');
    }

    public function actionContacts() {
        $this->title = 'EstateGuru - Контакты';
        $this->description = 'Контакты';

        $this->render('/building/contacts');
    }
    public function actionSearchMap($type) {
        $this->title = 'EstateGuru - Поиск недвижимости на карте';
        $this->description = 'Поиск недвижимости на карте';

        $this->menuWithMapLinks = true;
        $this->render('/search/map', ['type' => $type]);
    }
    public function actionSearchCards($type) {                
        $this->title = 'EstateGuru - Поиск недвижимости ';
        $this->description = 'Поиск недвижимости';

        $this->render('/search/cards', ['type' => $type]);
    }
    /**
     * Действие "по умолчанию"
     *
     * @return void
     */
    public function actionIndex()
    {
        Yii::import('news.models.*');
        $criteria = new CDbCriteria();
        $criteria->select = 't.*';
        $criteria->compare("showOnIndex",1);
        $criteria->compare("status", Building::STATUS_HOME);
        $criteria->compare("isPublished", 1);
        $criteria->order = "adres ASC";
        $sliderItems = Building::model()->findAll($criteria);

        $criteria = new CDbCriteria();
        $criteria->select = 't.*';
        $criteria->order = "adres ASC";
        $criteria->compare("t.showOnIndex", true);
        $criteria->limit = 8;
        $criteria->with = [
            'building' => [
                'condition' => 'isPublished=1',
            ]
        ];
        $apartments = Apartment::model()->findAll($criteria);
        $apartmentsByStatuses = [STATUS_HOME=>[],STATUS_COMMERCIAL=>[]];
        foreach ($apartments as $item) {
           if (isset($apartmentsByStatuses[$item->building->status])) {
                $apartmentsByStatuses[$item->building->status][] = $item;
            } else {
                $apartmentsByStatuses[$item->building->status] = [$item];
            }
        }

        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params' => [
                ':status' => News::STATUS_PUBLISHED,
            ],
            'order' => 't.date DESC',
        ]);

        $news = News::model()->findAll($dbCriteria);
        $this->title = 'EstateGuru - Поиск и Продажа недвижимости';
        $this->description = 'EstateGuru - Поиск и Продажа недвижимости';
        $this->render("/building/index",['sliderItems' => $sliderItems, 'news' => $news, 'apartments' => $apartmentsByStatuses]);
    }

    public function actionGetApartmentsForMap()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 't.*';
        $criteria->addCondition("id <> 0");
        $criteria->compare("isPublished", 1);

        if (Yii::app()->request->getParam("rayon") != null) {
            $criteria->compare("rayon", Yii::app()->request->getParam("rayon"));
        }
        if (Yii::app()->request->getParam("type") != null) {
            $criteria->compare("status", Yii::app()->request->getParam("type"));
        }
        if (!is_null(Yii::app()->request->getParam('building'))) {
            $criteria->compare("id", Yii::app()->request->getParam('building'));
        }

        $buildings = Building::model()->findAll($criteria);
        $ids = array_map(function($item) {
            return $item->id;
        }, $buildings);

        $criteria = new CDbCriteria();
        $criteria->addInCondition("idBuilding", $ids);

        // var_dump(Yii::app()->request->getParam("cost")[0]);
        if (Yii::app()->request->getParam("rooms") != null) {
            $rooms = Yii::app()->request->getParam("rooms");
            if (array_search("4",$rooms) !== false) {
                $rooms[] = "5";
                $rooms[] = "6";
            }
            $criteria->addInCondition("rooms", $rooms);
        }
        if (Yii::app()->request->getParam("cost") != null) {
            $criteria->addCondition("cost >= ".Yii::app()->request->getParam("cost")[0]);
            $criteria->addCondition("cost <= ".Yii::app()->request->getParam("cost")[1]);
        }
        if (Yii::app()->request->getParam("size") != null) {
            $criteria->addCondition("size >= ".Yii::app()->request->getParam("size")[0]);
            $criteria->addCondition("size <= ".Yii::app()->request->getParam("size")[1]);
        }
        if (!is_null(Yii::app()->request->getParam('offset'))) {
            $criteria->offset = Yii::app()->request->getParam('offset');
        }
        if (!is_null(Yii::app()->request->getParam('limit'))) {
            $criteria->limit = Yii::app()->request->getParam('limit');
        }
        $sortParam = Yii::app()->request->getParam('sort', 'cost');
        $sortDir = Yii::app()->request->getParam('sortDir', 'asc');
        $criteria->order = $sortParam." ".strtoupper($sortDir);

        $apartments = Apartment::model()->findAll($criteria);

        $result = array_map(function ($item) {
            $images = $item->getImages();
            
            $result = [
                'id' => $item->id,
                'adres' => $item->building->adres,
                'idBuilding' => $item->idBuilding,
                'latitude' => $item->building->latitude,
                'longitude' => $item->building->longitude,
                'url' => $item->getUrl(),
                'cost' => $item->cost,
                'floor' => $item->getLocationAsString(),
                'type' => $item->getStudioAsString(),                
                'rayon' => $item->building->getRayon()->value,
                'image' => empty($images) ? '/images/plug.png' : reset($images)->getImageUrl(402, 200),
                'rooms' => $item->rooms,
                'size' => $item->size,
                'isPromo' => $item->getIsPromo(),
                'walls' => $item->building->getWallsType()->value
             ];
            if ($item->building->status == Building::STATUS_HOME) {
                $result['deadline'] = is_null($item->building->readyTimeObj) ? "Дом сдан" : $item->building->readyTimeObj->text;
            }
            return $result;
        }, $apartments);
        
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

    public function actionGetBuildingsForMap($type)
    {
        $criteria = new CDbCriteria();
        $criteria->compare("isShowedOnMap",1);
        $criteria->compare("isPublished", 1);

        if (!is_null(Yii::app()->request->getParam("rayon"))) {
            $criteria->compare("rayon", Yii::app()->request->getParam("rayon"));
        }
        if (!is_null(Yii::app()->request->getParam("type"))) {
            $criteria->compare("status", Yii::app()->request->getParam("type"));
        }
        if (!is_null(Yii::app()->request->getParam('building'))) {
            $criteria->compare("id", Yii::app()->request->getParam('building'));
        }
        if (!is_null(Yii::app()->request->getParam('offset'))) {
            $criteria->offset = Yii::app()->request->getParam('offset');
        }
        if (!is_null(Yii::app()->request->getParam('limit'))) {
            $criteria->limit = Yii::app()->request->getParam('limit');
        }        
        if (Yii::app()->request->getParam("cost") != null) {
            $criteria->addCondition("price >= ".Yii::app()->request->getParam("cost")[0]);
            $criteria->addCondition("price <= ".Yii::app()->request->getParam("cost")[1]);
        }
        if (Yii::app()->request->getParam("size") != null) {
            $squareFieldName = 'square';
            $criteria->addInCondition($squareFieldName, Yii::app()->request->getParam("size"));
        }
        $sortParam = Yii::app()->request->getParam('sort', 'cost');
        $sortParam = str_replace(['cost', 'size'], ['price', 'square'], $sortParam);
        $sortDir = Yii::app()->request->getParam('sortDir', 'asc');
        $criteria->order = $sortParam." ".strtoupper($sortDir);

        $buildings = Building::model()->findAll($criteria);
        $result = array_map(function ($item) {
            $image = $item->getMainImage();            
            $status= $item->status;            
            $result = [
                'id' => $item->id,
                'adres' => $item->adres,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'url' => $item->getUrl(),
                'image' => is_null($image) ? '/images/plug.png' : $image->getImageUrl(200, 200),
                'type' => $item->getStatusAsString(),
                'cost' => $item->getPriceAsString(),
                'rayon' => $item->getRayon()->value,
            ];
            //COTTAGE
            
            if ($status == 2) {
                // var_dump($item);
                $result["square"] = $item->square;
                $result["floor"] = $item->floor;
            }
            //EARTH
            if ($status == 3) {
               $result["squareGa"] = $item->square;
            }
            //COMMERCIAL
            if ($status == 4) {
                // var_dump($item);               
               $result["square"] = $item->square;
               $result["floor"] = $item->floorPos;
            }
            return $result;

        }, $buildings);
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }

    public function actionViewBuilding($name)
    {
        $model = Building::model()->find("slug = :slug",[":slug" => $name]);        
        if ($model == null || !$model->isPublished || $model->status == Building::STATUS_SECOND) {
            throw new CHttpException(404, 'К сожалению, данные об этом доме были удалены с сайта. Но у нас есть много других отличных предложений');
        }
        $seoTemplate = Yii::app()->getModule('realty')->getSeoTemplateForBuilding($model);        
        $this->title = $model->getTitle($seoTemplate);
        $this->description = strip_tags($model->longDescription);
        $this->render("/building/view",["data" => $model]);
    }

    public function actionViewDistrict($name)
    {
        $model = District::model()->find("slug = :slug",[":slug" => $name]);
        if ($model == null)
            throw new CHttpException(404, 'К сожалению, данные об этом квартале были удалены с сайта. Но у нас есть много других отличных предложений');
        $this->render("/district/view",["data" => $model]);
    }

    public function actionViewBuilder($name)
    {
        $model = Builder::model()->find("slug = :slug",[":slug" => $name]);
        if ($model == null)
            throw new CHttpException(404, 'К сожалению, данные об этом застройщике были удалены с сайта. Но у нас есть много других отличных предложений');
        $this->render("/builder/view",["data" => $model]);
    }

    public function actionViewApartment($id)
    {
        $model = Apartment::model()->findByPk($id);
        if ($model == null || $model->building == null || !$model->building->isPublished)
            throw new CHttpException(404, 'К сожалению, данные об этой квартире были удалены с сайта. Но у нас есть много других отличных предложений');
        $seoTemplate = Yii::app()->getModule('realty')->seoTemplateForApartment;
        $this->title = $model->getTitle($seoTemplate);
        $this->description = strip_tags($model->longDescription);
        $this->render("/apartment/view",["data" => $model]);
    }

    public function actionListBuilders()
    {
        $criteria = new CDbCriteria();
        $data = new CActiveDataProvider(
            'Builder',
            [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => (int)Yii::app()->getModule('realty')->itemsPerPage,
                    'pageVar' => 'page',
                ],
            ]
        );

        $page = RealtyPage::model()->find("type = ".REALTY_PAGE_BUILDERS);
        $this->title = [$page->seo_title];
        if (Yii::app()->getModule('yupe')->siteName != "")
            $this->title[] = Yii::app()->getModule('yupe')->siteName;
        $this->description = $page->seo_description;
        $this->keywords = $page->seo_keywords;
        $this->render("/builder/list",["dataProvider" => $data, "page" => $page]);
    }

    public function actionListDistricts()
    {
        $criteria = new CDbCriteria();
        $data = new CActiveDataProvider(
            'District',
            [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => (int)Yii::app()->getModule('realty')->itemsPerPage,
                    'pageVar' => 'page',
                ],
            ]
        );
        $page = RealtyPage::model()->find("type = ".REALTY_PAGE_DISTRICTS);
        $this->title = [$page->seo_title];
        if (Yii::app()->getModule('yupe')->siteName != "")
            $this->title[] = Yii::app()->getModule('yupe')->siteName;
        $this->description = $page->seo_description;
        $this->keywords = $page->seo_keywords;
        $this->render("/district/list",["dataProvider" => $data, "page" => $page]);
    }

    
}