<?php
/* @var $this PagesManageController */
/* @var $model Pages */
$this->breadcrumbs=array(
	'مدیریت'=>array('admin'),
	'ویرایش',
);
?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ویرایش لینک <?php echo $model->title; ?></h3>
        </div>
        <div class="box-body">
            <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
    </div>