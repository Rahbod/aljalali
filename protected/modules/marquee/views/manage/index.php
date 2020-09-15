<?php
/* @var $this MarqueeManageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Marquees',
);

$this->menu=array(
	array('label'=>'افزودن ', 'url'=>array('create')),
	array('label'=>'مدیریت ', 'url'=>array('admin')),
);
?>

<h1>Marquees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
