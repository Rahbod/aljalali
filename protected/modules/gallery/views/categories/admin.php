<?php
/* @var $this GalleryCategoriesController */
/* @var $model GalleryCategories */

$this->breadcrumbs=array(
	'مدیریت',
);

$this->menu=array(
	array('label'=>'افزودن GalleryCategories', 'url'=>array('create')),
);
?>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت دسته بندی تصاویر</h3>
        <a href="<?= $this->createUrl('create') ?>" class="btn btn-sm btn-default">افزودن دسته بندی</a>
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
                'columns'=>array(
                    ['class'=>'SortableGridColumn'],
                    'title',
                    array(
                        'class'=>'CButtonColumn',
                        'template' => '{update} {delete}'
                    )
                )
            )); ?>
        </div>
    </div>
</div>