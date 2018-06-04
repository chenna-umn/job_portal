<?php

/**
 * This is the model class for table "subcategory".
 *
 * The followings are the available columns in table 'subcategory':
 * @property integer $id
 * @property string $name
 * @property integer $cat_id
 * @property string $created_on
 * @property string $updated_on
 * @property integer $display_on_top
 * @property integer $order
 * @property integer $status
 */
class Subcategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subcategory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, cat_id, created_on', 'required'),
			array('cat_id, display_on_top, order, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, cat_id, created_on, updated_on, display_on_top, order, status', 'safe', 'on'=>'search'),
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
			'cat_id' => 'Cat',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'display_on_top' => 'Display On Top',
			'order' => 'Order',
			'status' => 'Status',
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
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('display_on_top',$this->display_on_top);
		$criteria->compare('order',$this->order);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subcategory the static model class
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
                $model = Subcategory::model()->findAll();
            }else if($status=='active'){
                 $model = Subcategory::model()->findAll('status=:status',array(':status'=>1));
            }else if($status=='inactive'){
                 $model = Subcategory::model()->findAll('status=:status',array(':status'=>0));
            }else{
                $model = new Subcategory();
            }		
                return count($model);
	}
        
        public function getSubcategoryByCat($catId,$limit){
            
            $subCat = Subcategory::model()->findAllByAttributes(
                array(
                    'cat_id' => $catId,
                    'display_on_top' => 1
                ),
                array(
                    'order' => 'name asc',
                    'limit' => $limit,                   
                ));      
            return $subCat;
        }
        
        public function getSubcategoryByCatFullList($catId){
            
            $subCat = Subcategory::model()->findAllByAttributes(
                array(
                    'cat_id' => $catId,
                    'status' => 1
                ),
                array(
                    'order' => 'name asc',                                 
                ));      
            return $subCat;
        }
        
        
        
}
