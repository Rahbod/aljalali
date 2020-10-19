<?php
/* @var $this VideoArchiveController */
/* @var $dataProvider CActiveDataProvider */
/* @var $categories VideoCategories[] */
/* @var $cs CClientScript */
$categories = VideoCategories::model()->findAll(array('order' => 't.order'));
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->clientScript;
?>

<div class="context">
    <div class="container text-center">
        <div class="page-title"><h3 class="text-right">حقل الصور</h3></div>
        <div class="clearfix"></div>
        <div class="page-text" style="max-width:1000px;width: 100%;overflow: visible">
            <ul class="nav nav-pills gallery-nav text-right">
            <?php $i=0;foreach ($categories as $category):$i++; ?>
                <li<?= $i==1?' class="active"':'' ?>><a href="#" data-toggle="tab" data-target="#category-<?= $category->id ?>"><?= $category->title ?></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="tab-content  text-right">
                <?php $i=0;foreach ($categories as $category):$i++; ?>
                    <div class="tab-pane fade <?= $i==1?'active in':''?>" id="category-<?= $category->id ?>">
                        <div class="video-gallery-list row">
                            <?foreach ($category->videos as $video):?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 video-item">
                                    <div class="embed-code"><?php echo $video->embed;?></div>
                                    <h4><?php echo $video->title?><small><?php echo $video->place . ($video->date ? ' - '.$video->date : '')?></small></h4>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>