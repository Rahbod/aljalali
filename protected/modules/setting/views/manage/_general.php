<?php
/* @var $this SettingManageController */
/* @var $model SiteSetting */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">تنظیمات عمومی</h3>
    </div>
    <div class="box-body">
    <?
    $form = $this->beginWidget('CActiveForm',array(
        'id'=> 'general-setting',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ));
    ?>

    <?php $this->renderPartial('//partial-views/_flashMessage') ?>

    <?php
    foreach($model as $field):
        if($field->name != 'social_links'):
            if($field->name == 'keywords'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?>
                    <?
                    $this->widget("ext.tagIt.tagIt",array(
                        'name' => "SiteSetting[$field->name]",
                        'data' => (!empty($field->value))?CJSON::decode($field->value):''
                    ));
                    ?>
                    <p style="clear: both;font-size: 12px;color: #aaa">عبارت را وارد کرده و اینتر بزنید.</p>
                    <?php echo $form->error($field,'name'); ?>
                </div>
            <?php elseif($field->name == 'footer_logo'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?><br>
                    <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                        'id' => 'uploaderLogo',
                        'model' => $field,
                        'name' => 'footer_logo',
                        'maxFiles' => 1,
                        'maxFileSize' => 1, //MB
                        'url' => $this->createUrl('upload'),
                        'deleteUrl' => $this->createUrl('deleteUpload'),
                        'acceptedFiles' => '.jpg, .jpeg, .png',
                        'serverFiles' => $field->value ? new UploadedFiles($this->settingPath, $field->value) : [],
                        'onSuccess' => '
                                var responseObj = JSON.parse(res);
                                if(responseObj.status){
                                    {serverName} = responseObj.fileName;
                                    $(".uploader-message").html("");
                                }
                                else{
                                    $(".uploader-message").html(responseObj.message);
                                    this.removeFile(file);
                                }
                            ',
                    )); ?>
                    <div class="uploader-message error"></div>
                    <p><small>* فرمت قابل قبول jpg, png می باشد.</small>
                        <br>
                        <small>* حداکثر حجم فیلم 1 مگابیت می باشد.</small></p>
                </div>
            <?php elseif($field->name == 'footer_video'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?><br>
                    <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                        'id' => 'uploaderVideo',
                        'model' => $field,
                        'name' => 'footer_video',
                        'maxFiles' => 1,
                        'maxFileSize' => 50, //MB
                        'url' => $this->createUrl('uploadVideo'),
                        'deleteUrl' => $this->createUrl('deleteVideo'),
                        'acceptedFiles' => '.mp4',
                        'serverFiles' => $field->value ? new UploadedFiles($this->settingPath, $field->value) : [],
                        'onSuccess' => '
                            var responseObj = JSON.parse(res);
                            if(responseObj.status){
                                {serverName} = responseObj.fileName;
                                $(".uploader-map-message").html("");
                            }
                            else{
                                $(".uploader-map-message").html(responseObj.message);
                                this.removeFile(file);
                            }
                        ',
                    )); ?>
                    <div class="uploader-map-message error"></div>
                    <p><small>* فرمت قابل قبول mp4 می باشد.</small>
                        <br>
                        <small>* حداکثر حجم فیلم 50 مگابیت می باشد.</small></p>
                </div>
            <?php else:?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?>
                    <?php echo CHtml::textField("SiteSetting[$field->name]",$field->value,array('size'=>60,'class'=>'form-control text-right', 'dir' => 'auto')); ?>
                    <?php echo $form->error($field,'name'); ?>
                </div>
            <?php
            endif;
        endif;
    endforeach;
    ?>
    <div class="form-group buttons">
        <?php echo CHtml::submitButton('ذخیره',array('class' => 'btn btn-success')); ?>
    </div>
    <?
    $this->endWidget();
    ?>
    </div>
</div>