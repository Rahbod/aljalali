<?php
/** @var $this Controller */
/** @var $form CActiveForm */
$controller = $this->action->controller->id;
$module = $this->action->controller->module?$this->action->controller->module->id:null;
$action = $this->action->id;

$prayer = Prayer::get()->response['results']['datetime'][0]['times'];
$hijriDate = HijriDate::get()->response;
?>


<div class="prayer-time-section">
    <div class="container">
        <img src="<?= Yii::app()->theme->baseUrl. '/images/kabeh.png'?>">
        <h3>الصلاة القادمة
            <small>بتوقیت النجف الاشرف</small>
            <?php if(isset($hijriDate['data']['hijri'])):?>
                <small><?php echo $hijriDate['data']['hijri']['day'].' '.$hijriDate['data']['hijri']['month']['ar'].', '.$hijriDate['data']['hijri']['year'].' هـ'?></small>
                <small><?php echo $hijriDate['data']['gregorian']['year'].$hijriDate['data']['gregorian']['month']['en'].$hijriDate['data']['gregorian']['day'].' مـ'?></small>
            <?php endif;?>
        </h3>
        <ul class="times">
            <li>
                <div class="title">فجر</div>
                <div class="time"><?= $prayer['Fajr'] ?></div>
            </li>
            <li>
                <div class="title">ظهر</div>
                <div class="time"><?= $prayer['Dhuhr'] ?></div>
            </li>
            <li>
                <div class="title">عصر</div>
                <div class="time"><?= $prayer['Asr'] ?></div>
            </li>
            <li>
                <div class="title">مغرب</div>
                <div class="time"><?= $prayer['Maghrib'] ?></div>
            </li>
            <li>
                <div class="title">عشاء</div>
                <div class="time"><?= $prayer['Isha'] ?></div>
            </li>
        </ul>
    </div>
</div>
<div class="map-section">
    <?php $this->renderPartial('//partial-views/_map') ?>
</div>
<div class="bottom-section">
    <div class="container">
        <div class="overflow-fix">
            <div class="form-container">
                <h3>اتصل بنا</h3>
                <div class="text">إذا كنت مهتمًا بالاتصال بنا ، فيمكنك الاختيار من النموذج أدناه وطرح سؤالك.<br>يمكنك أيضا الاتصال بأرقام الاتصال المدرجة.</div>
                <?php
                Yii::app()->getModule('contact');
                $model = new ContactForm();
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'contact-form',
                    'action' => array('/contact'),
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        'afterValidate' => 'js: function(form, data, hasError){
                            if(hasError)
                                $(".captcha a").click();
                            else
                                return true;
                        }'
                    ),
                )); ?>
                <input type="hidden" name="return" value="<?= Yii::app()->request->requestUri.'#contact-form' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php echo CHtml::label('القسم المطلوب','department_id') ?>
                                <?php echo $form->dropDownList($model,'department_id', CHtml::listData(ContactDepartment::model()->findAll(array('order'=>'id')),'id','title')) ?>
                                <?php echo $form->error($model,'department_id') ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php echo CHtml::label('الاسم الکامل','name') ?>
                                <?php echo $form->textField($model,'name', array('placeholder'=>'الاسم الکامل')) ?>
                                <?php echo $form->error($model,'name') ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php echo CHtml::label('البريد الإلكتروني','email') ?>
                                <?php echo $form->emailField($model,'email', array('placeholder'=>'exampel@email.com')) ?>
                                <?php echo $form->error($model,'email') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php echo CHtml::label('رقم الهاتف المحمول','tel') ?>
                                <?php echo $form->telField($model,'tel', array('placeholder'=>'09xxxxxxxx')) ?>
                                <?php echo $form->error($model,'tel') ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <?php echo CHtml::label('النص المرغوب','body') ?>
                                <?php echo $form->textArea($model,'body', array('placeholder'=>'النص المرغوب')) ?>
                                <?php echo $form->error($model,'body') ?>
                            </div>
                        </div>
                        <div class="form-row last">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 captcha">
                                <?php $this->widget('CCaptcha'); ?>
                                <?php echo $form->textField($model,'verifyCode',array('placeholder'=>"صورة أمنية")); ?>
                                <?php echo $form->error($model,'verifyCode') ?>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <input type="submit" value="إرسال إلى القسم ذي الصلة">
                            </div>
                        </div>
                    </div>
                <?php $this->endWidget() ?>
            </div>
            <div class="info-container">
                <ul>
                    <li>
                        <i class="icon point-icon"></i>
                        <div>عنوان المکتب<br><?= SiteSetting::getOption('address') ?></div>
                    </li>
                    <li>
                        <i class="icon phone-icon"></i>
                        <div>الهاتف والفاكس<br> <?= SiteSetting::getOption('tel') ?>     -      <?= SiteSetting::getOption('tel2') ?></div>
                    </li>
                    <li class="email">
                        <i class="icon email-icon"></i>
                        <div><?= SiteSetting::getOption('master_email') ?></div>
                    </li>
                    <li>
                        <i class="icon share-icon"></i>
                        <div><?php $this->renderPartial('//partial-views/_socials') ?></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="footer-section">
    <div class="container">
        <?php $footer = Pages::getPages('menu', 'parent_id IS NULL and in_footer = 1'); ?>
        <?php foreach ($footer as $item): ?>
            <div class="footer-block">
                <h4><?= $item->title ?></h4>
                <ul>
                    <?php $sub = Pages::getPages('menu', 'parent_id = :pid', [':pid' => $item->id]); ?>
                    <?php foreach ($sub as $page): ?>
                        <li><a href="<?= $page->url ?>">- <?= $page->title ?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endforeach;?>
        <div class="footer-block">
            <h4>حقل الصور</h4>
            <?php
            $galleryCategories = GalleryCategories::model()->findAll(array('order' => 't.order'));
            if($galleryCategories):
                ?>
                <ul>
                    <?php foreach ($galleryCategories as $category): ?>
                        <li><a href="<?= $module=='gallery'?"#category-{$category->id}":$this->createUrl("/gallery#category-{$category->id}") ?>"><?= $category->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="footer-block">
            <h4>المواقع المرتبطة</h4>
            <?php
            $links = Links::model()->findAll(array('order' => 't.order'));
            if($links):
                ?>
                <ul>
                    <?php foreach ($links as $link): ?>
                        <li><a href="<?= $link->link ?>"><?= $link->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="copyright">
            <div class="pull-right">
                <a href="http://tarsiminc.com" target="_blank">by tarsim.inc</a>
            </div>
            <div class="pull-left text"><b>al-jalali.com</b> . ALL RIGHTS RESERVED © 2018</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".captcha a").click();
    })
</script>