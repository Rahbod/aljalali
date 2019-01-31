<?php

/**
 * This is the model class for table "{{contact_messages}}".
 *
 * The followings are the available columns in table '{{contact_messages}}':
 * @property string $name
 * @property string $email
 * @property string $tel
 * @property string $subject
 * @property string $body
 * @property string $department_id
 *
 */
class ContactForm extends CFormModel
{
	public $name;
	public $tel;
	public $email;
	public $body;
	public $subject;
	public $department_id;
	public $verifyCode;

	public function rules()
	{
		return array(
			array('name, tel, body, email, department_id', 'required'),
			array('tel', 'numerical', 'integerOnly'=>true),
			array('tel', 'length', 'max'=>11),
            array('email','email'),
            array('subject','filter','filter'=>'strip_tags'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
			'name' => 'الاسم الکامل',
			'email' => 'البريد الإلكتروني',
			'tel' => 'رقم الهاتف المحمول',
			'subject' => 'موضوع',
			'body' => 'النص المرغوب',
			'department_id' => 'القسم المطلوب',
			'verifyCode'=>'کد امنیتی',
		);
	}
}
