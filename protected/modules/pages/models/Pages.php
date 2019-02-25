<?php

/**
 * This is the model class for table "ym_pages".
 *
 * The followings are the available columns in table 'ym_pages':
 * @property string $id
 * @property string $title
 * @property string $summary
 * @property string $category_id
 * @property string $image
 * @property string $order
 * @property string $parent_id
 * @property string $in_footer
 * @property string $url
 *
 *
 * The followings are the available model relations:
 * @property PageCategories $category
 * @property Tags[] $tags
 *
 */
class Pages extends SortableCActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{pages}}';
    }

    public $formTags = [];

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('image, title', 'length', 'max' => 255),
            array('category_id', 'length', 'max' => 11),
            array('order, parent_id', 'length', 'max' => 10),
            array('in_footer', 'length', 'max' => 1),
            array('summary', 'safe'),
            array('formTags', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, summary, category_id, order, in_footer', 'safe', 'on' => 'search'),
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
            'category' => array(self::BELONGS_TO, 'PageCategories', 'category_id'),
            'parent' => array(self::BELONGS_TO, 'Pages', 'parent_id'),
            'tagsRel' => array(self::HAS_MANY, 'TagRel', 'model_id',
                'on' => 'tagsRel.model_name = :model_name',
                'params' => array(':model_name' => get_class($this))
            ),
            'tags' => array(self::MANY_MANY, 'Tags', '{{tag_rel}}(model_id,tag_id)',
                'condition' => '`tags_tags`.model_name = :model_name',
                'params' => array(':model_name' => get_class($this))
            ),
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
            'summary' => 'متن',
            'category_id' => 'دسته بندی',
            'formTags' => 'کلمات کلیدی',
            'image' => 'تصویر',
            'parent_id' => 'سردسته',
            'in_footer' => 'نمایش در فوتر',
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
        $criteria->compare('summary', $this->summary, true);
        $criteria->compare('category_id', $this->category_id, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('in_footer', $this->in_footer);
        if(isset($_GET['parent']))
            $criteria->addCondition('parent_id IS NULL');
        else if ($this->category_id != 3)
            $criteria->addCondition('parent_id IS NOT NULL');


        if ($this->category_id == 2 || $this->category_id == 4)
            $criteria->addCondition('parent_id IS NOT NULL');

        $criteria->order = 't.order';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pages the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterSave()
    {
        $this->formTags = isset($_POST[get_class($this)]['formTags']) ? explode(',', $_POST[get_class($this)]['formTags']) : null;
        if ($this->formTags && !empty($this->formTags)) {
            if (!$this->isNewRecord) {
                $cr = new CDbCriteria();
                $cr->compare("model_name", get_class($this));
                $cr->compare("model_id", $this->id);
                TagRel::model()->deleteAll($cr);
            }

            foreach ($this->formTags as $tag) {
                $tagModel = Tags::model()->findByAttributes(array('title' => $tag));
                if ($tagModel) {
                    $tag_rel = new TagRel();
                    $tag_rel->model_name = get_class($this);
                    $tag_rel->model_id = $this->id;
                    $tag_rel->tag_id = $tagModel->id;
                    $tag_rel->save(false);
                } else if (!empty($tag)) {
                    $tagModel = new Tags();
                    $tagModel->title = $tag;
                    $tagModel->save(false);
                    $tag_rel = new TagRel();
                    $tag_rel->model_name = get_class($this);
                    $tag_rel->model_id = $this->id;
                    $tag_rel->tag_id = $tagModel->id;
                    $tag_rel->save(false);
                }
            }
        }
        parent::afterSave();
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->formTags = CHtml::listData($this->tags, 'title', 'title');
    }

    public function getKeywords()
    {
        $tags = CHtml::listData($this->tags, 'title', 'title');
        return implode(',', $tags);
    }

    public function getDescription()
    {
        return mb_substr(strip_tags($this->summary), 0, 165);
    }

    /**
     * @param $title
     * @return null|Pages
     */
    public static function getPageContentWithTitle($title)
    {
        return self::model()->findByAttributes(array('title' => $title)) ?: null;
    }

    /**
     * @param $title
     * @return null|string
     */
    public static function getPageUrlWithTitle($title)
    {
        $model = self::model()->findByAttributes(array('title' => $title));
        if ($model)
            return Yii::app()->createUrl("/page/" . urlencode($model->title));
        return null;
    }

    /**
     * @param $slug
     * @param null $condition
     * @param array $params
     * @return Pages[]
     */
    public static function getPages($slug, $condition = null, $params = [])
    {
        $cr = new CDbCriteria();
        $cr->compare('category.slug', $slug);
        $cr->with = array('category');
        if ($condition) {
            $cr->addCondition($condition);
            if ($params)
                $cr->params = $cr->params + $params;
        }
        $cr->order = 't.order';
        return self::model()->findAll($cr);
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('/pages/' . $this->id . '/' . urlencode($this->title));
    }
}