<?php
/* @var $this GalleryManageController */
/* @var $model Gallery */
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
		<?php echo $form->textField($model,'title',array('size'=>50,'class' => 'form-control','maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('form-groups'=>6,'class' => 'form-control', 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <div class="input-group">
            <?php echo $form->dropDownList($model,'category_id', CHtml::listData(GalleryCategories::model()->findAll(),'id', 'title'),array('class' => 'form-control')); ?>
            <span class="input-group-btn">
                    <a href="<?= $this->createUrl('/gallery/categories/create') ?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
                </span>
        </div>
        <?php echo $form->error($model,'category_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
            'id' => 'uploaderImage',
            'model' => $model,
            'name' => 'image',
            'maxFiles' => 1,
            'maxFileSize' => 2, //MB
            'url' => $this->createUrl('upload'),
            'deleteUrl' => $this->createUrl('deleteUpload'),
            'acceptedFiles' => '.jpg, .jpeg, .png',
            'serverFiles' => $model->image ? new UploadedFiles($this->imagePath, $model->image) : [],
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
        <?php echo $form->error($model,'image'); ?>
        <div class="uploader-message error"></div>
    </div>

	<div class="form-group buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->