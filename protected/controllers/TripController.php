<?php

class TripController extends Controller
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
				'actions'=>array('create','update','admin','createFromJob','addJobs','generateTripsheet'),
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
		$model=new Trip;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Trip']))
		{
			$model->attributes=$_POST['Trip'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));                            
                        }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Creates a new model and associates with a job.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateFromJob($jobID)
	{
		$model=new Trip;
                $model->job_id = $jobID;
                $model->transporter_id = Job::model()->findbyPk($jobID)->transporter;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Trip']))
		{
			$model->attributes=$_POST['Trip'];
			if($model->save()) {
                            $tripjob = new Tripjob;
                            $tripjob->job_id = $jobID;
                            $tripjob->trip_id = $model->id;
                            $tripjob->save();
				$this->redirect(array('job/view','id'=>$jobID));                            
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

		if(isset($_POST['Trip']))
		{
			$model->attributes=$_POST['Trip'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a Tripjob model - associates multiple jobs to a trip.
	 * If update is successful, the browser will be redirected to the job 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAddJobs($id)
	{
		$model=$this->loadModel($id);
                $addJobsDataProvider = new CActiveDataProvider('Job',
                            array(
                                'criteria'=>array(
                                    'condition'=>'type="DOMESTIC" and isActive=1 and id not in (select job_id from tripjob where trip_id = :tripID)',
                                    'params'=>array(':tripID'=>  $id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
                $removeJobsDataProvider = new CActiveDataProvider('Job',
                            array(
                                'criteria'=>array(
                                    'condition'=>'type="DOMESTIC" and isActive=1 and id in (select job_id from tripjob where trip_id = :tripID)',
                                    'params'=>array(':tripID'=>  $id),
                                ),
                                'pagination'=>array(
                                    'pageSize'=>15,
                                )
                            )
                        );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                if(isset($_POST['addJobs']) || isset($_POST['removeJobs']))
                {
                    if(isset($_POST['addJobs']))
                    {
                        foreach ($_POST['addJobs'] as $jobID) {
                            $tripjob = new Tripjob;
                            $tripjob->job_id = $jobID;
                            $tripjob->trip_id = $id;
                            
                            $tripjob->save();
                        }                           
                    } 
                    if(isset($_POST['removeJobs']))
                    {
                        foreach ($_POST['removeJobs'] as $jobID) {
                            $tripjobCriteria = new CDbCriteria;
                            $tripjobCriteria->condition = 'trip_id=:tripID and job_id=:jobID';
                            $tripjobCriteria->params = array(':tripID'=> $id, ':jobID'=> $jobID);
                            $tripjob = Tripjob::model()->find($tripjobCriteria);
                            
                            $tripjob->delete();
                        }                           
                    }
                    $this->redirect(array('view','id'=>$id));
                }
		$this->render('addJobs',array(
			'model'=>$model,
                        'addJobsDataProvider'=>$addJobsDataProvider,
                        'removeJobsDataProvider'=>$removeJobsDataProvider,
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
//		$dataProvider=new CActiveDataProvider('Trip');
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
		$model=new Trip('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trip']))
			$model->attributes=$_GET['Trip'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        /**
	 * Generates a PDF for printing a Work Order
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGenerateTripsheet($id)
	{
                # You can easily override default constructor's params
                $mPDF1 = Yii::app()->ePdf->mpdf();
                $model = $this->loadModel($id);
                $jobsDataProvider= new CActiveDataProvider('Job');
                $jobsDataProvider->setData($model->jobs);
                $packagesDataProvider= new CActiveDataProvider('Package',
                            array(
                                'criteria'=>array(
                                    'condition'=>'job_id in (select job_id from tripjob where trip_id=:tripID)',
                                    'params'=>array(':tripID'=>$id),
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
                            'model'=>$model,
                            'jobsDataProvider' => $jobsDataProvider,
                            'packagesDataProvider'=> $packagesDataProvider,
                            ),true));

                $mPDF1->Output();
                exit;
            
	}        
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Trip the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Trip::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Trip $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trip-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
