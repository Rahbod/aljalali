<?php
/**
 * @var $this Controller
 * @var $cs CClientScript
 * @var $baseUrl string
 */
?>
<?php $videoCategories = VideoCategories::getAll();?>
<?php if($videoCategories):?>
    <div class="video-gallery-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <h2>المرئیات</h2>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 left-side">
                    <ul class="nav nav-pills gallery-nav text-right">
                    <?php $i=0;foreach ($videoCategories as $category):$i++; ?>
                        <li<?= $i==1?' class="active"':'' ?>><a href="#" data-toggle="tab" data-target="#category-<?= $category->id ?>"><?= $category->title ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                    <div class="tab-content text-right">
                        <?php $i=0;foreach ($videoCategories as $category):$i++; ?>
                            <div class="tab-pane fade <?= $i==1?'active in':''?>" id="category-<?= $category->id ?>">
                                <div class="video-list owl-carousel owl-theme" data-items="1" data-nav="true" data-rtl="true" data-dots="false">
                                    <?foreach ($category->videos as $video):?>
                                        <?php if(!empty($video->file)):?>
                                            <div class="video-item">
                                                <video controls src="<?php echo '/uploads/videos/'.$video->file?>" style="width: 100%;"></video>
                                                <h4><?php echo $video->title?><small><?php echo $video->place . ($video->date ? ' - '.$video->date : '')?></small></h4>
                                            </div>
                                        <?php else:?>
                                            <div class="video-item">
                                                <div class="embed-code"><?php echo $video->embed;?></div>
                                                <h4><?php echo $video->title?><small><?php echo $video->place . ($video->date ? ' - '.$video->date : '')?></small></h4>
                                            </div>
                                        <?php endif;?>
                                    <?endforeach;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?php echo $this->createUrl('/video/archive')?>" class="archive-link">الأرشیف</a>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<div class="about-section">
    <div class="container">
        <h2>حول الشهيد <small class="inline-block">(قدس سرّه الشريف)</small><small>ولد ١٣٥٥ هجري - استشهد ١٤٠۲ هجري</small></h2>
        <div class="row">
            <?php $abouts = Pages::getPages('menu', 'parent_id IS NULL and in_about = 1'); ?>
            <?php foreach ($abouts as $item): ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-item">
                    <div class="content">
                        <h4><?= $item->title ?></h4>
                        <ul>
                            <?php $sub = Pages::getPages('menu', 'parent_id = :pid', [':pid' => $item->id]); ?>
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
        <h2>معالمٌ بإسم الشهيد<small>السید محمد التقی الحسیني الجلالي</small></h2>
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
                <video width="320" height="240" controls preload="none" poster="<?= Yii::app()->getBaseUrl(true).'/themes/frontend/images/video-poster.jpg' ?>">
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
            <h2>لمحات من حياة الشهيد الجلالي <span>(قدس سره)</span><small>قناة كربلاء الفضائية</small></h2>
        </div>
    </div>
</div>