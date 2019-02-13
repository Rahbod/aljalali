<?php

class MediaManageController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $folderMedia = "uploads/media";


    /**
     * @return array actions type list
     */
    public static function actionsType()
    {
        return array(
            'backend' => array(
                'index', 'upload', 'deleteUpload'
            )
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'checkAccess', // perform access control for CRUD operations
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $fld = Yii::getPathOfAlias('webroot') . "/$this->folderMedia";
        if (!is_dir($fld)) mkdir($fld, 0755, true);
        $content = scandir($fld);
        unset($content[0]);
        unset($content[1]);

        $files = [];
        foreach ($content as $file) {
            $files[$file] = filemtime($fld . '/' . $file);
        }
        arsort($files);
        $content = array_keys($files);
        $this->render('index', compact('content'));
    }

    public function actionUpload()
    {
        $tempDir = Yii::getPathOfAlias("webroot") . '/uploads/media/';

        if (!is_dir($tempDir))
            mkdir($tempDir, 0755, true);
        if (isset($_FILES)) {
            $file = $_FILES['image'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file['name'] = Controller::generateRandomString(5) . time();
            while (is_file($tempDir . DIRECTORY_SEPARATOR . $file['name']))
                $file['name'] = Controller::generateRandomString(5) . time();
            $file['name'] = $file['name'] . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $tempDir . DIRECTORY_SEPARATOR . CHtml::encode($file['name']))) {
                Yii::app()->user->setFlash('success', 'تصویر با موفقیت اضافه شد.');
                $response = ['status' => true, 'fileName' => CHtml::encode($file['name'])];
            } else
                $response = ['status' => false, 'msg' => 'فایل آپلود نشد.'];
        } else
            $response = ['status' => false, 'msg' => 'فایلی ارسال نشده است.'];
        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function actionDeleteUpload()
    {
        $Dir = Yii::getPathOfAlias("webroot") . '/uploads/media/';
        if (isset($_POST['fileName'])) {
            $fileName = $_POST['fileName'];
            @unlink($Dir . $fileName);

            if (!Yii::app()->request->isAjaxRequest) {
                Yii::app()->user->setFlash('success', 'تصویر با موفقیت حذف شد.');
                $this->redirect(array('/media/manage'));
            }

            $response = ['status' => true, 'msg' => 'حذف شد.'];
            echo CJSON::encode($response);
            Yii::app()->end();
        }
    }
}