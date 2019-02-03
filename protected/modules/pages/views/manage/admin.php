<?php
/* @var $this PagesManageController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'مدیریت',
);
$template = '{update}{delete}';
if($this->categorySlug == 'services')
    $template = '{update}';

$columns = array(
    ['class'=>'SortableGridColumn'],
    'title',
    array(
        'name' => 'parent_id',
        'value' => '$data->parent->title',
        'filter' => CHtml::listData(Pages::model()->findAll('category_id = :id and parent_id IS NULL',[':id' => $this->categoryId]),'id', 'title')
    ),
    array(
        'class'=>'CButtonColumn',
        'template' => $template,
        'buttons' => array(
            'delete' => array(
                'visible' => '$data->category_id !=2 || ($data->category_id ==2 and $data->parent_id != NULL)'
            )
        )
    )
);
if(isset($_GET['parent']) || $this->categoryId == 3)
    $columns= array(
        ['class'=>'SortableGridColumn'],
        'title',
        array(
            'class'=>'CButtonColumn',
            'template' => $template,
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->controller->createUrl("/pages/manage/update/?id=$data->id&parent=true")'
                )
            )
        )
    );
?>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">مدیریت <?= $this->categoryName ?></h3>
        <?php
        if($this->categorySlug == 'menu') {
            if(isset($_GET['parent']))
                echo CHtml::link('افزودن منو جدید', array('manage/create/slug/menu?parent=true'), array('class' => 'btn btn-sm btn-default'));
            else
                echo CHtml::link('افزودن زیر منو جدید', array('manage/create/slug/menu'), array('class' => 'btn btn-sm btn-default'));
        }
        if($this->categorySlug == 'about')
            echo CHtml::link('افزودن متن درباره جدید',array('manage/create/slug/about'),array('class' => 'btn btn-sm btn-default'));
        ?>
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
			'columns'=>$columns
		)); ?>
		</div>
	</div>
</div>
