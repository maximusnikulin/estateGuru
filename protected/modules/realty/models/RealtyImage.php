<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property integer $idRecord
 * @property integer $idTable
 * @property string $path
 * @property string $label
 */
class RealtyImage extends \yupe\models\YModel
{
    static public $TABLE_APARTMENT = 1;
    static public $TABLE_BUILDING = 2;
    static public $TABLE_APARTMENT_PLANNING = 3;
    static public $TABLE_BUILDING_PLANNING = 4;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idRecord, idTable', 'numerical', 'integerOnly'=>true),
			array('path, label', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, label,  idRecord, idTable, path', 'safe', 'on'=>'search'),
		);
	}


    public function behaviors()
    {
        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'path',
                'uploadPath' => 'realty/images/',
                'resizeOnUpload' => true,
                'resizeOptions' => [
                    'maxWidth' => 700,
                    'maxHeight' => 700,
                ],
            ],
        ];
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
			'id' => 'ID',
			'idRecord' => 'Id Record',
			'idTable' => 'Id Table',
			'path' => 'Путь к изображению',
            'label' => 'Подпись к изображению'
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
		$criteria->compare('idRecord',$this->idRecord);
		$criteria->compare('idTable',$this->idTable);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
