<?php

class WorkorderController extends RController
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','generateTransportWO', 'sendMail','editPackages'),
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
	 * Displays the packages to be added to a WO
	 * @param integer $job_id the  JOB ID of the job for which the packages are to be fetched
	 */
        public function actionEditPackages($job_id,$wo_id)
        {
                $contrsDataProvider= new CActiveDataProvider('Package',
                    array(
                        'criteria'=>array(
                            'condition'=>'job_id=:jobId and id not in (select package_id from workorderpackage where workorder_id=:woId)',
                            'params'=>array(':jobId'=>  $job_id,':woId'=>$wo_id),
                        ),
                        'pagination'=>array(
                            'pageSize'=>15,
                        )
                    )
                );
                $existingPackagesDataProvider= new CActiveDataProvider('Package',
                    array(
                        'criteria'=>array(
                            'condition'=>'job_id=:jobId and id in (select package_id from workorderpackage where workorder_id=:woId)',
                            'params'=>array(':jobId'=>  $job_id,':woId'=>$wo_id),
                        ),
                        'pagination'=>array(
                            'pageSize'=>15,
                        )
                    )
                );
                if (isset($_POST['selectedContrs']) || isset($_POST['selectedPackages']) || isset($_POST['removedContrs']) || isset($_POST['removedPackages'])) {
                    if(isset($_POST['selectedContrs']))
                    {
                            $criteria = new CDbCriteria;
                            $criteria->addInCondition('id' ,$_POST['selectedContrs'] );
                            $model = Package::model()->findAll($criteria);
                            foreach ($model as $value) {
                                $wopkg = new Workorderpackage;
                                $wopkg->workorder_id = $wo_id;
                                $wopkg->package_id = $value->id;
                                $wopkg->save();
                            }                           
                    }
                    if(isset($_POST['selectedPackages']))
                    {
                            $criteria = new CDbCriteria;
                            $criteria->addInCondition('id' ,$_POST['selectedPackages']);
                            $model = Package::model()->findAll($criteria);
                            foreach ($model as $value) {
                                $wopkg = new Workorderpackage;
                                $wopkg->workorder_id = $wo_id;
                                $wopkg->package_id = $value->id;
                                $wopkg->save();
                            }                           
                    }                
                    if(isset($_POST['removedContrs']))
                    {
                            $criteria = new CDbCriteria;
                            $criteria->addInCondition('id' ,$_POST['removedContrs'] );
                            $model = Package::model()->findAll($criteria);
                            foreach ($model as $value) {
                                //update Order`s Status
                                $value->wo_id = null;
                                $value->update();
                            }                           
                    }
                    if(isset($_POST['removedPackages']))
                    {
                            $criteria = new CDbCriteria;
                            $criteria->addInCondition('id' ,$_POST['removedPackages']);
                            $model = Package::model()->findAll($criteria);
                            foreach ($model as $value) {
                                //update Order`s Status
                                $value->wo_id = null;
                                $value->update();
                            }                           
                    }                
                    $this->redirect(array('job/view','id'=>$job_id));
                }
                $this->render('packages',array(
			'model'=>Job::model()->findByPk($job_id),
                        'contrsDataProvider'=>$contrsDataProvider,
                        'existingPackagesDataProvider'=>$existingPackagesDataProvider,
		));

        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Workorder;
                if(isset($_GET['jobID'])) {
                    $model->job_id = $_GET['jobID'];
                }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Workorder']))
		{
			$model->attributes=$_POST['Workorder'];
			if($model->save())
				$this->redirect(array('job/view','id'=>$model->job_id));
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

		if(isset($_POST['Workorder']))
		{
			$model->attributes=$_POST['Workorder'];
			if($model->save())
				$this->redirect(array('job/view','id'=>$model->job_id));
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
	 * Sends a new WO as mail to righteous
	 */
        
        public function actionSendMail($id)
        {   
                $message            = new YiiMailMessage;
                //this points to the file test.php inside the view path
                //$message->view = "test";
                $body = "<body>Dear Sir, <br/> Please find attd the Work order for your kind perusal. <br/> <br/> Best Regards,<br/></body>".Yii::app()->name;
                $message->subject    = 'Workorder '.$id;
                $message->setBody($body, 'text/html');                
                $message->addTo('vinothraja@righteous.in');
                $message->from = 'info@righteous.in';   

                //For attaching the work order - begin
                $mPDF1 = Yii::app()->ePdf->mpdf();

                $itemsDataProvider= new CActiveDataProvider('Job',
                        array(
                            'criteria'=>array(
                                'condition'=>'job_id=:jobID AND isActive=1',
                                'params'=>array(':jobID'=>  $this->id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
                $packagesDataProvider= new CActiveDataProvider('Package',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId',
                                    'params'=>array(':jobId'=>  $this->id),
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
                            'packagesDataProvider'=> $packagesDataProvider,
                            ),true));

                $mPDF1->Output(Yii::app()->basePath."/pdf/wo.pdf", 'F' );
                $file_path = Yii::app()->basePath."/pdf/wo.pdf";       

                $swiftAttachment = Swift_Attachment::fromPath($file_path);              
                $message->attach($swiftAttachment);
                //For attaching the work order - end               

                Yii::app()->mail->send($message);       
        }        
        /**
	 * Generates a PDF for printing a Work Order
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGenerateTransportWO($id)
	{
                # You can easily override default constructor's params
                $mPDF1 = Yii::app()->ePdf->mpdf();

                $itemsDataProvider= new CActiveDataProvider('Job',
                        array(
                            'criteria'=>array(
                                'condition'=>'job_id=:jobID AND isActive=1',
                                'params'=>array(':jobID'=>  $this->loadModel($id)->job_id),
                            ),
                            'pagination'=>array(
                                'pageSize'=>15,
                            )
                        )
                    );
                $packagesDataProvider= new CActiveDataProvider('Package',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId and id in (select package_id from workorderpackage where workorder_id=:woId)',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->job_id,':woId'=>$id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                $paymentsDataProvider= new CActiveDataProvider('Payment',
                            array(
                                'criteria'=>array(
                                    'condition'=>'id in (select payment_id from voucherpayment where voucher_id in ( select id from voucher where wo_id=:woId ))',
                                    'params'=>array(':woId'=>$id),
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
                            'packagesDataProvider'=> $packagesDataProvider,
                            'paymentsDataProvider'=> $paymentsDataProvider,
                            ),true));

                $mPDF1->Output();
                exit;
            
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Workorder');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Workorder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Workorder']))
			$model->attributes=$_GET['Workorder'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Workorder the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Workorder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Workorder $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='workorder-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
