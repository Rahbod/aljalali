<?php

class VideoManageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $filePath = 'uploads/videos';
    public $tempPath = 'uploads/temp';
    public $fileOptions = [];

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
            'checkAccess - upload, deleteUpload, index, captcha'
		);
	}

    /**
     * @return array actions type list
     */
    public static function actionsType()
    {
        return array(
            'frontend'=>array(
                'view',
                'index',
                'captcha',
            ),
            'backend' => array(
                'create',
                'update',
                'admin',
                'delete',
                'order',
                'upload',
                'deleteUpload'
            )
        );
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'order' => array( // ordering models
                'class' => 'ext.yiiSortableModel.actions.AjaxSortingAction',
            ),
            'upload' => array( // list video upload
                'class' => 'ext.dropZoneUploader.actions.AjaxUploadAction',
                'attribute' => 'file',
                'rename' => 'random',
                'validateOptions' => array(
                    'acceptedTypes' => array('mp4')
                )
            ),
            'deleteUpload' => array( // delete list video uploaded
                'class' => 'ext.dropZoneUploader.actions.AjaxDeleteUploadedAction',
                'modelName' => 'Video',
                'attribute' => 'file',
                'uploadDir' => "/$this->filePath/",
                'storedMode' => 'field'
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
		$model=new Video;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Video']))
		{
			$model->attributes=$_POST['Video'];
            $file = new UploadedFiles($this->tempPath, $model->file,$this->fileOptions);
            if($model->save()){
                $file->move($this->filePath);
                Yii::app()->user->setFlash('success' ,'اطلاعات با موفقیت ثبت شد.');
                $this->redirect(array('admin'));
            }else
                Yii::app()->user->setFlash('failed' ,'در ثبت اطلاعات خطایی رخ داده است! لطفا مجددا تلاش کنید.');
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
        $file = new UploadedFiles($this->filePath, $model->file, $this->fileOptions);
		if(isset($_POST['Video']))
		{
            $oldFile= $model->file;
            $model->attributes=$_POST['Video'];
            if($model->save()){
                $file->update($oldFile, $model->file, $this->tempPath);
                Yii::app()->user->setFlash('success' ,'اطلاعات با ویرایش شد.');
                $this->refresh();
            }else
                Yii::app()->user->setFlash('failed' ,'در ویرایش اطلاعات خطایی رخ داده است! لطفا مجددا تلاش کنید.');
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
        $model = $this->loadModel($id);
        $file = new UploadedFiles($this->filePath, $model->file, $this->fileOptions);
        $file->removeAll(true);
        $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    Yii::app()->theme = 'frontend';
	    $this->layout='//layouts/inner';
		$dataProvider=new CActiveDataProvider('Video');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Video('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Video the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Video::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Video $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
