<?php
/* @var $this SiteController */
/* @var $model Pages */
?>

<div class="context">
    <div class="container text-center">
        <?php if($model->image and is_file(Yii::getPathOfAlias('webroot').'/uploads/pages/'.$model->image)): ?>
            <div class="page-image">
                <img src="<?= Yii::app()->getBaseUrl(true).'/uploads/pages/'.$model->image ?>" alt="<?=$model->title?>">
            </div>
            <div class="clearfix"></div>
        <?php endif; ?>
        <div class="page-title"><h3 class="text-right"><?= CHtml::encode($model->title) ?></h3></div>
        <div class="clearfix"></div>
        <div class="page-text"><?php
            echo $model->summary;
//            $purifier=new CHtmlPurifier();
//            echo $purifier->purify($model->summary);
            ?></div></div>
</div>