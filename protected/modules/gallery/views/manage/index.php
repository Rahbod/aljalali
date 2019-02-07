<?php
/* @var $this GalleryManageController */
/* @var $dataProvider CActiveDataProvider */
/* @var $categories GalleryCategories[] */
/* @var $cs CClientScript */
$categories = GalleryCategories::model()->findAll(array('order' => 't.order'));
$this->breadcrumbs=array(
	'Galleries',
);

$this->menu=array(
	array('label'=>'افزودن ', 'url'=>array('create')),
	array('label'=>'مدیریت ', 'url'=>array('admin')),
);
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->clientScript;
$cs->registerCssFile($baseUrl.'/css/lightbox.min.css');
$cs->registerScriptFile($baseUrl.'/js/lightbox.min.js', CClientScript::POS_END);
?>

<div class="context">
    <div class="container text-center">
        <div class="page-title"><h3 class="text-right">حلق الصور</h3></div>
        <div class="clearfix"></div>
        <div class="page-text" style="width: 100%;overflow: visible">
            <ul class="nav nav-pills gallery-nav text-right">
            <?php $i=0;foreach ($categories as $category):$i++; ?>
                <li<?= $i==1?' class="active"':'' ?>><a href="#" data-toggle="tab" data-target="#category-<?= $category->id ?>"><?= $category->title ?></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="tab-content  text-right">
                <?php $i=0;foreach ($categories as $category):$i++; ?>
                    <div class="tab-pane gallery-list fade <?= $i==1?'active in':''?>" id="category-<?= $category->id ?>">
                        <?foreach ($category->items as $item):
                            if(!$item->image|| !is_file(Yii::getPathOfAlias('webroot')."/{$this->imagePath}/{$item->image}")) continue;?>
                        <div class="gallery-item">
                            <a href="<?= Yii::app()->getBaseUrl(true)."/{$this->imagePath}/{$item->image}" ?>"
                               data-lightbox="gallery-<?= $category->id ?>"
                               data-title="<?= $item->title ?>">
                                <div class="gallery-image">
                                    <img src="<?= Yii::app()->getBaseUrl(true)."/{$this->imagePath}/thumbs/200x200/{$item->image}" ?>" alt="<?= $item->title ?>" width="192px" height="192px">
                                </div>
                                <div class="gallery-title"><?= $item->title ?></div>
                                <div class="gallery-overlay"></div>
                                <div class="gallery-description hidden"><?= $item->description ?></div>
                            </a>
                        </div>
                        <?endforeach;?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>