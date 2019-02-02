<?php
/* @var $this Controller*/
$controller = $this->action->controller->id;
$module = $this->action->controller->module?$this->action->controller->module->id:null;
$action = $this->action->id;

$inner = false;
if($module == 'pages')
    $inner = true;
?>
<div class="top-section <?= $inner?'inner':'' ?>">
    <div class="container">
        <div class="header">
            <div class="aya hidden-xs"></div>
<!--            <div class="search-container">-->
<!--                <div class="input-group">-->
<!--                    <input type="text" class="form-control" placeholder="بحث">-->
<!--                    <div class="input-group-btn">-->
<!--                        <button class="btn btn-default" type="submit"><i class="search-icon"></i></button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="person-pic hidden-xs"></div>
            <div class="name-pic hidden-xs"><a href="<?= Yii::app()->getBaseUrl(true) ?>"></a></div><div class="menu hidden-xs">
                <ul>
                    <li<?= $controller=='site' && $action=='index'?' class="active"':'' ?>><a href="<?= Yii::app()->getBaseUrl(true)?>">الرئيسية</a></li>
                    <?php $menus = Pages::getPages('menu', 'parent_id IS NULL'); ?>
                    <?php foreach ($menus as $menu): ?>
                        <li class="dropdown<?= $module=='pages' && $action=='view' && isset($_GET['id']) && $_GET['id']==$menu->id?' active':'' ?>">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?= $menu->title ?></a>
                            <ul class="dropdown-menu">
                                <?php $submenus = Pages::getPages('menu', 'parent_id = :id', [':id' => $menu->id]);
                                foreach ($submenus as $submenu): ?>
                                <li><a href="<?= $submenu->url ?>"><?= $submenu->title ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>


        <div class="menu-container on-top">
            <div class="container">
                <div class="name-pic"><a href="<?= Yii::app()->getBaseUrl(true) ?>"></a></div>
                <div class="mobile-menu-trigger visible-xs"></div>
                <div class="overlay"></div>
                <div class="menu">
                    <ul>
                        <li<?= $controller=='site' && $action=='index'?' class="active"':'' ?>><a href="<?= Yii::app()->getBaseUrl(true)?>">الرئيسية</a></li>
                        <?php foreach ($menus as $menu): ?>
                            <li class="dropdown<?= $module=='pages' && $action=='view' && isset($_GET['id']) && $_GET['id']==$menu->id?' active':'' ?>">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?= $menu->title ?></a>
                                <ul class="dropdown-menu">
                                    <?php $submenus = Pages::getPages('menu', 'parent_id = :id', [':id' => $menu->id]);
                                    foreach ($submenus as $submenu): ?>
                                        <li><a href="<?= $submenu->url ?>"><?= $submenu->title ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>

        <?php if(!$inner):
            $baseUrl = Yii::app()->theme->baseUrl;
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile($baseUrl.'/css/owl.carousel.min.css');
            $cs->registerCssFile($baseUrl.'/css/owl.theme.default.min.css');
            $cs->registerScriptFile($baseUrl.'/js/owl.carousel.min.js', CClientScript::POS_END);
            ?>
            <div class="slider owl-carousel owl-theme">
                <?php foreach (Slideshow::getSlides() as $slide):
                    if($slide->image and is_file(Yii::getPathOfAlias('webroot').'/uploads/slideshow/'.$slide->image)):
                    ?>
                    <div class="slide-item">
                        <div class="image-container">
                            <div class="image-outer-align">
                                <div class="image-inner-align">
                                    <img src="<?= Yii::app()->getBaseUrl(true).'/uploads/slideshow/'.$slide->image ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;endforeach;?>
            </div>
        <?php endif; ?>
    </div>
</div>