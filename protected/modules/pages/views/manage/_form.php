<?php
/* @var $this PagesManageController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>
<? $this->renderPartial('//partial-views/_flashMessage'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <?php if($this->categorySlug == 'about' || $this->categorySlug == 'footer'):?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id', CHtml::listData(Pages::model()->findAll('category_id = :id and parent_id IS NULL',[':id' => $this->categoryId]),'id', 'title'),array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
    <?php endif;?>

    <?php if($this->categorySlug == 'services'):?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
            'id' => 'uploaderImage',
            'model' => $model,
            'name' => 'image',
            'maxFiles' => 1,
            'maxFileSize' => .5, //MB
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
        <p><small>اندازه مناسب برای تصویر 350 در 250 پیکسل می باشد.</small></p>
    </div>
    <?php endif;?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'summary'); ?>
        <?
        $this->widget('ext.ckeditor.CKEditor', array(
            'model'=>$model,
            'attribute'=>'summary',
        ));
        ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'formTags'); ?>
        <?php
        $this->widget("ext.tagIt.tagIt",array(
            'model' => $model,
            'attribute' => 'formTags',
            'suggestType' => 'json',
            'suggestUrl' => Yii::app()->createUrl('/tags/list'),
            'data' => $model->formTags
        ));
        ?>
        <?php echo $form->error($model,'formTags'); ?>
    </div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش',array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>