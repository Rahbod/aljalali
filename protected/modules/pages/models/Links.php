<?php

/**
 * This is the model class for table "ym_links".
 *
 * The followings are the available columns in table 'ym_links':
 * @property string $id
 * @property string $title
 * @property string $summary
 * @property string $category_id
 * @property string $image
 * @property string $order
 * @property string $parent_id
 * @property string $in_footer
 * @property string $in_menu
 * @property string $in_about
 * @property string $url
 *
 *
 * The followings are the available model relations:
 * @property PageCategories $category
 * @property Tags[] $tags
 *
 */
class Links extends SortableCActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{links}}';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, link', 'required'),
            array('title, link', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, link', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'عنوان',
            'link' => 'آدرس',
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

        $criteria->order = 't.order';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Links the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}