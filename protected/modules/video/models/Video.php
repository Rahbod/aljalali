<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property string $id
 * @property string $title
 * @property string $place
 * @property string $category_id
 * @property string $date
 * @property string $order
 * @property integer $sub_category
 * @property integer $year
 * @property string $file
 */
class Video extends SortableCActiveRecord
{
    public static $subCategories = [
        0 => 'محاضرات محرم و صفر',
        1 => 'محاضرات رمضانية',
        2 => 'محاضرات عامّة',
    ];

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{video}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, category_id, year', 'required'),
            array('title, date, place', 'length', 'max' => 50),
            array('category_id, order', 'length', 'max' => 10),
            array('sub_category', 'length', 'max' => 1),
            array('file', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, embed, category_id, date, place, order', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'VideoCategories', 'category_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'شناسه',
            'title' => 'عنوان',
            'date' => 'تاریخ',
            'place' => 'مکان',
            'category_id' => 'دسته بندی',
            'order' => 'Order',
            'embed' => 'Embed Code',
            'sub_category' => 'دسته بندی سخنرانی ها',
            'year' => 'سال',
            'file' => 'فایل فیلم',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('place', $this->place, true);
        $criteria->compare('category_id', $this->category_id, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('sub_category', $this->sub_category, true);
        $criteria->compare('year', $this->year, true);
        $criteria->compare('file', $this->file, true);

        $criteria->order = 't.order';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Video the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
