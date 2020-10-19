<?php
/* @var $this MarqueeManageController */
/* @var $model Marquee */

$this->breadcrumbs=array(
	'مدیریت'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'لیست Marquee', 'url'=>array('index')),
	array('label'=>'افزودن Marquee', 'url'=>array('create')),
	array('label'=>'ویرایش Marquee', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف Marquee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'مدیریت Marquee', 'url'=>array('admin')),
);
?>

<h1>نمایش Marquee #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'text',
		'status',
		'sort',
	),
)); ?>
