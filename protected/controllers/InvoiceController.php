<?php

class InvoiceController extends RController
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
			'rights',
			'postOnly + delete', // we only allow deletion via POST request
		);
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
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update','approve','printPDF'),
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
                                'condition'=>'invoice_id=:invoiceid AND isActive=1',
                                'params'=>array(':invoiceid'=>  $id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
                     
                $statusDataProvider = new CActiveDataProvider('Modulestatus',
                            array(
                                'criteria'=>array(
                                    'condition'=>'invoice_id=:invoiceid',
                                    'params'=>array(':invoiceid'=>  $id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'itemsDataProvider' => $itemsDataProvider,
                        'statusDataProvider' => $statusDataProvider,
		));
	}
        
        /**
	 * Generates a new REFNo.
         * @param Invoice $model instance of the Invoice class
         * @return string The reference number
	 */
        private function generateREFNo($model)
        {
                $codePart = Settings::model()->findBySettingKey('companyshortcode').Branch::model()->findByPK($model->branch_id)->branch_code;
                $yearPart = date('y');
                $yearPart = $yearPart.($yearPart+1);
                $numberPart = Settings::model()->findBySettingKey('invoicestart')+Invoice::model()->count();
                $numberPart = str_pad($numberPart, Settings::model()->findBySettingKey('invoicedecimals'), '0', STR_PAD_LEFT);
                return $codePart.$yearPart.$numberPart;
        }


        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($jobId, $branchId)
	{
		$model=new Invoice;
                $model->job_id = $jobId;
                $model->branch_id = $branchId;
                
                $model->invoice_date = date('Y-m-d');
                $model->REFNO = $this->generateREFNo($model);
                $model->is_active = 1; // By default a newly invoice can be only active
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
                        
                        //calculation of Due on field
                        $datetime = new DateTime($model->invoice_date);
                        $interval = Settings::model()->findByPK($model->invoice_terms)->setting_subkey;
                        $datetime->add(new DateInterval('P'.$interval.'D'));
                        $model->due_on = $datetime->format('Y-m-d');
                        
			if($model->save())
                        {
                                // Code to copy vouchers with their items in to the invoice automatically
                                foreach($model->jobs->vouchers as $voucher) {
                                    foreach($voucher->items as $voucherItem){
                                        $invoiceItem = new Moduledescription;
                                        $invoiceItem->attributes = $voucherItem->attributes;
                                        $invoiceItem->invoice_id = $model->id;
                                        unset($invoiceItem->voucher_id);
                                        $invoiceItem->save();
                                    }
                                }
                                // Code to update the status in Module Status
                                $moduleStatus = new Modulestatus;
                                $moduleStatus->status = 'Created';
                                $moduleStatus->invoice_id = $model->id;
                                $moduleStatus->created_by = $model->created_by;
                                $moduleStatus->created_on = $model->created_on;
                                $moduleStatus->updated_by = $model->updated_by;
                                $moduleStatus->updated_on = $model->updated_on;
                                $moduleStatus->save();
				$this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	 * Receives amount for a created invoice
	 * @param integer $id the ID of the model to be received
	 */
	public function actionReceive($id)
	{
		$model=$this->loadModel($id);
                $this->redirect(array('receipt/receive','receiptMode'=>'INVOICE', 'id'=>$model->id));
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

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
                        //calculation of Due on field
                        $datetime = new DateTime($model->invoice_date);
                        $interval = Settings::model()->findByPK($model->invoice_terms)->setting_subkey;
                        $datetime->add(new DateInterval('P'.$interval.'D'));
                        $model->due_on = $datetime->format('Y-m-d');
                        
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	 * Approves a particular invoice.
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

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
                        $model->approved_by = Yii::app()->user->id;
                        $model->approved_on = date("Y-m-d H:i:s",time());
			if($model->save())
                        {
                                // Code to update the status in Module Status
                                $moduleStatus = new Modulestatus;
                                $moduleStatus->status = 'Approved';
                                $moduleStatus->invoice_id = $model->id;
                                $moduleStatus->created_by = $model->created_by;
                                $moduleStatus->created_on = $model->created_on;
                                $moduleStatus->updated_by = $model->updated_by;
                                $moduleStatus->updated_on = $model->updated_on;
                                $moduleStatus->save();
				$this->redirect(array('view','id'=>$model->id));                        }
		}

		$this->render('approve',array(
			'model'=>$model,
                        'itemsDataProvider'=>$itemsDataProvider,
		));	}

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
//		$dataProvider=new CActiveDataProvider('Invoice');
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
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];
                if ($this->isExportRequest()) { //<==== [[ADD THIS BLOCK BEFORE RENDER]]
                            //set_time_limit(0); //Uncomment to export lage datasets
                            //Add to the csv a single line of text
                            //$this->exportCSV(array('POSTS WITH FILTER:'), null, false);
                            //Add to the csv a single model data with 3 empty rows after the data
                            //$this->exportCSV($model, array_keys($model->attributeLabels()), false, 3);
                            //Add to the csv a lot of models from a CDataProvider
                            $this->exportCSV($model->search(), array('id', 'REFNO', 'invoice_date','party_id','total_tax_1','total_amount'));
                        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPrintPDF($id)
	{
                # You can easily override default constructor's params
                $mPDF1 = Yii::app()->ePdf->mpdf();

                $itemsDataProvider= new CActiveDataProvider('Moduledescription',
                        array(
                            'criteria'=>array(
                                'condition'=>'invoice_id=:invoiceid AND isActive=1',
                                'params'=>array(':invoiceid'=>  $id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
                     
                $statusDataProvider = new CActiveDataProvider('Modulestatus',
                            array(
                                'criteria'=>array(
                                    'condition'=>'invoice_id=:invoiceid',
                                    'params'=>array(':invoiceid'=>  $id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                # Load a stylesheet
                $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
                $mPDF1->WriteHTML($stylesheet, 1);

                $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/screen.css');
                $mPDF1->WriteHTML($stylesheet, 1);
                
                $mPDF1->debug = true;
                $mPDF1->WriteHTML($this->renderPartial('stub',array(
                            'model'=>$this->loadModel($id),
                            'itemsDataProvider' => $itemsDataProvider,
                            'statusDataProvider' => $statusDataProvider,
                            ),true));

                $mPDF1->Output();
                exit;
            
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Invoice the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Invoice $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
	 * Performs the export to excel functionality .
	 * @param none
	 */
        public function behaviors() {
            return array(
                'exportableGrid' => array(
                    'class' => 'application.components.ExportableGridBehavior',
                    'filename' => 'invoices.csv',
                    'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
                    ));
        }
}
