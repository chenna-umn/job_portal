<?php

class SubcategoryController extends Controller
{
        public $layout='admin';
        public $defaultAction = 'index';
	/**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex() {  
           Yii::app()->user->setState("adminmenu","subcategories");
            ini_set('max_execution_time', 300);
                $this->layout = '//layouts/admin';
                if(Yii::app()->user->isAdmin){
                        $criteria=new CDbCriteria();
                        $criteria->select = 't.*,category.name as categoryname';
                        $criteria->join ='JOIN category ON category.id = t.cat_id';                       
                        $count=Subcategory::model()->count($criteria);
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
                        ->select('s.*,c.name as categoryname')
                        ->from('subcategory s')
                        ->join('category c', 'c.id=s.cat_id')
                        ->order('updated_on desc')
                        ->limit($pageSize,$from)
                        ->queryAll();
//                        $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                        $count = Subcategory::model()->count($criteria);
                        
                        $this->render('subcategories', array(
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
            Yii::app()->user->setState("adminmenu","subcategories");
             if(Yii::app()->user->isAdmin){
                    $model = new Subcategory();
                    if(isset($_POST['Subcategory'])){
                        $model->attributes = $_POST['Subcategory'];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Sub Caregory Added Successfully");
                                $this->redirect(array('Subcategory/index'));                  
                            }
                        }else{
                           
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Sub Category...Please Try Later...!");   
                           $this->redirect(array('Subcategory/create'));
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
            Yii::app()->user->setState("adminmenu","subcategories");
             if(Yii::app()->user->isAdmin){
                    
                    if(isset($_POST['Subcategory'])){
                        $list = array();
                        $count = 0;
                        if($_POST['separator']=='line'){
                            $list = explode("\n", trim($_POST['Subcategory']['name']));
                        }else{
                            $list = explode(",", trim($_POST['Subcategory']['name']));
                        }
                        foreach($list as $key=>$value){
                            if(!empty($value) && isset($value)){
                            $model = new Subcategory();
                            $model->name = trim($value);
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->updated_on = date('Y-m-d h:i:s');
                            $model->status= $_POST['Subcategory']['status'];
                            $model->cat_id= $_POST['Subcategory']['cat_id'];
                            $model->display_on_top= $_POST['Subcategory']['display_on_top'];
                            if($model->validate()){
                                if($model->save()){
                                     $count++;
                                }
                               
                            }else{
                                 print_r($model->getErrors());exit;
                            }
                          }
                        }                        
                       Yii::app()->user->setFlash('success', "$count Sub Caregories Added Successfully");
                        $this->redirect(array('Subcategory/index'));
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
             Yii::app()->user->setState("adminmenu","subcategories");
             if(Yii::app()->user->isAdmin){
                    $model = Subcategory::model()->findByPk($id);                 
                    if(isset($_POST['Subcategory'])){ 
                        $model->attributes = $_POST['Subcategory'];
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Sub Caregory Updated Successfully");
                               $this->render('update',array('model'=>$model));                 
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Sub Category...Please Try Later...!");   
                           $this->render('update',array('model'=>$model));
                        }
                    }else{
                        $this->render('update',array('model'=>$model));
                    }                    
                   // $this->render('update',array('model'=>$model));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionSubCategoriesByStatus($field,$value)
        {
            Yii::app()->user->setState("adminmenu","subcategories");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria(); 
                $criteria->select = 't.*,category.name as categoryname';
                $criteria->join ='JOIN category ON category.id = t.cat_id'; 
                $criteria->order = 'updated_on DESC';
                if($value=='active' && $field='status'){
                    $criteria->condition = "t.status=1";
                }else if($value=='inactive' && $field='status'){
                    $criteria->condition = "t.status=0";
                }else if($field='name'){
                     $criteria->condition = "t.name LIKE :value";
                     $criteria->params = array(':value' => '%'. trim($value) . '%'); 
                }
                $count=Subcategory::model()->count($criteria);
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
                                        ->select('s.*,c.name as categoryname')
                                        ->from('subcategory s')
                                        ->join('category c', 'c.id=s.cat_id')
                                        ->where('s.status=:status', array(':status'=>$status))
                                        ->order('updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();       
                        }else{
                             $models = Yii::app()->db->createCommand()
                                        ->select('s.*,c.name as categoryname')
                                        ->from('subcategory s')
                                        ->join('category c', 'c.id=s.cat_id')
                                        ->where(array('like', 's.name', '%'.$value.'%'))
                                        ->order('updated_on desc')
                                        ->limit($pageSize,$from)
                                        ->queryAll();
                        }
//                $models=Subcategory::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = Subcategory::model()->count($criteria);
                $this->render('subcategoriesbystatus', array(
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
        public function actionSearchByCategory($id)
        {
            Yii::app()->user->setState("adminmenu","subcategories");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->select = 't.*,category.name as categoryname';
                $criteria->join ='JOIN category ON category.id = t.cat_id';
                $criteria->order = 'updated_on DESC';
                $criteria->condition = "cat_id=:value";
                $criteria->params = array(':value' =>$id); 
                     
                $count=Subcategory::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models = Yii::app()->db->createCommand()
                                        ->select('s.*,c.name as categoryname')
                                        ->from('subcategory s')
                                        ->join('category c', 'c.id=s.cat_id')
                                        ->where('s.cat_id=:cat_id', array(':cat_id'=>$id))
                                        ->order('updated_on desc')                                   
                                        ->queryAll();   
                $count = Subcategory::model()->count($criteria);
                $this->render('subcategories', array(
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
                         $model = Subcategory::model()->deleteByPk($_POST['id']);
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
                         $model = Subcategory::model()->findByPk($_POST['id']);
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
        public function actiongetSubCategoriesByCat()
        {             
                                            
                    if(isset($_POST['id'])){ 
                         $model = Subcategory::model()->findAll('cat_id=:cat_id',array(':cat_id'=>$_POST['id']));
                         $result='<option value="" selected>Select Subcategory</option>';
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