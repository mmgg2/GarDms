<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property integer $idconfig
 * @property string $correo_host
 * @property string $correo_port
 * @property string $correo_username
 * @property string $correo_password
 * @property string $correo_from
 * @property string $correo_SMTPSecure
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Config the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('correo_host, correo_port, correo_username, correo_password, correo_from, correo_SMTPSecure', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idconfig, correo_host, correo_port, correo_username, correo_password, correo_from, correo_SMTPSecure', 'safe', 'on'=>'search'),
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
			'idconfig' => 'Idconfig',
			'correo_host' => 'Correo Host',
			'correo_port' => 'Correo Port',
			'correo_username' => 'Correo Username',
			'correo_password' => 'Correo Password',
			'correo_from' => 'Correo From',
			'correo_SMTPSecure' => 'Correo Smtpsecure',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idconfig',$this->idconfig);
		$criteria->compare('correo_host',$this->correo_host,true);
		$criteria->compare('correo_port',$this->correo_port,true);
		$criteria->compare('correo_username',$this->correo_username,true);
		$criteria->compare('correo_password',$this->correo_password,true);
		$criteria->compare('correo_from',$this->correo_from,true);
		$criteria->compare('correo_SMTPSecure',$this->correo_SMTPSecure,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}