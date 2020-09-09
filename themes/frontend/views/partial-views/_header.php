<?php
/* @var $this Controller */
$controller = $this->action->controller->id;
$module = $this->action->controller->module ? $this->action->controller->module->id : null;
$action = $this->action->id;

$inner = false;
if ($module)
    $inner = true;
?>
<div class="top-section <?= $inner ? 'inner' : '' ?>">
    <div class="">
        <div class="header">
            <div class="aya hidden-md hidden-sm hidden-xs"></div>
            <!--            <div class="search-container">-->
            <!--                <div class="input-group">-->
            <!--                    <input type="text" class="form-control" placeholder="بحث">-->
            <!--                    <div class="input-group-btn">-->
            <!--                        <button class="btn btn-default" type="submit"><i class="search-icon"></i></button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="person-pic hidden-md hidden-sm hidden-xs"></div>
            <div class="name-pic hidden-md hidden-sm hidden-xs"><a href="<?= Yii::app()->getBaseUrl(true) ?>"></a></div>
            <div class="menu hidden-md hidden-sm hidden-xs">
                <ul>
                    <li<?= $controller == 'site' && $action == 'index' ? ' class="active"' : '' ?>><a
                                href="<?= Yii::app()->getBaseUrl(true) ?>">الرئيسية</a></li>
                    <?php $menus = Pages::getPages('menu', 'parent_id IS NULL'); ?>
                    <?php foreach ($menus as $menu): ?>
                        <li class="dropdown<?= $module == 'pages' && $action == 'view' && isset($_GET['id']) && $_GET['id'] == $menu->id ? ' active' : '' ?>">
                            <?php if (!empty($menu->summary)): ?>
                                <a href="<?= $menu->getUrl() ?>"><?= $menu->title ?></a>
                            <?php else: ?>
                                <a class="dropdown-toggle" href="#menu-sub-<?= $menu->id ?>"
                                   data-toggle="dropdown"><?= $menu->title ?></a>
                                <?php
                                $submenus = Pages::getPages('menu', 'parent_id = :id', [':id' => $menu->id]);
                                if ($submenus):
                                    ?>
                                    <ul class="dropdown-menu" id="menu-sub-<?= $menu->id ?>">
                                        <?php foreach ($submenus as $submenu): ?>
                                            <li><a href="<?= $submenu->url ?>"><?= $submenu->title ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <li class="dropdown<?= $module == 'gallery' ? ' active' : '' ?>">
                        <a class="dropdown-toggle" href="#menu-container-gallery" data-toggle="dropdown">حقل الصور</a>
                        <?php
                        $galleryCategories = GalleryCategories::model()->findAll(array('order' => 't.order'));
                        if ($galleryCategories):
                            ?>
                            <ul class="dropdown-menu pull-right" id="menu-container-gallery">
                                <?php foreach ($galleryCategories as $category): ?>
                                    <li>
                                        <a href="<?= $module == 'gallery' ? "#category-{$category->id}" : $this->createUrl("/gallery#category-{$category->id}") ?>"><?= $category->title ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>


        <div class="menu-container on-top">
            <div class="container-fluid">
                <div class="name-pic"><a href="<?= Yii::app()->getBaseUrl(true) ?>"></a></div>
                <div class="mobile-menu-trigger visible-md visible-sm visible-xs"></div>
                <div class="overlay"></div>
                <div class="menu">
                    <ul>
                        <li<?= $controller == 'site' && $action == 'index' ? ' class="active"' : '' ?>><a
                                    href="<?= Yii::app()->getBaseUrl(true) ?>">الرئيسية</a></li>
                        <?php foreach ($menus as $menu): ?>
                            <li class="dropdown<?= $module == 'pages' && $action == 'view' && isset($_GET['id']) && $_GET['id'] == $menu->id ? ' active' : '' ?>">
                                <?php if (!empty($menu->summary)): ?>
                                    <a href="<?= $menu->getUrl() ?>"><?= $menu->title ?></a>
                                <?php else: ?>
                                    <a class="dropdown-toggle" href="#menu-container-sub-<?= $menu->id ?>"
                                       data-toggle="dropdown"><?= $menu->title ?></a>
                                    <?php
                                    $submenus = Pages::getPages('menu', 'parent_id = :id', [':id' => $menu->id]);
                                    if ($submenus):
                                        ?>
                                        <ul class="dropdown-menu" id="menu-container-sub-<?= $menu->id ?>">
                                            <?php foreach ($submenus as $submenu): ?>
                                                <li><a href="<?= $submenu->url ?>"><?= $submenu->title ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>

                        <li class="dropdown<?= $module == 'gallery' ? ' active' : '' ?>">
                            <a class="dropdown-toggle" href="#menu-container-sub-gallery" data-toggle="dropdown">حقل
                                الصور</a>
                            <?php
                            if ($galleryCategories):
                                ?>
                                <ul class="dropdown-menu pull-right" id="menu-container-sub-gallery">
                                    <?php foreach ($galleryCategories as $category): ?>
                                        <li>
                                            <a href="<?= $module == 'gallery' ? "#category-{$category->id}" : $this->createUrl("/gallery#category-{$category->id}") ?>"><?= $category->title ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (Marquee::model()->count()): ?>
            <div class="vertical-slider">
                <div class="inner">
                    <ul id="js-news" class="js-hidden">
                        <?php foreach (Marquee::model()->findAll(array('order'=>'sort')) as $item): ?>
                            <li class="news-item"><?= $item->text ?><i class="toranj-icon2"></i></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!$inner):
            $baseUrl = Yii::app()->theme->baseUrl;
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile($baseUrl . '/css/owl.carousel.min.css');
            $cs->registerCssFile($baseUrl . '/css/owl.theme.default.min.css');
            $cs->registerScriptFile($baseUrl . '/js/owl.carousel.min.js', CClientScript::POS_END);
            ?>
            <div class="slider owl-carousel owl-theme">
                <?php foreach (Slideshow::getSlides() as $slide):
                    if ($slide->image and is_file(Yii::getPathOfAlias('webroot') . '/uploads/slideshow/' . $slide->image)):
                        ?>
                        <div class="slide-item">
                            <div class="image-container">
                                <div class="image-outer-align">
                                    <div class="image-inner-align">
                                        <img src="<?= Yii::app()->getBaseUrl(true) . '/uploads/slideshow/' . $slide->image ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>