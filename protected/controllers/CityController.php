<?php

class CityController extends Controller
{
	public $layout='admin';
        public $defaultAction = 'index';
	/**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex() {  
          Yii::app()->user->setState("adminmenu","city");
            ini_set('max_execution_time', 300);
                $this->layout = '//layouts/admin';
                if(Yii::app()->user->isAdmin){
                        $criteria=new CDbCriteria();
                        $criteria->select = 't.*,country.name as countryname,state.name as statename';
                        $criteria->join ='JOIN country ON country.id = t.country_id';  
                        $criteria->join ='JOIN state ON state.id = t.state_id';  
                        $count=City::model()->count($criteria);
                        $pages=new CPagination($count);
                        // results per page
                        $pages->pageSize=10;
                        $pages->applyLimit($criteria);
//                        print_r($criteria);exit;
                        $pageSize=$to=10;$from=0;
                       if(isset($_GET['page'])){
                           $from = ($_GET['page']-1)*$pageSize;
                           $to = ($_GET['page'])*$pageSize;
                       }
                        $models = Yii::app()->db->createCommand()
                        ->select('ct.*,c.name as countryname,s.name as statename')
                        ->from('city ct')
                        ->join('country c', 'c.id=ct.country_id')
                        ->join('state s', 's.id=ct.state_id')
                        ->order('ct.updated_on desc')
                        ->limit($pageSize,$from)
                        ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                        $count = City::model()->count($criteria);
                        
                        $this->render('index', array(
                        'models' => $models,
                             'pages' => $pages,'count'=>$count
                        ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
            }
            /**
             * This is the action to handle external exceptions.
             */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}   
        /**
             * This is the action to create a category.
             */
        
        public function actionCreate()
        {
            //date_default_timezone_set("Asia/Calcutta");
            Yii::app()->user->setState("adminmenu","city");
             if(Yii::app()->user->isAdmin){
                    $model = new City();
                    if(isset($_POST['City'])){
                        $model->attributes = $_POST['City'];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "City Added Successfully");
                                $this->redirect(array('City/index'));                  
                            }
                        }else{
                           
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New City...Please Try Later...!");   
                           $this->redirect(array('City/create'));
                        }
                    }                    
                    $this->render('create');
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
                /**
             * This is the action to create Bulk categories.
             */
        
        public function actionCreateMultiple()
        {
            //date_default_timezone_set("Asia/Calcutta");
            Yii::app()->user->setState("adminmenu","city");
             if(Yii::app()->user->isAdmin){
                    
                    if(isset($_POST['City'])){                       
                        $list = array();
                        $count = 0;
                        if($_POST['separator']=='line'){
                            $list = explode("\n", trim($_POST['City']['name']));
                        }else{
                            $list = explode(",", trim($_POST['City']['name']));
                        }
                        foreach($list as $key=>$value){
                            if(trim($value)){
                            $model = new City();
                            $model->name = trim($value);
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->updated_on = date('Y-m-d h:i:s');
                            $model->status= $_POST['City']['status'];
                            $model->country_id= $_POST['City']['country_id'];
                            $model->state_id= $_POST['City']['state_id'];
                            $model->display_on_top= $_POST['City']['display_on_top'];
                            if($model->validate()){
                                if($model->save()){
                                     $count++;
                                }
                               
                            }else{
                                 print_r($model->getErrors());exit;
                            }
                          }
                        }                        
                       Yii::app()->user->setFlash('success', "$count Cities Added Successfully");
                        $this->redirect(array('City/index'));
                    }else{                    
                     $this->render('createMultiple');
                    }
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }

        /**
             * This is the action to create a category.
             */
        
        public function actionUpdate($id)
        {
             Yii::app()->user->setState("adminmenu","city");
             if(Yii::app()->user->isAdmin){
                    $model = City::model()->findByPk($id);                 
                    if(isset($_POST['City'])){ 
                        $model->attributes = $_POST['City'];
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "City Updated Successfully");
                               $this->render('update',array('model'=>$model));                 
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating City...Please Try Later...!");   
                           $this->render('update',array('model'=>$model));
                        }
                    }else{
                        $this->render('update',array('model'=>$model));
                    }                    
//                    $this->render('update',array('model'=>$model));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionCityByStatus($field,$value)
        {
            Yii::app()->user->setState("adminmenu","city");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria(); 
                $criteria->select = 't.*,country.name as countryname,state.name as statename';
                $criteria->join ='JOIN country ON country.id = t.country_id';  
                $criteria->join ='JOIN state ON state.id = t.state_id'; 
                $criteria->order = 't.updated_on DESC';
                if($value=='active' && $field='status'){
                    $criteria->condition = "t.status=1";
                }else if($value=='inactive' && $field='status'){
                    $criteria->condition = "t.status=0";
                }else if($field='name'){
                     $criteria->condition = "t.name LIKE :value";
                     $criteria->params = array(':value' => '%'. trim($value) . '%'); 
                }
                $count=City::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                 $pageSize=$to=10;$from=0;
                       if(isset($_GET['page'])){
                           $from = ($_GET['page']-1)*$pageSize;
                           $to = ($_GET['page'])*$pageSize;
                       }
                       if($value=='active' && $field='status'){                           
                            $status=1;
                        }else if($value=='inactive' && $field='status'){                           
                            $status=0;
                        }
                        if($field=='status'){
                               $models = Yii::app()->db->createCommand()
                                        ->select('ct.*,c.name as countryname,s.name as statename')
                                        ->from('city ct')
                                        ->join('country c', 'c.id=ct.country_id')
                                        ->join('state s', 's.id=ct.state_id')
                                        ->where('ct.status=:status', array(':status'=>$status))
                                        ->order('ct.updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();       
                        }else{
                             $models = Yii::app()->db->createCommand()
                                        ->select('ct.*,c.name as countryname,s.name as statename')
                                        ->from('city ct')
                                        ->join('country c', 'c.id=ct.country_id')
                                        ->join('state s', 's.id=ct.state_id')
                                        ->where(array('like', 'ct.name', '%'.$value.'%'))
                                        ->order('ct.updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();
                        }
//                $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = City::model()->count($criteria);
                $this->render('citybystatus', array(
                    'models' => $models,
                    'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
          /**
             * This is the action to list the all the categories.
             */
        public function actionSearchByState($id)
        {
            Yii::app()->user->setState("adminmenu","city");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria=new CDbCriteria(); 
                $criteria->select = 't.*,country.name as countryname,state.name as statename';
                $criteria->join ='JOIN country ON country.id = t.country_id';  
                $criteria->join ='JOIN state ON state.id = t.state_id';  
                $criteria->order = 't.updated_on DESC';
                $criteria->condition = "t.state_id=:value";
                $criteria->params = array(':value' =>$id); 
                     
                $count=City::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models = Yii::app()->db->createCommand()
                        ->select('ct.*,c.name as countryname,s.name as statename')
                        ->from('city ct')
                        ->join('country c', 'c.id=ct.country_id')
                        ->join('state s', 's.id=ct.state_id')
                        ->order('ct.updated_on desc')
                        ->where('ct.state_id=:state_id',array(':state_id'=>$id))
                        ->queryAll();
                $count = City::model()->count($criteria);
                $this->render('index', array(
                    'models' => $models,
                    'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        /**
             * This is the action to delete a category.
             */
        
        public function actionDelete()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = City::model()->deleteByPk($_POST['id']);
                         if($model){
                             echo "success";
                         }else{
                             echo "failed";
                         }
                    }
                }
        }
        /**
             * This is the action to alter status of given category.
             * input : catId
             */
        
        public function actionMakeStatus()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = City::model()->findByPk($_POST['id']);
                         if($model->status==1){
                             $model->status=0;
                         }else{
                             $model->status=1;
                         }
                         if($model->validate()){
                             if($model->save()){
                                 echo "success";
                             }else{
                             echo "failed";
                            }
                             
                         }
                    }
                }
        }
        
        /**
             * This is the action to alter status of given category.
             * input : catId
             */
        
        public function actiongetStateList()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = State::model()->findAll('country_id=:country_id',array('country_id'=>$_POST['id']));
                         $result='<option value="">Select State</option>';
                         if(isset($model) && !empty($model)){
                             foreach($model as $key=>$value){
                                 $result.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
                             }
                         }else{
                             
                         }
                        echo  $result;
                    }
                }
        }
        
        /**
             * This is the action to alter status of given category.
             * input : catId
             */
        
        public function actiongetStateListSelect()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = State::model()->findAll('country_id=:country_id',array('country_id'=>$_POST['id']));
                         $result='<option value="">Select State</option>';
                         if(isset($model) && !empty($model)){
                             foreach($model as $key=>$value){
                                 if($value['id']==$_POST['stateId']){
                                        $result.='<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                 }else{
                                        $result.='<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                 }
                                 
                             }
                         }else{
                             
                         }
                        echo  $result;
                    }
                }
        }
}