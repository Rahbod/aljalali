<?php
/* @var $this GalleryManageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Galleries',
);

$this->menu=array(
	array('label'=>'افزودن ', 'url'=>array('create')),
	array('label'=>'مدیریت ', 'url'=>array('admin')),
);
?>

<h1>Galleries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
