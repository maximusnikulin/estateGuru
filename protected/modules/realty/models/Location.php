<?php

/**
 * This is the model class for table "floors".
 *
 * The followings are the available columns in table 'floors':
 * @property integer $id
 * @property string $name
 * @property integer $minFloor
 * @property integer $maxFloor
 * @property integer $idBlockSection
 * @property string $image
 */
class Location extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('minFloor, maxFloor, idBlockSection', 'numerical', 'integerOnly'=>true),
			array('name, image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, minFloor, maxFloor, idBlockSection, image', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Код',
			'name' => 'Наименование',
			'minFloor' => 'Начальный этаж',
			'maxFloor' => 'Конечный этаж',
			'idBlockSection' => 'Блок-секция',
			'image' => 'Изображение',
		);
	}

    public function getBlockSection()
    {
        return BlockSection::model()->findByPk($this->idBlockSection);
	}
	public function getNameAsString() {					
			if (is_null($this)) {
				return '';
			}
			$parts = explode("-", $this->name);
			if ($parts[0] == $parts[1]) {
				return $parts[0];
			}
			return $this->name;		
	}
    public function behaviors()
    {
        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'uploadPath' => 'realty/buildings/svgBackground',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 700,
                    'maxHeight' => 700,
                ],
            ],
        ];
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('minFloor',$this->minFloor);
		$criteria->compare('maxFloor',$this->maxFloor);
		$criteria->compare('idBlockSection',$this->idBlockSection);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Location the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
