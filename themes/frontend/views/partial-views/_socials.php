<?php
$scl = SiteSetting::getOption('social_links')?:null;
if($scl):
    $scl = CJSON::decode($scl);
    $in = isset($scl['instagram'])?$scl['instagram']:false;
    $fb = isset($scl['facebook'])?$scl['facebook']:false;
    $gl = isset($scl['google'])?$scl['google']:false;
    $tw = isset($scl['twitter'])?$scl['twitter']:false;
    ?>
    <?php if($in): ?><a target="_blank" href="<?= $in; ?>" class="icon instagram-icon"></a><?php endif; ?>
    <?php if($fb): ?><a target="_blank" href="<?= $fb; ?>" class="icon facebook-icon"></a><?php endif; ?>
    <?php if($gl): ?><a target="_blank" href="<?= $gl; ?>" class="icon google-icon"></a><?php endif; ?>
    <?php if($tw): ?><a target="_blank" href="<?= $tw; ?>" class="icon twitter-icon"></a><?php endif; ?>
<?php
endif;