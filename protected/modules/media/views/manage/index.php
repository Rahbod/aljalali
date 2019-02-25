<?php
/* @var $this MediaManageController */
/* @var $content [] */


$this->breadcrumbs=array(
    'مدیریت رسانه ها',
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت رسانه ها</h3>
        <a href="#" data-toggle="modal" data-target="#add-image" class="btn btn-default btn-sm">افزودن تصویر</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>
        <div class="input-group">
            <input class="form-control filter" type="text" placeholder="عنوان فایل را جستجو کنید...">
            <div class="input-group-addon">
                <span class="fa fa-search"></span>
            </div>
        </div>
        <hr>
        <div class="content" style="position:relative;">
            <div class="empty-message<?php if($content): ?> hidden<?php endif; ?>">
                <div class="inner-flex">
                    <h3>رسانه ای یافت نشد.</h3>
                </div>
            </div>
            <div class="media-box row">
                <?php foreach ($content as $item): ?>
                <div class="media-item">
                    <div class="media-image" style="background: url('<?= Yii::app()->getBaseUrl(true).'/'.$this->folderMedia.'/'.$item ?>') no-repeat scroll top center #f5f5f5;">
                        <div class="media-overlay">
<!--                            Copy Address-->
                            <button type="button" class="btn btn-default btn-xs copy-btn">کپی کردن آدرس</button>

                            <!--                            Delete Form-->
                            <form action="<?= $this->createUrl('/media/manage/deleteUpload') ?>" method="post">
                                <input type="hidden" name="csrf-token" value="<?= Yii::app()->request->csrfToken ?>">
                                <input type="hidden" name="fileName" value="<?= $item ?>">
                                <button type="submit" class="btn btn-danger btn-xs remove-file-btn" onclick='if(!confirm("در صورت حذف تصویر موارد استفاده شده نمایش داده نمیشود.\nآیا از حذف اطمینان دارید؟")) return false;'>حذف تصویر</button>
                            </form>


                            <input class="link" type="text" readonly value="<?= Yii::app()->getBaseUrl(true).'/'.$this->folderMedia.'/'.$item ?>">
                        </div>
                    </div>
                    <div class="text-center">
                        <label><?= $item ?></label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="copy-overlay" style="display: none">
    آدرس تصویر کپی شد.
</div>

<div class="modal fade" id="add-image">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">افزودن تصویر</h3>
            </div>
            <div class="modal-body text-center">
                <?php echo CHtml::beginForm(array('/media/manage/addImage')); ?>
                    <div class="form-group">
                        <p>لطفا تصویر را آپلود کنید</p>
                        <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                            'id' => 'uploaderImage',
                            'name' => 'image',
                            'maxFiles' => 1,
                            'maxFileSize' => 10, //MB
                            'url' => Yii::app()->createUrl('/media/manage/upload'),
                            'deleteUrl' => Yii::app()->createUrl('/media/manage/deleteUpload'),
                            'acceptedFiles' => '.jpg, .jpeg, .png, .gif, .bmp',
                            'serverFiles' => [],
                            'onSuccess' => '
                                var responseObj = JSON.parse(res);
                                if(responseObj.status){
                                    {serverName} = responseObj.fileName;
                                    $(".uploader-message").html("");
                                    location.reload();
                                }
                                else{
                                    $(".uploader-message#image-error").html(responseObj.message);
                                    this.removeFile(file);
                                }
                            ',
                        )); ?>
                        <div class="clearfix"></div>
                        <small class="uploader-message error" id="image-error"></small>
                    </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var t;
        $("body").on("click", '.copy-btn', function () {
            var copyText = $(this).parent().find('.link');
            copyText.select();
            document.execCommand("copy");
            clearTimeout(t);
            $(".copy-overlay").stop().fadeIn(100);
            t = setTimeout(function () {
                $(".copy-overlay").fadeOut(1000);
            }, 2000);
        });


        $('input.filter').on('keyup', function() {
            var $table = $('.media-box');
            var rex = new RegExp($(this).val(), 'i');
            $table.find('.media-item').hide();
            $table.find('.media-item').filter(function() {
                return rex.test($(this).find("label").text());
            }).show();
            if ( $table.find('.media-item:visible').length === 0 ) {
                $('.empty-message').removeClass("hidden");
            } else {
                $('.empty-message').addClass("hidden");
            }
        });
    })
</script>

<style>
    .copy-overlay {
        background-color: rgba(0,0,0,0.8);
        padding: 8px 25px;
        position: fixed;
        display: inline-block;
        width: auto;
        height: auto;
        text-align: center;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        top: 30px;
        color: #ddd !important;
        z-index:10000;
        border-radius: 4px;
        -webkit-box-shadow:  4px 4px 8px rgba(0,0,0,0.6);
        -moz-box-shadow:  4px 4px 8px rgba(0,0,0,0.6);
        box-shadow:  4px 4px 8px rgba(0,0,0,0.6);
    }
    .media-image {
        background-size: cover;
        width: 170px;
        height: 130px;
        position: relative;
    }
    .media-image .media-overlay .btn{
        margin-bottom: 15px;
        width: 90%;
        display: none;
    }
    .media-image .media-overlay{
        background-color: rgba(0,0,0,0.7);
        padding: 30px 25px;
        position: absolute;
        display: block;
        text-align: center;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        z-index: 1;
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    .media-item:hover .media-image .media-overlay{
        opacity: 1;
        visibility: visible;
    }
    .media-item:hover .media-image .media-overlay .btn{
        display: block;
    }
    .media-item > div{
        padding: 7px;
    }
    .media-item label{
        display: block;
        text-align: center;
        font-size: 12px;
        color: #888;
    }
    .media-item {
        margin: 0 15px 15px;
        float: right;
        display: inline-block;
        border-radius: 4px;
        overflow: hidden;
        background-color: #eee;
    }
    .empty-message {
        display: flex;
        min-height: 400px;
        text-align: center;
        justify-content: center;
        color: #A8A8A8 !important;
    }
    .link {
        opacity: 0;
        width: 10px
    }
    .inner-flex {
        padding: 100px 0;
        display: block;
        width: 100%;
    }
</style>