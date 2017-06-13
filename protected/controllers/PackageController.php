<?php

class PackageController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Package;
                if(isset($_GET['jobID'])) {
                    $model->job_id = $_GET['jobID'];
                    $model->cargo = $model->jobs->cargo;
                }
                if(isset($_GET['formName'])) {
                    if($_GET['formName']=='CONTR') {
                        $model->type = Package::TYPE_CONTR;
                    } else {
                        $model->name = "Package";
                    }
                }               
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
                        if ($model->type == Package::TYPE_CONTR && empty($model->name)) {
                            $model->name = "Contr#";
                        }
                        if($model->save()) {
                            if ($model->type == Package::TYPE_CONTR) {                            
                                $criteria = new CDbCriteria;
                                $criteria->select = 'group_concat(name ORDER BY name ASC SEPARATOR \', \') as all_contrs, sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, count(name) as total_quantity, weight_unit';
                                $criteria->condition = 'job_id = '.$model->job_id;
                                $criteria->group = 'job_id';
                                $PackageModel = $model->findAll($criteria);

                                $model->jobs->gross_weight = $PackageModel[0]->total_gross_weight;
                                $model->jobs->nett_weight = $PackageModel[0]->total_net_weight;
                                $model->jobs->chargeable_weight = $PackageModel[0]->total_quantity;
                                $model->jobs->gross_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->nett_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->chargeable_weight_unit = Package::UNIT_CNTRS;
                                $model->jobs->packages = "".$PackageModel[0]->total_quantity." ".Package::TYPE_CONTR;
                                $model->jobs->contr_nos = $PackageModel[0]->all_contrs;
                                $model->jobs->save();

                            } else {
                                $criteria = new CDbCriteria;
                                $criteria->select = 'sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, sum(chargeable_weight) as total_chargeable_weight, SUM( quantity ) as total_quantity, weight_unit';
                                $criteria->condition = 'job_id = '.$model->job_id;
                                $criteria->group = 'job_id';
                                $PackageModel = $model->findAll($criteria);

                                $model->jobs->gross_weight = $PackageModel[0]->total_gross_weight;
                                $model->jobs->nett_weight = $PackageModel[0]->total_net_weight;
                                $model->jobs->chargeable_weight = $PackageModel[0]->total_chargeable_weight;
                                $model->jobs->gross_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->nett_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->chargeable_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->packages = $PackageModel[0]->total_quantity." ".Package::TYPE_PKG;
                                $model->jobs->save();                                
                            }
                            $this->redirect(array('job/view','id'=>$model->job_id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'formName'=>$_GET['formName'],
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];                              
                        if ($model->type == Package::TYPE_CONTR && empty($model->name)) {
                            $model->name = "Contr#";
                        }
			if($model->save())
                        {
                            if ($model->type == Package::TYPE_CONTR) {                            
                                $criteria = new CDbCriteria;
                                $criteria->select = 'group_concat(name ORDER BY name ASC SEPARATOR \', \') as all_contrs, sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, count(name) as total_quantity, weight_unit';
                                $criteria->condition = 'job_id = '.$model->job_id;
                                $criteria->group = 'job_id';
                                $PackageModel = $model->findAll($criteria);
                                $model->jobs->gross_weight = $PackageModel[0]->total_gross_weight;
                                $model->jobs->nett_weight = $PackageModel[0]->total_net_weight;
                                $model->jobs->chargeable_weight = $PackageModel[0]->total_quantity;
                                $model->jobs->gross_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->nett_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->chargeable_weight_unit = Package::UNIT_CNTRS;
                                $model->jobs->packages = "".$PackageModel[0]->total_quantity." ".Package::TYPE_CONTR;
                                $model->jobs->contr_nos = $PackageModel[0]->all_contrs;
                                $model->jobs->save();   

                            } else {
                                $criteria = new CDbCriteria;
                                $criteria->select = 'sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, sum(chargeable_weight) as total_chargeable_weight, SUM( quantity ) as total_quantity, weight_unit';
                                $criteria->condition = 'job_id = '.$model->job_id;
                                $criteria->group = 'job_id';
                                $PackageModel = $model->findAll($criteria);

                                $model->jobs->gross_weight = $PackageModel[0]->total_gross_weight;
                                $model->jobs->nett_weight = $PackageModel[0]->total_net_weight;
                                $model->jobs->chargeable_weight = $PackageModel[0]->total_chargeable_weight;
                                $model->jobs->gross_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->nett_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->chargeable_weight_unit = $PackageModel[0]->weight_unit;
                                $model->jobs->packages = $PackageModel[0]->total_quantity." ".Package::TYPE_PKG;
                                $model->jobs->save();   
                            }
                            $model->jobs->save();                                
                            $this->redirect(array('job/view','id'=>$model->job_id));
                        }		
                        
                }

		$this->render('update',array(
			'model'=>$model,
                        'formName'=>$_GET['formName'],                    
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                $model=$this->loadModel($id);
                $job_id = $model->job_id;
                $jobModel = Job::model()->findByPk($job_id);
                $packageType = $model->type;
                
                $model->delete();

                if ($packageType == Package::TYPE_CONTR) {  
                    $criteria = new CDbCriteria;
                    $criteria->select = 'sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, count(name) as total_quantity, weight_unit';
                    $criteria->condition = 'job_id = '.$job_id;
                    $criteria->group = 'job_id';
                    $PackageModel = Package::model()->findAll($criteria);

                    $jobModel->gross_weight = $PackageModel[0]->total_gross_weight;
                    $jobModel->nett_weight = $PackageModel[0]->total_net_weight;
                    $jobModel->chargeable_weight = $PackageModel[0]->total_quantity;
                    $jobModel->gross_weight_unit = $PackageModel[0]->weight_unit;
                    $jobModel->nett_weight_unit = $PackageModel[0]->weight_unit;
                    $jobModel->chargeable_weight_unit = Package::UNIT_CNTRS;
                    $jobModel->packages = $PackageModel[0]->total_quantity." ".Package::TYPE_CONTR;
                    $jobModel->save();
                } else {
                    $criteria = new CDbCriteria;
                    $criteria->select = 'sum(gross_weight) as total_gross_weight, sum(net_weight) as total_net_weight, sum(chargeable_weight) as total_chargeable_weight, SUM( quantity ) as total_quantity, weight_unit';
                    $criteria->condition = 'job_id = '.$job_id;
                    $criteria->group = 'job_id';
                    $PackageModel = Package::model()->findAll($criteria);

                    $jobModel->gross_weight = $PackageModel[0]->total_gross_weight;
                    $jobModel->nett_weight = $PackageModel[0]->total_net_weight;
                    $jobModel->chargeable_weight = $PackageModel[0]->total_chargeable_weight;
                    $jobModel->gross_weight_unit = $PackageModel[0]->weight_unit;
                    $jobModel->nett_weight_unit = $PackageModel[0]->weight_unit;
                    $jobModel->chargeable_weight_unit = $PackageModel[0]->weight_unit;
                    $jobModel->packages = $PackageModel[0]->total_quantity." ".Package::TYPE_PKG;
                    $jobModel->save();  
                }
                $this->redirect(array('job/view','id'=>$job_id));


//		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Package the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Package::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Package $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
