<?php
/**
 * @var $this Controller
 * @var $cs CClientScript
 * @var $baseUrl string
 */
?>
<div class="about-section">
    <div class="container">
        <h2>عن الشهید<small>السید محمد تقی الحسینی الجلالی</small></h2>
        <div class="row">
            <?php $abouts = Pages::getPages('about', 'parent_id IS NULL'); ?>
            <?php foreach ($abouts as $item): ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-item">
                    <div class="content">
                        <h4><?= $item->title ?></h4>
                        <ul>
                            <?php $sub = Pages::getPages('about', 'parent_id = :pid', [':pid' => $item->id]); ?>
                            <?php foreach ($sub as $page): ?>
                                <li><a href="<?= $page->url ?>">- <?= $page->title ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<div class="services-section">
    <div class="container">
        <h2>خدمات الشهید<small>السید محمد تقی الحسینی الجلالی</small></h2>
        <div class="row">
            <?php $services = Pages::getPages('services'); ?>
            <?php foreach ($services as $item): ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 service-item">
                    <div class="content">
                        <a href="<?= $item->url ?>">
                            <h4><?= $item->title ?></h4>
                            <div class="cover">
                                <div class="image-container">
                                    <div class="image-outer-align">
                                        <div class="image-inner-align">
                                            <?php if($item->image and is_file(Yii::getPathOfAlias('webroot').'/uploads/pages/'.$item->image)): ?>
                                                <img src="<?= Yii::app()->getBaseUrl(true).'/uploads/pages/'.$item->image ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<div class="video-section">
    <div class="container">
        <div class="video-container">
            <?php $video = SiteSetting::getOption('footer_video');
            if($video and is_file(Yii::getPathOfAlias('webroot').'/uploads/setting/'.$video)): ?>
                <video width="320" height="240" controls preload="none">
                    <source src="<?= Yii::app()->getBaseUrl(true).'/uploads/setting/'.$video ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        </div>
        <div class="title-container">
            <?php
            $logo = SiteSetting::getOption('footer_logo');
            if($logo and is_file(Yii::getPathOfAlias('webroot').'/uploads/setting/'.$logo)): ?>
                <img src="<?= Yii::app()->getBaseUrl(true).'/uploads/setting/'.$logo ?>" class="hidden-xs">
            <?php endif; ?>
            <h2>لمعات من حياة الشهيد الجلالي <span>(قدس سره)</span><small>قناة كربلاء الفضائية</small></h2>
        </div>
    </div>
</div>