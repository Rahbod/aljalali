<?php
/* @var $this VideoManageController */
/* @var $model Video */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gallery-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php $this->renderPartial("//partial-views/_flashMessage"); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'class' => 'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'embed'); ?>
		<?php echo $form->textArea($model,'embed',array('form-groups'=>6,'class' => 'form-control', 'cols'=>50)); ?>
		<?php echo $form->error($model,'embed'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'file'); ?>
        <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
            'id' => 'uploaderFile',
            'model' => $model,
            'name' => 'file',
            'maxFiles' => 1,
            'maxFileSize' => 200, //MB
            'url' => $this->createUrl('upload'),
            'deleteUrl' => $this->createUrl('deleteUpload'),
            'acceptedFiles' => '.mp4',
            'serverFiles' => $model->file ? new UploadedFiles($this->filePath, $model->file) : [],
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
        <?php echo $form->error($model,'file'); ?>
        <div class="uploader-message error"></div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <div class="input-group">
            <?php echo $form->dropDownList($model,'category_id', CHtml::listData(VideoCategories::model()->findAll(),'id', 'title'),array('class' => 'form-control')); ?>
            <span class="input-group-btn">
                    <a href="<?= $this->createUrl('/video/categories/create') ?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
                </span>
        </div>
        <?php echo $form->error($model,'category_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'place'); ?>
        <?php echo $form->textField($model,'place',array('size'=>50,'class' => 'form-control','maxlength'=>255)); ?>
        <?php echo $form->error($model,'place'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'date'); ?>
        <?php echo $form->textField($model,'date',array('size'=>50,'class' => 'form-control','maxlength'=>255)); ?>
        <?php echo $form->error($model,'date'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'sub_category'); ?>
        <?php echo $form->dropDownList($model,'sub_category', $model::$subCategories, array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'year'); ?>
        <?php echo $form->numberField($model,'year',array('class' => 'form-control','maxlength'=>4)); ?>
        <?php echo $form->error($model,'year'); ?>
    </div>

	<div class="form-group buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->