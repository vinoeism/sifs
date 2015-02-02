<?php

class PaymentController extends Controller
{
        private $_branch;
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','cash','cheque','transfer','generatePaymentReceipt'),
				'users'=>array('@'),
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
	public function actionCreate($paymentMode,$id)
	{
                $voucherModel = Voucher::model()->findByPk($id);
		$model=new Payment;
                $model->branch_id = $voucherModel->branch_id;
                $model->party_id = $voucherModel->pay_to;
                $voucherDataProvider= new CActiveDataProvider('Voucher',
                            array(
                                'criteria'=>array(
                                    'alias'=>'v',
                                    'condition'=>'voucher_type=:vType 
                                            AND branch_id = :branchID 
                                            AND (approved_by != \' \' 
                                                or approved_by = null) 
                                            AND pay_to=:payTo 
                                            AND id NOT IN (select voucher_id from voucherpayment)',
                                    'params'=>array(':vType'=>$paymentMode, ':payTo'=>$voucherModel->pay_to, ':branchID'=>$voucherModel->branch_id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );     
                
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payment']) && isset($_POST['ids']))
		{
			$model->attributes=$_POST['Payment'];
                        $model->mode = $paymentMode;
                        if ($paymentMode == 'CHEQUE' || $paymentMode == 'CASH') {
                            $model->currency = 'INR';
                            $model->exchange_rate = 1.00;
                        } 
                        $model->amount = 0.00;
                        $model->total_amount = 0.00;
                        
			if($model->save())
                        {
                            foreach($_POST['ids'] as $selectedId)
                            {
                                $model->amount = $model->amount + Voucher::model()->findByPk($selectedId)->total_amount;
                                $vpModel = new Voucherpayment;
                                $vpModel->payment_id = $model->id;
                                $vpModel->voucher_id = $selectedId;
                                $model->total_amount = $model->amount;
                                if ($paymentMode == 'TRANSFER' && $model->currency != 'INR') {
                                    $model->amount = round($model->total_amount / $model->exchange_rate,2);
                                }
                                $vpModel->save();
                            }
                            if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'voucherDataProvider'=>$voucherDataProvider,
                        'paymentMode'=>$paymentMode,
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

		if(isset($_POST['Payment']))
		{
			$model->attributes=$_POST['Payment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
                        'paymentmode'=>$model->mode,
		));
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionGeneratePaymentReceipt($id)
	{
		$model=$this->loadModel($id);
                //Some data
                $students = array(
                    array('name'=>'Some Name','obs'=>'Mat'),
                    array('name'=>'Another Name','obs'=>'Tec'),
                    array('name'=>'Yet Another Name','obs'=>'Mat')
                );

                $r = new YiiReport(array('template'=> 'students.xls'));

                $r->load(array(
                        array(
                            'id' => 'ong',
                            'data' => array(
                                'name' => 'UNIVERSIDAD PADAGÓGICA NACIONAL'
                            )
                        ),
                        array(
                            'id'=>'estu',
                            'repeat'=>true,
                            'data'=>$students,
                            'minRows'=>2
                        )
                    )
                );

                echo $r->render('html', 'Students');
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
//		$dataProvider=new CActiveDataProvider('Payment');
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
		$model=new Payment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payment']))
			$model->attributes=$_GET['Payment'];
		$model->branch_id= $this->_branch;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Payment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Payment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}        
}
