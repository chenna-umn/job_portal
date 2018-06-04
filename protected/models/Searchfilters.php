<?php

/**
 * This is the model class for table "searchfilters".
 *
 * The followings are the available columns in table 'searchfilters':
 * @property integer $id
 * @property integer $user_id
 * @property integer $cat_id
 * @property string $subcat_id
 * @property integer $status
 * @property string $created_on
 * @property string $updated_on
 */
class Searchfilters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'searchfilters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, cat_id, status', 'numerical', 'integerOnly'=>true),
			array('subcat_id, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, cat_id, subcat_id, status, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'cat_id' => 'Cat',
			'subcat_id' => 'Subcat',
			'status' => 'Status',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Searchfilters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
       public function getSearchFilterCountByCat($catId){
               $count = 0;
               $searchFilter = Searchfilters::model()->find('user_id=:user_id AND cat_id=:cat_id',array('user_id'=>Yii::app()->user->memberId,'cat_id'=>$catId));
               if(isset($searchFilter) && !empty ($searchFilter)){
                   $subcatArray = array();
                   if(isset($searchFilter->subcat_id) && !empty ($searchFilter->subcat_id)) {
                        $subcatArray = explode(",", $searchFilter->subcat_id);
                   }
                  $subcatArray= array_filter($subcatArray);                 
                  $count = count($subcatArray);
               }
               return $count;
           }
           
       public function getSearchFilterByCat($catId){
               $result = array();
               $searchFilter = Searchfilters::model()->find('user_id=:user_id AND cat_id=:cat_id',array('user_id'=>Yii::app()->user->memberId,'cat_id'=>$catId));
               if(isset($searchFilter) && !empty ($searchFilter)){
                  $subcatArray = explode(",", $searchFilter->subcat_id);
                  $subcatArray= array_filter($subcatArray);
                  $result = $subcatArray;
               }
               return $result;
           }
}
