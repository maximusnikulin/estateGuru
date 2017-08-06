<?php
define("STATUS_HOME", 1);
define("STATUS_COTTAGE", 2);
define("STATUS_EARTH", 3);
define("STATUS_COMMERCIAL", 4);
define("STATUS_SECOND", 5);

/**
 * This is the model class for table "buildings".
 *
 * The followings are the available columns in table 'buildings':
 * @property integer $id
 * @property string $image
 * @property string $adres
 * @property string $slug
 * @property string $longitude
 * @property string $latitude
 * @property integer $idDistrict
 * @property integer $idBuilder
 * @property integer $isPublished
 * @property integer $isShowedOnMap
 * @property string $shortDescription
 * @property string $longDescription
 * @property integer $status
 * @property string $readyTime
 * @property string $rayon
 * @property string $floor
 * @property string $floorPos
 * @property string $priceForMeter
 * @property string $walls
 * @property string $type
 * @property string $svgBackground
 * @property string $square
 * @property string $city
 * @property string $water
 * @property string $basement
 * @property string $price
 * @property string $whereObject
 * @property bool $showOnIndex
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property Apartment[] $apartments
 */
class Building extends yupe\models\YModel
{
    const STATUS_HOME = STATUS_HOME;

    public function getPageTitle()
    {
        return [$this->adres, Yii::app()->getModule('yupe')->siteName];
    }

    public function getTitle()
    {
        return $this->adres;
    }


    public function getPageDescription()
    {
        return "На этой странице вы можете просмотреть информацию о доме, расположенном по адресу \"{$this->adres}\"";
    }

    public function getPageKeywords()
    {
        return "";
    }

    public function getCardTitle()
    {
        return $this->adres;
    }

    public function getMapInfo()
    {
        $elem = array();
        $elem["id"] = $this->id;
        $elem["latitude"] = $this->latitude;
        $elem["longitude"] = $this->longitude;
        $elem["adres"] = $this->adres;
        $elem["type"] = $this->getStatusAsString();
        $elem["url"] = $this->getUrl();
        $elem["description"] = $this->shortDescription;
        return $elem;
    }

    public static function getStatuses()
    {
        return [
            0 => "-------",
            STATUS_HOME => "Дом",
            STATUS_COTTAGE => "Коттедж",
            STATUS_EARTH => "Земельный участок",
            STATUS_COMMERCIAL => "Коммерческая недвижимость",
            STATUS_SECOND => "Вторичная продажа",
        ];
    }

    public function getStatusAsString()
    {
        return Building::getStatuses()[$this->status];
    }


    public static function getReadyTimes()
    {
        $criteria = new CDbCriteria();
        $readyTimes = ReadyTime::model()->findAll();
        $result = [];
        foreach ($readyTimes as $item) {
            $result[$item->id] = $item->text;
        }
        return $result;
    }

    public function behaviors()
    {
        return [
            'svgBackgroundUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'svgBackground',
                'uploadPath' => 'realty/buildings/svgBackground',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 700,
                    'maxHeight' => 700,
                ],
            ],
        ];
    }

    private $_apartment = null;

    public function getApartment()
    {
        if ($this->_apartment == null) {
            $this->_apartment = new Apartment();
            $this->_apartment->idBuilding = $this->id;
        }
        return $this->_apartment;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'buildings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idDistrict, idBuilder, isPublished, isShowedOnMap, status', 'numerical', 'integerOnly' => true),
            array('slug, image, adres', 'length', 'max' => 200),
            array('longitude, latitude', 'length', 'max' => 14),
            array('readyTime', 'length', 'max' => 45),
            array('shortDescription, longDescription', 'safe'),
            array('rayon, seo_title', 'length', 'max' => 100),
            array('seo_description, seo_keywords', 'length', 'max' => 300),
            array('floorPos, showOnIndex, square, city, water, basement, price, whereObject, rayon, floor, priceForMeter, walls, type, seo_title, seo_description, seo_keywords', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('floorPos, showOnIndex, square, city, water, basement, price, whereObject, rayon, floor, priceForMeter, walls, type, svgBackground, slug, id, image, adres, longitude, latitude, idDistrict, idBuilder, isPublished, isShowedOnMap, shortDescription, longDescription, status, readyTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'apartments' => array(self::HAS_MANY, 'Apartment', 'idBuilding'),
            'district' => array(self::BELONGS_TO, 'District', 'idDistrict'),
            'readyTimeObj' => array(self::BELONGS_TO, 'ReadyTime', 'readyTime'),
            'builder' => array(self::BELONGS_TO, 'Builder', 'idBuilder'),
        );
    }

    public function getImages()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("idRecord", $this->id);
        $criteria->compare("idTable", RealtyImage::$TABLE_BUILDING);
        return RealtyImage::model()->findAll($criteria);
    }

    public function getPlannings()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("idRecord", $this->id);
        $criteria->compare("idTable", RealtyImage::$TABLE_BUILDING_PLANNING);
        return RealtyImage::model()->findAll($criteria);
    }

    public function getMainImage()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("idRecord", $this->id);
        $criteria->compare("idTable", RealtyImage::$TABLE_BUILDING);
        return RealtyImage::model()->find($criteria);
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'image' => 'Изображение',
            'adres' => 'Адрес',
            'slug' => 'Адрес URL-страницы',
            'longitude' => 'Долгота',
            'latitude' => 'Широта',
            'idDistrict' => 'Квартал',
            'idBuilder' => 'Застройщик',
            'isPublished' => 'Публиковать на сайте',
            'isShowedOnMap' => 'Показывать на карте',
            'shortDescription' => 'Краткое описание',
            'longDescription' => 'Длинное описание',
            'seo_title' => 'Title страницы',
            'seo_description' => 'Description',
            'seo_keywords' => 'Keywords',
            'status' => 'Статус',
            'readyTime' => 'Время готовности',
            'floorPos' => 'Этаж',
            'showOnIndex' => 'Показывать на главной',
            'square' => 'Площадь',
            'city' => 'Город',
            'water' => 'Вода',
            'basement' => 'Канализация',
            'price' => 'Стоимость',
            'whereObject' => 'Где расположен объект',
            'rayon' => 'Район',
            'floor' => 'Количество этажей',
            'priceForMeter' => 'Минимальная цена за м2',
            'walls' => 'Стены',
            'type' => 'Тип строения',
            'svgBackground' => 'Подложка с планировками'
        );
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('adres', $this->adres, true);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('latitude', $this->latitude, true);
        $criteria->compare('idDistrict', $this->idDistrict);
        $criteria->compare('idBuilder', $this->idBuilder);
        $criteria->compare('isPublished', $this->isPublished);
        $criteria->compare('isShowedOnMap', $this->isShowedOnMap);
        $criteria->compare('shortDescription', $this->shortDescription, true);
        $criteria->compare('longDescription', $this->longDescription, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('readyTime', $this->readyTime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getUrl()
    {
        return "/dom/" . $this->slug;
    }

    public function getOldUrl()
    {
        return "/building/" . $this->slug;
    }

}
