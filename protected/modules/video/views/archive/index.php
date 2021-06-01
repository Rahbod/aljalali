<?php
/* @var $this VideoArchiveController */
/* @var $yearsDataProvider CActiveDataProvider */
/* @var $categories VideoCategories[] */
/* @var $cs CClientScript */
$categories = VideoCategories::model()->findAll(array('order' => 't.order'));
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->clientScript;
?>

<div class="context">
    <div class="container text-center">
        <div class="page-title" style="max-width: none;"><h3 class="text-right">المرئیات</h3></div>
        <div class="clearfix"></div>
        <div class="page-text" style="max-width:1000px;width: 100%;overflow: visible">
            <ul class="nav nav-pills gallery-nav text-right">
            <?php $i=0;foreach ($categories as $category):$i++; ?>
                <li<?= $i==1?' class="active"':'' ?>><a href="#" data-toggle="tab" data-target="#category-<?= $category->id ?>"><?= $category->title ?></a></li>
            <?php endforeach; ?>
            </ul>
            <div class="tab-content  text-right">
                <?php $i=0;foreach ($categories as $category):$i++; ?>
                    <?php if($i == 1):?>
                        <div class="video-filter-container overflow-fix">
                            <div class="col-lg-3"><a href="<?php echo $this->createUrl('/video/archive', ['subcat' => 0])?>" class="btn-filter <?php echo ((isset($_GET['subcat']) and $_GET['subcat'] == 0) ? 'active' : '')?>"><?php echo Video::$subCategories[0]?></a></div>
                            <div class="col-lg-3"><a href="<?php echo $this->createUrl('/video/archive', ['subcat' => 1])?>" class="btn-filter <?php echo ((isset($_GET['subcat']) and $_GET['subcat'] == 1) ? 'active' : '')?>"><?php echo Video::$subCategories[1]?></a></div>
                            <div class="col-lg-3"><a href="<?php echo $this->createUrl('/video/archive', ['subcat' => 2])?>" class="btn-filter <?php echo ((isset($_GET['subcat']) and $_GET['subcat'] == 2) ? 'active' : '')?>"><?php echo Video::$subCategories[2]?></a></div>
                            <div class="col-lg-3">
                                <label for="year-dropdown">سنة:</label>
                                <select id="year-dropdown">
                                    <option value="" disabled>یختار</option>
                                    <?php foreach ($yearsDataProvider->getData() as $year):?>
                                        <option value="<?php echo $year->year?>" <?php if(isset($_GET['year']) and $_GET['year'] == $year->year):?> selected <?php endif?>><?php echo $year->year?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function (){
                                $('#year-dropdown').on('change', function (){
                                    if($(this).val() !== '')
                                        window.location.href = updateQueryStringParameter(window.location.href, 'year', $(this).val());
                                });
                            });

                            function updateQueryStringParameter(uri, key, value) {
                                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                                if (uri.match(re)) {
                                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                                }
                                else {
                                    return uri + separator + key + "=" + value;
                                }
                            }
                        </script>
                    <?php endif;?>
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