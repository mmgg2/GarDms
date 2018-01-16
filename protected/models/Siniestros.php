<?php

/**
 * This is the model class for table "siniestros".
 *
 * The followings are the available columns in table 'siniestros':
 * @property integer $idsiniestros
 * @property string $codRama
 * @property string $descripcion
 * @property string $etiqueta
 * @property string $codSiniestro
 * @property string $timestampCreacion
 * @property string $flagDelete
 */
class Siniestros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Siniestros the static model class
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
		return 'siniestros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
		public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codRama, descripcion, etiqueta, codSiniestro,flagDelete', 'length', 'max'=>500),
			array('timestampCreacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idsiniestros, codRama, descripcion, etiqueta, codSiniestro, timestampCreacion,flagDelete', 'safe', 'on'=>'search'),
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
			'idsiniestros' => 'Identificador',
			'codRama' => 'Rama',
			'descripcion' => 'Descripcion',
			'etiqueta' => 'Etiqueta',
			'codSiniestro' => 'Código Siniestro',
			'timestampCreacion' => 'Fecha',
			'flagDelete' => 'Flag Delete',
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

		$criteria->compare('idsiniestros',$this->idsiniestros,true);
		$criteria->compare('codRama',$this->codRama,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('etiqueta',$this->etiqueta,true);
		$criteria->compare('codSiniestro',$this->codSiniestro,true);
		
	
		if ($this->timestampCreacion){
			if(strlen($this->timestampCreacion)== 5){
				$dateTemp=$this->timestampCreacion[3].$this->timestampCreacion[4].$this->timestampCreacion[2].$this->timestampCreacion[0].$this->timestampCreacion[1];
			}
			elseif(strlen($this->timestampCreacion)< 5){
				$dateTemp=$this->timestampCreacion;
			}
			else{
				$dateTemp=date("Y-m-d",strtotime($this->timestampCreacion));
			}
				$criteria->condition ="timestampCreacion LIKE '%".trim($dateTemp)."%'";
		}
		else{
			$criteria->compare('timestampCreacion',$this->timestampCreacion,true); 
		}



		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100),
		));
	}
}
