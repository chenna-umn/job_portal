<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property string $updated_on
 * @property integer $order
 * @property integer $display_on_top
 * @property integer $status
 * @property integer $country_id
 * @property integer $state_id
 */
class City extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_on, updated_on, country_id, state_id', 'required'),
			array('order, display_on_top, status, country_id, state_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, created_on, updated_on, order, display_on_top, status, country_id, state_id', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'order' => 'Order',
			'display_on_top' => 'Display On Top',
			'status' => 'Status',
			'country_id' => 'Country',
			'state_id' => 'State',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('display_on_top',$this->display_on_top);
		$criteria->compare('status',$this->status);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('state_id',$this->state_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
          /**
	 * Returns total number of records
	 *	
	 */
	public function  recordCount($status)
	{
            if($status=='all'){
                $model = City::model()->findAll();
            }else if($status=='active'){
                 $model = City::model()->findAll('status=:status',array(':status'=>1));
            }else if($status=='inactive'){
                 $model = City::model()->findAll('status=:status',array(':status'=>0));
            }else{
                $model = new State();
            }		
                return count($model);
	}
        
           /**
	 * Returns 
	 *	
	 */
	public function  getLocation($locations)
	{
            
            $array = explode(',',$locations);
            $city='';
            $query = Yii::app()->db->createCommand()
            ->select('name')
            ->from('city')
            ->where(array('in', 'id', $array))
            ->queryAll();
            $count = count($query);
            
          foreach($query as $key=>$value){
              if($key+1 == $count) {
                  $city.=$value['name'];
              }else{
                  $city.=$value['name'].' / ';
              }
              
          }
          return $city;
	}
        
        
        public function getActiveTopCities(){
            $resultArray = array();
            $resultArray = Yii::app()->db->createCommand()                    
                        ->select('*')
                        ->from('city')
                        ->where('display_on_top=:display_on_top AND status=:status',array(':display_on_top'=>1,':status'=>1))
                        ->order('name ASC')                       
                        ->queryAll();
            return $resultArray;
        }
}
