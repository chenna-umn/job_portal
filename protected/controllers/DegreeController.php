<?php

class DegreeController extends Controller
{
	 
    public $layout='admin';
        public $defaultAction = 'index'; 
	/**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex() {  
          Yii::app()->user->setState("adminmenu","degree");
            ini_set('max_execution_time', 300);
                $this->layout = '//layouts/admin';
                if(Yii::app()->user->isAdmin){
                    $criteria=new CDbCriteria();     
                    $criteria->order = 'updated_on DESC';
                    $count=Degree::model()->count($criteria);
                    $pages=new CPagination($count);

                    // results per page
                    $pages->pageSize=10;
                    $pages->applyLimit($criteria);
                    $models=Degree::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                    $count = Degree::model()->count($criteria);
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
             Yii::app()->user->setState("adminmenu","degree");
             if(Yii::app()->user->isAdmin){
                    $model = new Degree();
                    if(isset($_POST['Degree'])){
                        $model->attributes = $_POST['Degree'];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Degree Added Successfully");
                                $this->redirect(array('Degree/index'));                  
                            }
                        }else{
                            print_r($model->getErrors());exit;
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Degree...Please Try Later...!");   
                           $this->redirect(array('Degree/create'));
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
             Yii::app()->user->setState("adminmenu","degree");
             if(Yii::app()->user->isAdmin){
                    
                    if(isset($_POST['Degree'])){
                        $list = array();
                        $count = 0;
                        if($_POST['separator']=='line'){
                            $list = explode("\n", trim($_POST['Degree']['name']));
                        }else{
                            $list = explode(",", trim($_POST['Degree']['name']));
                        }
                        foreach($list as $key=>$value){
                            if(!empty($value)){
                            $model = new Degree();
                            $model->name = trim($value);
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->updated_on = date('Y-m-d h:i:s');
                            $model->status= $_POST['Degree']['status'];
                            if($model->validate()){
                                if($model->save()){
                                     $count++;
                                }
                               
                            }
                          }
                        }                        
                       Yii::app()->user->setFlash('success', "$count Degrees Added Successfully");
                        $this->redirect(array('Degree/index'));
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
              Yii::app()->user->setState("adminmenu","degree");
             if(Yii::app()->user->isAdmin){
                    $model = Degree::model()->findByPk($id);                 
                    if(isset($_POST['Degree'])){ 
                        $model->attributes = $_POST['Degree'];
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Degree Updated Successfully");
                               $this->render('update',array('model'=>$model));                 
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Degree...Please Try Later...!");   
                           $this->render('update',array('model'=>$model));
                        }
                    } else{
                        $this->render('update',array('model'=>$model));
                    }                   
                    
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionDegreeByStatus($field,$value)
        {
             Yii::app()->user->setState("adminmenu","degree");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->order = 'updated_on DESC';
                if($value=='active' && $field='status'){
                    $criteria->condition = "$field=1";
                }else if($value=='inactive' && $field='status'){
                    $criteria->condition = "$field=0";
                }else if($field='name'){
                     $criteria->condition = "$field LIKE :value";
                     $criteria->params = array(':value' => '%'. trim($value) . '%'); 
                }
                $count=Degree::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=  Degree::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = Degree::model()->count($criteria);
                $this->render('degreebystatus', array(
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
                         $model = Degree::model()->deleteByPk($_POST['id']);
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
                         $model = Degree::model()->findByPk($_POST['id']);
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