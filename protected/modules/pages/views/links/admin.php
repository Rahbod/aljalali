<?php
/* @var $this PagesManageController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'مدیریت',
);
$template = '{update}{delete}';
?>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">مدیریت لینک ها</h3>
        <?= CHtml::link('افزودن لینک',array('create'),array('class' => 'btn btn-sm btn-default')); ?>
	</div>
	<div class="box-body">
		<?php $this->renderPartial("//partial-views/_flashMessage"); ?>
		<div class="table-responsive">
		<?php $this->widget('ext.yiiSortableModel.widgets.SortableCGridView', array(
            'orderField' => 'order',
            'idField' => 'id',
            'orderUrl' => 'order',
            'jqueryUiSortableOptions' => array('handle' => '.sortable-handle'),
			'id'=>'pages-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-hover',
			'template' => '{items} {pager}',
			'ajaxUpdate' => true,
			'afterAjaxUpdate' => "function(id, data){
                    $('html, body').animate({
                    scrollTop: ($('#'+id).offset().top-130)
                    },1000,'easeOutCubic');
                }",
			'pager' => array(
				'header' => '',
				'firstPageLabel' => '<<',
				'lastPageLabel' => '>>',
				'prevPageLabel' => '<',
				'nextPageLabel' => '>',
				'cssFile' => false,
				'htmlOptions' => array(
					'class' => 'pagination pagination-sm',
				),
			),
			'pagerCssClass' => 'blank',
			'columns'=> array(
                ['class'=>'SortableGridColumn'],
                'title',
                'link',
                array(
                    'class'=>'CButtonColumn',
                    'template' => $template,
                )
            )
		)); ?>
		</div>
	</div>
</div>
