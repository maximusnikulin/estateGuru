<?php

/**
 * This is the model class for table "apartments".
 *
 * The followings are the available columns in table 'apartments':
 * @property integer $id
 * @property integer $idBuilding
 * @property integer $floor
 * @property integer $maxFloor
 * @property integer $rooms
 * @property integer $idBlockSection
 * @property integer $idFloor
 * @property integer $size
 * @property integer $cost
 * @property string $image
 * @property string $svgPoints
 * @property string $shortDescription
 * @property string $longDescription
 * @property string $number
 * @property bool   $showOnIndex
 * @property bool   $isStudio
 * @property bool   $isPromo

 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords

 * @property Building $building

 */
class Apartment extends yupe\models\YModel
{
    use TraitSeoTitle;

    public function getIsPromo()
    {
        return $this->isPromo;
    }
    public function getPropertiesForSeoTemplater()
    {
        $properties = [];
        $properties['rooms'] = $this->getRoomsAsString();
        $properties['studio'] = $this->isStudio ? 'квартира-студия' : 'квартира';
        $properties['floor'] = $this->getFloorAsString();
        $properties['adres'] = $this->building->adres;
        return $properties;
    }

    public function getPageDescription()
    {
        return "На этой странице вы можете просмотреть информацию о квартире в доме, расположенной по адресу \"{$this->building->adres}\" на {$this->floor} этаже, стоимость составляет {$this->cost}";
    }

    public function getPageKeywords()
    {
        return "";
    }

    static public function getRoomsArray()
    {
        return [
            -1 => "------",
            "Студия",
            "Однокомнатная",
            "Двухкомнатная",
            "Трехкомнатная",
            "Четырехкомнатная",
            "Пятикомнтаная",
            "Шестикомнатная",
        ];
    }

    public function getLocationAsString() {
        $location = Location::model()->findByPk($this->idFloor);        
        if (is_null($location)) {
            return '';
        }
        $parts = explode("-", $location->name);
        if ($parts[0] == $parts[1]) {
            return $parts[0];
        }
        return $location->name;
    }
    public function getIdFloor() {
        return $this->idFloor;
    }
    public function getPriceAsString()
    {
        return number_format($this->cost,0,","," ").'<span class="rubl"> руб.</span>';
    }
    

    public function behaviors()
    {
        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'uploadPath' => 'realty/apartments/',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 700,
                    'maxHeight' => 700,
                ],
            ],
        ];
    }

    public function getRoomsAsString()
    {
        return Apartment::getRoomsArray()[$this->rooms];
    }

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'apartments';
	}
    public function getSvgPath() {
        return $this->svgPoints;
    }
    public function getSvg()
    {

        return '
                <svg height="100%" width="100%" class = "polygon-svg">
                    <a href =' . $this->getUrl() . '>
                        <path d="' . $this->svgPoints . '" data-id = "' . $this->id . '"></path>
                    </a>
                </svg>';
                  

	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idBlockSection, idFloor, idBuilding, maxFloor, floor, rooms, cost', 'numerical', 'integerOnly'=>true),
            array('image', 'length', 'max'=>200),
            array('seo_title', 'length', 'max'=>100),
            array('seo_description, seo_keywords', 'length', 'max'=>300),
            array('size, isStudio, seo_title, seo_description, seo_keywords','safe'),
            array('isPromo, showOnIndex, svgPoints, shortDescription, longDescription', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idBlockSection, idFloor, isPromo, isStudio, showOnIndex, svgPoints, image, maxFloor, id, idBuilding, floor, rooms, size, cost, shortDescription, longDescription', 'safe', 'on'=>'search'),
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
            'building'=>array(self::BELONGS_TO, 'Building', 'idBuilding'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'idBuilding' => 'Строение',
            'idBlockSection' => 'Блок-секция',
            'idFloor' => 'Местоположение',
            'floor' => 'Этаж',
            'maxFloor' => 'Конечный этаж',
            'rooms' => 'Количество комнат',
            'size' => 'Площадь',
            'cost' => 'Стоимость',
            'shortDescription' => 'Короткое описание',
            'longDescription' => 'Длинное описание',
            'image' => 'Изображение',
            'showOnIndex' => 'Показывать на главной',

            'seo_title' => 'Title страницы',
            'seo_description' => 'Description',
            'seo_keywords' => 'Keywords',
            'isStudio' => 'Является студией',
            'isPromo' => 'Акция',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idBuilding',$this->idBuilding);
		$criteria->compare('floor',$this->floor);
		$criteria->compare('rooms',$this->rooms);
		$criteria->compare('size',$this->size);
        $criteria->compare('cost',$this->cost);
        // $criteria->compare('long',$this->long);
        // $criteria->compare('latitude',$this->latitude);
		$criteria->compare('shortDescription',$this->shortDescription,true);
        $criteria->compare('longDescription',$this->longDescription,true);
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Apartment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getUrl()
    {
        return Yii::app()->controller->createUrl("/dom/".$this->building->slug."/".$this->id);
    }

    public function getOldUrl()
    {
        return "/building/".$this->building->slug."/".$this->id;
    }
    public function getBuildingUrl(){
        return "/dom/".$this->building->slug;
    }
    public function getStudioAsString() {
	    return ($this->isStudio) ? 'Студия' : 'Стандартная';

    }

    public function getFloor()
    {
        if ($this->maxFloor > 0)
            return $this->floor."-".$this->maxFloor;
        else
            return $this->floor;
    }
    public function getIdBlockSection() {
        return $this->idBlockSection;
    }
    public function getFloorAsString()
    {
        if ($this->maxFloor > 0)
            return $this->getFloor()." этажах";
        else
            return $this->getFloor()." этаже";
    }
    
    public function getImages()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("idTable",RealtyImage::$TABLE_APARTMENT);
        $criteria->compare("idRecord",$this->id);
        $criteria->order = 'isMain DESC';
        $images = RealtyImage::model()->findAll($criteria);
        return $images;
    }

    public function getPlannings()
    {
        $criteria = new CDbCriteria();
        $criteria->compare("idRecord",$this->id);
        $criteria->compare("idTable",RealtyImage::$TABLE_APARTMENT_PLANNING);
        return RealtyImage::model()->findAll($criteria);
    }

    public function getGeo()
    {
        return $this->$building->lattitude . " " . $this->$building->longitude;
    }
    

}
