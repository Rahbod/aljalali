<?php

class VideoArchiveController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * @return array actions type list
     */
    public static function actionsType()
    {
        return array(
            'frontend' => array(
                'index',
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        Yii::app()->theme = 'frontend';
        $this->layout = '//layouts/inner';
        $dataProvider = new CActiveDataProvider('Video');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}
