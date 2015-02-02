<?php

class ReceiptController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        private $_branch = null; 

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'rights',
			'postOnly + delete', // we only allow deletion via POST request
                        'branchContext + create + index', //ensures valid branch context
		);
	}
        /*
         * Protected method to load the associated branch
         * @param integer branchId the primary key of the Branch
         * @return object the branch data model based on the primary key
         */
        protected function loadBranch($branchId)
        {

            $this->_branch = Branch::model()->findByPk($branchId);
            if ($this->_branch === NULL)
                throw new CHttpException(404,'The requested branch does not exist.');

            return $this->_branch;
            
        }        
        /*
         * Ensures the branch context for the task
         * 
         */
        public function filterBranchContext($filterChain)
        {
            if (isset($_GET['branchID']) )
                $this->loadBranch($_GET['branchID']);
            //code for getting branch id based on user
            else if (!empty(Yii::app()->session['branches']))
            {
                $branches = Yii::app()->session['branches'];
                $this->_branch = array();
                foreach($branches as $branch)
                {
                    $this->_branch[] = $branch->id;
                }
            }
            else                
                throw new CHttpException(403,'Must specify a branch before performing this action');
            
            $filterChain->run();
        }
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*
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
	} */
        
        /*
         * Specifies the allowed actions in this controlled 
         * This method is used for RBAC by the Rights Module
         * @return string allowed controller actions
         */
        public function allowedAction()
        {
            return 'index, admin, create, update, view';
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
		$model=new Receipt;
                if (isset($_GET['branchID']))
                    $model->branch_id = $_GET['branchID'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
                        $model->total_amount = ($model->amount * $model->exchange_rate) - $model->TDS - $model->discount;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Creates a new model based on the invoices selected
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionReceive()
	{
		$model=new Receipt;
                if (isset($_GET['branchID']))
                    $model->branch_id = $_GET['branchID'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
                        $model->total_amount = ($model->amount * $model->exchange_rate) - $model->TDS - $model->discount;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Receipt']))
		{
			$model->attributes=$_POST['Receipt'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
//		$dataProvider=new CActiveDataProvider('Receipt');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
                $this->actionAdmin();

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Receipt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Receipt']))
			$model->attributes=$_GET['Receipt'];
		$model->branch_id= $this->_branch;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Receipt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Receipt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Receipt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='receipt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
