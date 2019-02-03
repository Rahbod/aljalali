<?php
/* @var $this GalleryCategoriesController */
/* @var $model GalleryCategories */

$this->breadcrumbs=array(
	'مدیریت'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'لیست GalleryCategories', 'url'=>array('index')),
	array('label'=>'افزودن GalleryCategories', 'url'=>array('create')),
	array('label'=>'ویرایش GalleryCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'حذف GalleryCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'مدیریت GalleryCategories', 'url'=>array('admin')),
);
?>

<h1>نمایش GalleryCategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'order',
	),
)); ?>
