<?php

class JobController extends Controller
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
                $voucherDataProvider= new CActiveDataProvider('Voucher',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );     
                $tasksDataProvider = new CActiveDataProvider('Task',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                     
                $statusDataProvider = new CActiveDataProvider('Modulestatus',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                $invoiceDataProvider = new CActiveDataProvider('Invoice',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId and is_active=1',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                $contrsDataProvider= new CActiveDataProvider('Package',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id=:jobId',
                                    'params'=>array(':jobId'=>  $this->loadModel($id)->id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                $this->render('view',array(
			'model'=>$this->loadModel($id),
                        'voucherDataProvider'=>$voucherDataProvider,
                        'tasksDataProvider'=>$tasksDataProvider,
                        'statusDataProvider'=>$statusDataProvider,
                        'invoiceDataProvider'=>$invoiceDataProvider,
                        'contrsDataProvider'=>$contrsDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Job;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $branchesDataProvider = CHtml::listData(Yii::app()->session['branches'],'id','branch_name');
                $model->REFNO = Job::model()->createJobREF();
                $model->init_date = date('Y-m-d');

		if(isset($_POST['Job']))
		{
			$model->attributes=$_POST['Job'];
                        $model->quote_id=1; // dummy values till the quote module is ready
			if($model->save())
                        {
                                $statusModel = new Modulestatus;
                                $statusModel->job_id = $model->id;
                                $statusModel->status = 'Created';
                                $statusModel->comments = 'Created';
                                $statusModel->save();
				$this->redirect(array('view','id'=>$model->id));
                        }
                        
		}

		$this->render('create',array(
			'model'=>$model,
                        'branchesDataProvider'=>$branchesDataProvider,
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
                $branchesDataProvider = CHtml::listData(Yii::app()->session['branches'],'id','branch_name');

		if(isset($_POST['Job']))
		{
			$model->attributes=$_POST['Job'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                $formName = isset($_GET['formName'])?$_GET['formName']:'';
		$this->render('update',array(
			'model'=>$model,
                        'branchesDataProvider'=>$branchesDataProvider,
                        'formName'=>$formName,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                // instead of deleting jobs, they are just made inactive for easier recovery later
		$this->loadModel($id)->isActive = false;

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//		$dataProvider=new CActiveDataProvider('Job');
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
		$model=new Job('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Job']))
			$model->attributes=$_GET['Job'];
                $accessibileBranches = array();
                foreach(Yii::app()->session['branches'] as $branch)
                    $accessibileBranches[] = $branch->id;

		$model->branch_id= $accessibileBranches;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Job the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Job::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Job $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='job-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
