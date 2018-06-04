<?php

class StateController extends Controller
{
	public $layout='admin';
        public $defaultAction = 'index';
	/**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex() {  
          Yii::app()->user->setState("adminmenu","state");
            ini_set('max_execution_time', 300);
                $this->layout = '//layouts/admin';
                if(Yii::app()->user->isAdmin){
                        $criteria=new CDbCriteria();
                        $criteria->select = 't.*,country.name as countryname';
                        $criteria->join ='JOIN country ON country.id = t.country_id';                       
                        $count=State::model()->count($criteria);
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
                        ->select('s.*,c.name as countryname')
                        ->from('state s')
                        ->join('country c', 'c.id=s.country_id')
                        ->order('s.updated_on desc')
                        ->limit($pageSize,$from)
                        ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                        $count = State::model()->count($criteria);
                        
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
             Yii::app()->user->setState("adminmenu","state");
             if(Yii::app()->user->isAdmin){
                    $model = new State();
                    if(isset($_POST['State'])){
                        $model->attributes = $_POST['State'];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "State Added Successfully");
                                $this->redirect(array('State/index'));                  
                            }
                        }else{
                           
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New State...Please Try Later...!");   
                           $this->redirect(array('State/create'));
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
             Yii::app()->user->setState("adminmenu","state");
             if(Yii::app()->user->isAdmin){
                    
                    if(isset($_POST['State'])){                       
                        $list = array();
                        $count = 0;
                        if($_POST['separator']=='line'){
                            $list = explode("\n", trim($_POST['State']['name']));
                        }else{
                            $list = explode(",", trim($_POST['State']['name']));
                        }
                        foreach($list as $key=>$value){
                            if(!empty($value)){
                            $model = new State();
                            $model->name = trim($value);
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->updated_on = date('Y-m-d h:i:s');
                            $model->status= $_POST['State']['status'];
                            $model->country_id= $_POST['State']['country_id'];
                            $model->display_on_top= $_POST['State']['display_on_top'];
                            if($model->validate()){
                                if($model->save()){
                                     $count++;
                                }
                               
                            }else{
                                 print_r($model->getErrors());exit;
                            }
                          }
                        }                        
                       Yii::app()->user->setFlash('success', "$count States Added Successfully");
                        $this->redirect(array('State/index'));
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
              Yii::app()->user->setState("adminmenu","state");
             if(Yii::app()->user->isAdmin){
                    $model = State::model()->findByPk($id);                 
                    if(isset($_POST['State'])){ 
                        $model->attributes = $_POST['State'];
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "State Updated Successfully");
                               $this->render('update',array('model'=>$model));                 
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating State...Please Try Later...!");   
                           $this->render('update',array('model'=>$model));
                        }
                    }else{
                        $this->render('update',array('model'=>$model));
                    }                    
                    //$this->render('update',array('model'=>$model));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionStateByStatus($field,$value)
        {
            Yii::app()->user->setState("adminmenu","state");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria(); 
                $criteria->select = 't.*,country.name as countryname';
                $criteria->join ='JOIN country ON country.id = t.country_id'; 
                $criteria->order = 't.updated_on DESC';
                if($value=='active' && $field='status'){
                    $criteria->condition = "t.status=1";
                }else if($value=='inactive' && $field='status'){
                    $criteria->condition = "t.status=0";
                }else if($field='name'){
                     $criteria->condition = "t.name LIKE :value";
                     $criteria->params = array(':value' => '%'. trim($value) . '%'); 
                }
                $count=State::model()->count($criteria);
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
                                        ->select('s.*,c.name as countryname')
                                        ->from('state s')
                                        ->join('country c', 'c.id=s.country_id')
                                        ->where('s.status=:status', array(':status'=>$status))
                                        ->order('s.updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();       
                        }else{
                             $models = Yii::app()->db->createCommand()
                                        ->select('s.*,c.name as countryname')
                                        ->from('state s')
                                        ->join('country c', 'c.id=s.country_id')
                                        ->where(array('like', 's.name', '%'.$value.'%'))
                                        ->order('s.updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();
                        }
//                $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = State::model()->count($criteria);
                $this->render('statebystatus', array(
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
        public function actionSearchByCountry($id)
        {
            Yii::app()->user->setState("adminmenu","state");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria=new CDbCriteria(); 
                $criteria->select = 't.*,country.name as countryname';
                $criteria->join ='JOIN country ON country.id = t.country_id'; 
                $criteria->order = 't.updated_on DESC';
                $criteria->condition = "country_id=:value";
                $criteria->params = array(':value' =>$id); 
                     
                $count=State::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models = Yii::app()->db->createCommand()
                        ->select('s.*,c.name as countryname')
                        ->from('state s')
                        ->join('country c', 'c.id=s.country_id')
                        ->order('s.updated_on desc')
                        ->where('country_id=:country_id',array(':country_id'=>$id))
                        ->queryAll();
                $count = State::model()->count($criteria);
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
                         $model = State::model()->deleteByPk($_POST['id']);
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
                         $model = State::model()->findByPk($_POST['id']);
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
}