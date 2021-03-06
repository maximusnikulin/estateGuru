<?php

/**
 * This is the model class for table "{{subscribe}}".
 *
 * The followings are the available columns in table '{{subscribe}}':
 * @property integer $id
 * @property string $email
 * @property string $dateAdd
 */
class Subscribe extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{subscribe}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'length', 'max'=>255),
			array('dateAdd', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, dateAdd', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'dateAdd' => 'Дата подписки',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dateAdd',$this->dateAdd,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subscribe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave() {
	    $this->email = trim($this->email);
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
	    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Некорректный email');
            return false;
        }
	    if (empty($this->email)) {
            $this->addError('email', 'Пожалуйста, введите email');
            return false;
        }
        if (empty($this->email)) {
            $this->addError('email', 'Пожалуйста, введите email');
            return false;
        }
        if (Subscribe::model()->exists("email = '" . $this->email . "'")) {
            $this->addError('email', 'Вы уже подписаны на нашу рассылку');
            return false;
        }
        return parent::beforeSave();
    }
}
