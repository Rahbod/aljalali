<?php
/* @var $this MarqueeManageController */
/* @var $model Marquee */

$this->breadcrumbs=array(
	'مدیریت'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'ویرایش',
);

$this->menu=array(
	array('label'=>'افزودن', 'url'=>array('create')),
    array('label'=>'مدیریت', 'url'=>array('admin')),
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">ویرایش جمله "<?php echo $model->text; ?>"</h3>
    </div>
    <div class="box-body">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>