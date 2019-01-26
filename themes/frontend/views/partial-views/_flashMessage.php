<?php
if(!isset($prefix))
    $prefix = '';

if(!isset($class))
    $class = '';
?>

<?php if(Yii::app()->user->hasFlash($prefix.'success')):?>
    <div class="alert alert-success view-flash <?= $class ?>">
        <span><?php echo Yii::app()->user->getFlash($prefix.'success');?></span>
    </div>
<?php elseif(Yii::app()->user->hasFlash($prefix.'failed')):?>
    <div class="alert alert-danger view-flash <?= $class ?>">
        <span><?php echo Yii::app()->user->getFlash($prefix.'failed');?></span>
    </div>
<?php elseif(Yii::app()->user->hasFlash($prefix.'warning')):?>
    <div class="alert alert-warning view-flash <?= $class ?>">
        <span><?php echo Yii::app()->user->getFlash($prefix.'warning');?></span>
    </div>
<?php endif;?>
<?php
Yii::app()->clientScript->registerScript('flash-hide', "
    if($('.abs-alert').find('span').text() !== '')
        $('.abs-alert').addClass('show');
    setTimeout(function(){
        $('.abs-alert').removeClass('show');
    }, 5000);
", CClientScript::POS_READY);