<?php

class ModuledescriptionController extends Controller
{
        private $_module = null; 
        private $_moduleName = null;        

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
            if ($this->_moduleName == 'VOUCHER')
                $this->_module = Voucher::model()->findByPk($moduleId); 
            if ($this->_moduleName == 'INVOICE')
                $this->_module = Invoice::model()->findByPk($moduleId); 

            if ($this->_module === NULL)
                throw new CHttpException(404,'The requested voucher (or) invoice does not exist.');

            return $this->_module;
            
        }        
        
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'users'=>array('@'),
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
	 * Update the corresponding Voucher/Invoice
	 * @param model $model the model of the moduledescription whose parent modules need to be updated
        */
        public function updateParentModule($model)
        {
            $criteria = new CDbCriteria;
            $criteria->select = array(
                    'SUM(amount) as amount',
                    'SUM(tax_1_amount) as tax_1',
                    'SUM(tax_2_amount) as tax_2',
                );
            if (!empty($model->voucher_id) && ($model->voucher_id != 0))
            {
                $criteria->addCondition('voucher_id = '.$model->voucher_id);
                $criteria->addCondition('isActive = 1');

                $update_amounts = $model->find($criteria);
                $model->vouchers->total_amount = $update_amounts->amount;
                if (!empty($model->vouchers->tds) && ($model->vouchers->tds != 0))
                    $model->vouchers->total_amount = $model->vouchers->total_amount - $model->vouchers->tds;
                $model->vouchers->total_tax_1 = $update_amounts->tax_1;
                $model->vouchers->total_tax_2 = $update_amounts->tax_2;

                $model->vouchers->save(false);
                return;
            }
            if (!empty($model->invoice_id) && ($model->invoice_id != 0))
            {
                $criteria->addCondition('invoice_id = '.$model->invoice_id);
                $criteria->addCondition('isActive = 1');

                $update_amounts = $model->find($criteria);
                $model->invoices->total_amount = $update_amounts->amount;
                $model->invoices->total_tax_1 = $update_amounts->tax_1;
                $model->invoices->total_tax_2 = $update_amounts->tax_2;

                $model->invoices->save(false);
                return;
            }
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Moduledescription;
                $model->isActive = 1;                
                if ($this->_moduleName == 'VOUCHER')
                    $model->voucher_id = $this->_module->id;
                if ($this->_moduleName == 'INVOICE')
                    $model->invoice_id = $this->_module->id;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Moduledescription']))
		{
			$model->attributes=$_POST['Moduledescription'];

                            $model->amount = $model->exchange_rate * $model->rate * $model->quantity;
                            $model->tax_1_amount = 0.00;
                            $model->tax_2_amount = 0.00;
                            if (!empty($model->tax_1) && ($model->tax_1 != NULL) && ($model->tax_1!=0))
                            {
                                $tax= Tax::model()->findByPk($model->tax_1);
                                $model->tax_1_amount = round($tax->tax_percent * $model->amount / 100,2);
                            }
                            if (!empty($model->tax_2) && ($model->tax_2 != NULL) && ($model->tax_2 != 0))
                            {
                                $tax= Tax::model()->findByPk($model->tax_2);
                                $model->tax_2_amount = round($tax->tax_percent * $model->amount / 100,2);
                            }			
                            if($model->save())
                            {
                                //updating the corresponding voucher row with totals
                                $this->updateParentModule($model);
                                if ($this->_moduleName == 'VOUCHER')
                                {
                                	$this->redirect(array('voucher/view','id'=>$model->voucher_id));
                                }
                                if ($this->_moduleName == 'INVOICE')
                                {
                                	$this->redirect(array('invoice/view','id'=>$model->invoice_id));
                                }                                
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

		if(isset($_POST['Moduledescription']))
		{
			$model->attributes=$_POST['Moduledescription'];

                        $model->amount = $model->exchange_rate * $model->rate * $model->quantity;
                        $model->tax_1_amount = 0.00;
                        $model->tax_2_amount = 0.00;
                        if (!empty($model->tax_1) && ($model->tax_1 != NULL) && ($model->tax_1!=0))
                        {
                            $tax= Tax::model()->findByPk($model->tax_1);
                            $model->tax_1_amount = round($tax->tax_percent * $model->amount / 100,2);
                        }
                        if (!empty($model->tax_2) && ($model->tax_2 != NULL) && ($model->tax_2 != 0))
                        {
                            $tax= Tax::model()->findByPk($model->tax_2);
                            $model->tax_2_amount = round($tax->tax_percent * $model->amount / 100,2);
                        }			
                        if($model->save(false))
                        {
                            //updating the corresponding voucher row with totals
                            $this->updateParentModule($model);
                            $this->redirect(array('voucher/view','id'=>$model->voucher_id));
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
                            echo 'here';

		$model = $this->loadModel($id);
                echo 'here';
                $criteria = new CDbCriteria;
                $criteria->select = array(
                        'SUM(amount) as amount',
                        'SUM(tax_1_amount) as tax_1',
                        'SUM(tax_2_amount) as tax_2',
                    );
                if (!empty($model->voucher_id) && ($model->voucher_id != 0))
                {
                echo 'here';

                    $voucherId = $model->voucher_id;
                    $criteria->addCondition('voucher_id = '.$model->voucher_id);
                    $criteria->addCondition('isActive = 1');

                    $update_amounts = $model->find($criteria);
                    $model->vouchers->total_amount = $update_amounts->amount - $model->amount;
                    $model->vouchers->total_tax_1 = $update_amounts->tax_1 - $model->tax_1_amount;
                    $model->vouchers->total_tax_2 = $update_amounts->tax_2 - $model->tax_2_amount;

                    $model->vouchers->save(false);
                    $model->delete();
                echo 'here';
                    
                    $this->redirect(array('voucher/view','id'=>$voucherId));

                }                

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Moduledescription');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Moduledescription('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Moduledescription']))
			$model->attributes=$_GET['Moduledescription'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Moduledescription the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Moduledescription::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Moduledescription $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='moduledescription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
