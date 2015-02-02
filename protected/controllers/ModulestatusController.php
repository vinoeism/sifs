<?php

class ModulestatusController extends Controller
{
        private $_module = null; 
        private $_moduleName = null;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        
        /*
         * Protected method to load the associated module
         * @param integer moduleId the primary key of the module
         * @param string moduleName the name of the module - JOB / VOUCHER / RECEIPT / BILL / PAYMENT
         * @return object the Job data model based on the primary key
         */
        protected function loadModule($moduleId, $moduleName)
        {

            $this->_moduleName = $moduleName;
            //checks the module name and selects the model accordingly
            if ($this->_moduleName == 'JOB') 
                $this->_module = Job::model()->findByPk($moduleId);
            if ($this->_moduleName == 'VOUCHER')
                $this->_module = Voucher::model()->findByPk($moduleId); 
            if ($this->_module === NULL)
                throw new CHttpException(404,'The requested module does not exist.');

            return $this->_module;
            
        }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                        'moduleContext + create', //ensures valid module context
		);
	}
                
        /*
         * Ensures the Module context for the status
         * 
         */
        public function filterModuleContext($filterChain)
        {
            if (isset($_GET['moduleid']) && isset($_GET['modulename']))
                $this->loadModule($_GET['moduleid'], $_GET['modulename']);
            else                
                throw new CHttpException(403,'Must specify a module before performing this action');
            
            $filterChain->run();
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
				'actions'=>array('create','update'),
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
		$model=new Modulestatus;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Modulestatus']))
		{
			$model->attributes=$_POST['Modulestatus'];
                        if ($this->_moduleName === 'JOB') 
                        {
                            $model->job_id = $this->_module->id;
                            if($model->save())
                                    $this->redirect(array('job/view','id'=>$model->job_id));
                        }
                        
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Modulestatus']))
		{
			$model->attributes=$_POST['Modulestatus'];
                        if ($this->_moduleName === 'JOB') 
                        {
                            $model->job_id = $this->_module->id;
                            if($model->save())
                                    $this->redirect(array('job/view','id'=>$model->job_id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Modulestatus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Modulestatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Modulestatus']))
			$model->attributes=$_GET['Modulestatus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Modulestatus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Modulestatus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Modulestatus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='modulestatus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
