<?php

/**
 * This is the model class for table "{{video_categories}}".
 *
 * The followings are the available columns in table '{{video_categories}}':
 * @property string $id
 * @property string $title
 * @property string $order
 *
 * @property Video[] $videos
 */
class VideoCategories extends SortableCActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{video_categories}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 200),
            array('order', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, order', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        $videosRel = [self::HAS_MANY, 'Video', 'category_id', 'order' => 'videos.order ASC'];

        if (isset($_GET['subcat']) or isset($_GET['year'])) {
            $videosRel['condition'] = '';
            $videosRel['params'] = [];

            if (isset($_GET['subcat'])) {
                $videosRel['condition'] .= 'sub_category = :sub_category';
                $videosRel['params'][':sub_category'] = $_GET['subcat'];
            }

            if (isset($_GET['year'])) {
                if (!empty($videosRel['condition']))
                    $videosRel['condition'] .= ' AND ';

                $videosRel['condition'] .= 'year = :year';
                $videosRel['params'][':year'] = $_GET['year'];
            }
        }

        return array(
            'videos' => $videosRel
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
            'order' => 'Order',
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
        $criteria->compare('order', $this->order, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VideoCategories the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return self[]
     */
    public static function getAll()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.order';
        $criteria->with = array('videos');
        return self::model()->findAll($criteria);
    }
}
