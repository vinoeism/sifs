<?php

class VoucherController extends RController
{
    
        private $_branch = null; 
        private $_job = null;
        
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
			'rights',
                        'postOnly + delete', // we only allow deletion via POST request
                        'branchContext + create + index', //ensures valid branch context
                    );
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

        /*
         * Specifies the allowed actions in this controlled 
         * This method is used for RBAC by the Rights Module
         * @return string allowed controller actions
         */
        public function allowedAction()
        {
            return 'index, admin, create, update, view, pass, approve, reject, pay';
        }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update','pass','approve'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $itemsDataProvider= new CActiveDataProvider('Moduledescription',
                        array(
                            'criteria'=>array(
                                'condition'=>'voucher_id=:voucherId AND isActive=1',
                                'params'=>array(':voucherId'=>  $this->loadModel($id)->id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'itemsDataProvider' => $itemsDataProvider,
                    
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Voucher;
                if (isset($_GET['branchID']))
                    $model->branch_id = $_GET['branchID'];
                if(isset($_GET['jobID'])) {
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'setting_key like \'jobexpense\'';
                    $criteria->select = 'setting_value';
                    $expensesDataProvider = CHtml::listData(Settings::model()->findAll($criteria),'setting_value','setting_value');
                } else {            
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'setting_key like \'branchexpense\'';
                    $criteria->select = 'setting_value';
                    $expensesDataProvider = CHtml::listData(Settings::model()->findAll($criteria),'setting_value','setting_value');
                }

                $branchesArray = CHtml::listData(Yii::app()->session['branches'],'id','branch_name');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Voucher']))
		{
			$model->attributes=$_POST['Voucher'];
                        if(isset($_GET['jobID']))
                            $model->job_id = $_GET['jobID'];
                        if(!isset($model->tds) || ($model->tds == null))
                            $model->tds=0.0;
                                
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
                        'branchesDataProvider'=>$branchesArray,
                        'expensesDataProvider'=>$expensesDataProvider,
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
                $branchesArray = CHtml::listData(Yii::app()->session['branches'],'id','branch_name');
                if(isset($model->job_id)) {
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'setting_key like \'jobexpense\'';
                    $criteria->select = 'setting_value';
                    $expensesDataProvider = CHtml::listData(Settings::model()->findAll($criteria),'setting_value','setting_value');
                } else {            
                    $criteria = new CDbCriteria;
                    $criteria->condition = 'setting_key like \'branchexpense\'';
                    $criteria->select = 'setting_value';
                    $expensesDataProvider = CHtml::listData(Settings::model()->findAll($criteria),'setting_value','setting_value');
                }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Voucher']))
		{
			$model->attributes=$_POST['Voucher'];
                        if(!isset($model->tds) || ($model->tds == null))
                            $model->tds=0.0;
                       
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
                        'branchesDataProvider'=>$branchesArray,
                        'expensesDataProvider'=>$expensesDataProvider,
		));
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionPass($id)
	{
		$model=$this->loadModel($id);
                
                $itemsDataProvider= new CActiveDataProvider('Moduledescription',
                        array(
                            'criteria'=>array(
                                'condition'=>'voucher_id=:voucherId AND isActive=1',
                                'params'=>array(':voucherId'=>  $this->loadModel($id)->id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Voucher']))
		{
			$model->attributes=$_POST['Voucher'];
                        $model->passed_by = Yii::app()->user->id;
                        $model->passed_on = date("Y-m-d H:i:s",time());
			if($model->save(false))
				$this->redirect(array('view','id'=>$model->id));
		}

                $netamount = isset($model->total_amount) && $model->total_amount!=0?$model->total_amount:0;
                if (isset($model->total_tax_1) && ($model->total_tax_1!=0))
                    $netamount = $netamount + $model->total_tax_1;
                if (isset($model->total_tax_2) && ($model->total_tax_2!=0))
                    $netamount = $netamount + $model->total_tax_2;
                if (isset($model->tds) && ($model->tds!=0))
                    $netamount = $netamount + $model->tds;
                if (isset($model->discount) && ($model->discount!=0))
                    $netamount = $netamount + $model->discount;
                if ($model->bill_amount != $netamount || $netamount ==0)
                {
                    $this->redirect(array('view','id'=>$model->id));
                }                
                
                
		$this->render('pass',array(
			'model'=>$model,
                        'itemsDataProvider'=>$itemsDataProvider,
                        
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionApprove($id)
	{
		$model=$this->loadModel($id);
                $itemsDataProvider= new CActiveDataProvider('Moduledescription',
                        array(
                            'criteria'=>array(
                                'condition'=>'voucher_id=:voucherId AND isActive=1',
                                'params'=>array(':voucherId'=>  $this->loadModel($id)->id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Voucher']))
		{
			$model->attributes=$_POST['Voucher'];
                        if (!isset($model->passed_by)) {
                            $model->passed_by = Yii::app()->user->id;
                            $model->passed_on = date("Y-m-d H:i:s",time());
                        }
                        $model->approved_by = Yii::app()->user->id;
                        $model->approved_on = date("Y-m-d H:i:s",time());
                        $model->rejected_by = null;
                        $model->rejected_on = null;
                        $model->rejection_comments = '';
			if($model->save(false))
				$this->redirect(array('view','id'=>$model->id));
		}

                $netamount = isset($model->total_amount) && $model->total_amount!=0?$model->total_amount:0;
                if (isset($model->total_tax_1) && ($model->total_tax_1!=0))
                    $netamount = $netamount + $model->total_tax_1;
                if (isset($model->total_tax_2) && ($model->total_tax_2!=0))
                    $netamount = $netamount + $model->total_tax_2;
                if (isset($model->tds) && ($model->tds!=0))
                    $netamount = $netamount + $model->tds;
                if (isset($model->discount) && ($model->discount!=0))
                    $netamount = $netamount + $model->discount;
                if ($model->bill_amount != $netamount || $netamount ==0)
                {
                    $this->redirect(array('view','id'=>$model->id));
                }                
                
		$this->render('approve',array(
			'model'=>$model,
                        'itemsDataProvider'=>$itemsDataProvider,
		));
	}

	/**
	 * Rejects a voucher from being processed for further action.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionReject($id)
	{
		$model=$this->loadModel($id);
                $itemsDataProvider= new CActiveDataProvider('Moduledescription',
                        array(
                            'criteria'=>array(
                                'condition'=>'voucher_id=:voucherId AND isActive=1',
                                'params'=>array(':voucherId'=>  $this->loadModel($id)->id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Voucher']))
		{
			$model->attributes=$_POST['Voucher'];
                        $model->rejected_by = Yii::app()->user->id;
                        $model->rejected_on = date("Y-m-d H:i:s",time());
                        $model->approved_by = null;
                        $model->approved_on = null;
                        $model->approval_comments = '';
                        
			if($model->save(false))
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('reject',array(
			'model'=>$model,
                        'itemsDataProvider'=>$itemsDataProvider,
		));
	}
        /**
	 * Updates the discount, as necessary
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionDiscount($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $netamount = isset($model->total_amount) && $model->total_amount!=0?$model->total_amount:0;
                if (isset($model->total_tax_1) && ($model->total_tax_1!=0))
                    $netamount = $netamount + $model->total_tax_1;
                if (isset($model->total_tax_2) && ($model->total_tax_2!=0))
                    $netamount = $netamount + $model->total_tax_2;
                if (isset($model->tds) && ($model->tds!=0))
                    $netamount = $netamount + $model->tds;

                $model->discount = $netamount - $model->bill_amount;
                $netamount = $netamount + $model->discount;
                if($model->save(false))
                    $this->redirect(array('view','id'=>$model->id,'netamount'=>$netamount));
	}        
	/**
	 * Invokes payment for a Voucher based on the voucher type
	 * @param integer $id the ID of the model to be paid
	 */
	public function actionPay($id)
	{
		$model=$this->loadModel($id);
                $this->redirect(array('payment/create','paymentMode'=>$model->voucher_type, 'id'=>$model->id));
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
//		$dataProvider=new CActiveDataProvider('Voucher');
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
		$model=new Voucher('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Voucher']))
			$model->attributes=$_GET['Voucher'];
		$model->branch_id= $this->_branch;
                
                // code to display only unpaid vouchers - starts here
                $unpaidVouchers = array();
                $criteria = new CDbCriteria;
                $criteria->select = 'id';
                $criteria->condition = 'id NOT IN (select voucher_id from voucherpayment)';
                foreach(Voucher::model()->findAll($criteria) as $vouchers)
                {
                    $unpaidVouchers[] = $vouchers->id;
                }
                $model->id = $unpaidVouchers;
                // code to display only unpaid vouchers - ends here
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays paid vouchers.
	 */
	public function actionPaidVouchers()
	{
		$model=new Voucher('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Voucher']))
			$model->attributes=$_GET['Voucher'];
		$model->branch_id= $this->_branch;
                // code to display only paid vouchers - starts here
                $paidVouchers = array();
                $criteria = new CDbCriteria;
                $criteria->select = 'id';
                $criteria->condition = 'id IN (select voucher_id from voucherpayment)';
                foreach(Voucher::model()->findAll($criteria) as $vouchers)
                {
                    $paidVouchers[] = $vouchers->id;
                }
                $model->id = $paidVouchers;
                // code to display only paid vouchers - ends here
		$this->render('paidAdmin',array(
			'model'=>$model,
		));
	}        
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Voucher the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Voucher::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Voucher $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='voucher-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function getBranch()
        {
            if ($this->_branch === NULL)
                throw new CHttpException(404,'The requested branch does not exist.');

            return $this->_branch;
        }
}
