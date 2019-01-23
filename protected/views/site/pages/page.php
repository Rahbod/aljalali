<?php
/* @var $this SiteController */
/* @var $model Pages */
?>

<div class="context">
    <div class="container"><?php
        $purifier=new CHtmlPurifier();
        echo $purifier->purify($model->summary);
        ?></div>
</div>