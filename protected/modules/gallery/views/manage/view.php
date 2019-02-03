<?php
/* @var $this GalleryManageController */
/* @var $model Gallery */

$this->breadcrumbs=array(
	'مدیریت'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'لیست Gallery', 'url'=>array('index')),
	array('label'=>'افزودن Gallery', 'url'=>array('create')),
	array('label'=>'ویرایش Gallery', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف Gallery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'مدیریت Gallery', 'url'=>array('admin')),
);
?>

<h1>نمایش Gallery #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'category_id',
		'image',
		'order',
	),
)); ?>
