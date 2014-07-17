<?php

namespace frenzelgmbh\sblog\models;

use Yii;

use app\models\User;
use app\modules\workflow\models\Workflow;
use app\modules\comments\models\Comment;
use app\modules\tags\models\Tag;

use yii\helpers\Html;

use \DateTime;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $status
 * @property integer $author_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $categories_id
 *
 * @property  $author
 */
class Post extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%post}}';
	}

	private $_oldTags;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(['title', 'content', 'status'], 'required'),
			array('status', 'in', 'range'=>array(Workflow::STATUS_CREATED,Workflow::STATUS_DRAFT,Workflow::STATUS_PUBLISHED,Workflow::STATUS_ARCHIVED)),
			array('title', 'string', 'max'=>128),
			array('categories_id','integer'),
			['created_at','string'],
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			
			//array('title, status', 'safe','categories_id', 'on'=>'search'),
		);
	}

	/**
	 * [getComments description]
	 * @return [type] [description]
	 */
	public function getComments() {
		return $this->hasMany('\app\modules\comments\models\Comment', array('comment_id' => 'id')) //
		            ->where('status = "'. Workflow::STATUS_APPROVED.'" AND comment_table = '.Workflow::MODULE_BLOG)
					->orderBy('created_at DESC');
	}

	/**
	 * [getAuthor description]
	 * @return [type] [description]
	 */
	public function getAuthor() {
		return $this->hasOne('\frenzelgmbh\appcommon\components\User', array('id' => 'author_id'));
	}

	/**
	 * [getCategory description]
	 * @return [type] [description]
	 */
	public function getCategory() {
		return $this->hasOne('\app\modules\categories\models\Categories', array('id' => 'categories_id'));
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => 'Id',
			'title'         => Yii::t('app','Title'),
			'content'       => Yii::t('app','Content'),
			'tags'          => Yii::t('app','Tags'),
			'status'        => Yii::t('app','Status'),
			'created_at'   => Yii::t('app','Created at'),
			'updated_at'   => Yii::t('app','Updatet at'),
			'author_id'     => Yii::t('app','Author'),
			'categories_id' => Yii::t('app','Category'),
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return \Yii::$app->urlManager->createUrl([
			'/posts/post/onlineview',
			'id'=>$this->id,
			'title'=>$this->title
		]);
	}

	/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=Html::a(Html::encode($tag), array('/posts/post/tag', 'tag'=>$tag), array('class'=>'label label-info'));
		return implode("&nbsp;\n",$links);
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if(Yii::$app->params['commentNeedApproval'])
			$comment->status=Workflow::STATUS_DRAFT;
		else
			$comment->status=Workflow::STATUS_APPROVED;
		$comment->comment_table=Workflow::MODULE_BLOG;
		$comment->comment_id=$this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	public function afterFind()
	{
		parent::afterFind();
		$this->_oldTags = $this->tags;		
		$this->created_at = gmdate("Y-m-d", $this->created_at);
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	public function beforeSave($insert)
	{		
		if (parent::beforeSave($insert)) 
		{
			if ($insert) 
			{
				$this->created_at=$this->updated_at=time();
				$this->author_id=\Yii::$app->user->identity->id;
			}
			else
			{
				$this->updated_at=time();
				$a = strptime($this->created_at, '%Y-%m-%d');
				$timestamp = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday']+1, $a['tm_year']+1900);				
				$this->created_at = $timestamp;		
			}
			return true;
		} 
		return false;
	}

	/**
	 * This is invoked after the record is saved.
	 */
	public function afterSave($insert,$changedAttributes)
	{
		parent::afterSave($insert,$changedAttributes);
		Tag::updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	public function afterDelete()
	{
		if (parent::beforeDelete()) {
			Comment::deleteAll('comment_id='.$this->id.' AND comment_table="'.Workflow::MODULE_BLOG.'"');
			Tag::updateFrequency($this->tags, '');
		} else {
			return false;
		}
	}

	/**
	 * This will return the query the passed number of posts ordered desc by time created
	 * @param  limit number of records to be listed by data provider
	 * @return  query containing the correct sql for active data provider
	 */
	public static function getAdapterForPosts($limit=5,$tag='')
	{
		return static::find()->where('status="'.Workflow::STATUS_PUBLISHED.'" AND tags LIKE "%'.$tag.'%"')
					->orderBy('created_at DESC')
					->limit($limit);
	}

	/**
	 * This will return the query the passed number of posts ordered desc by time created
	 * @param  limit number of records to be listed by data provider
	 * @return  query containing the correct sql for active data provider
	 */
	public static function getAdapterForPostsCatgory($limit=5,$category='')
	{
		return static::find()->where('status="'.Workflow::STATUS_PUBLISHED.'" AND categories_id = "'.$category.'"')
					->orderBy('created_at DESC')
					->limit($limit);
	}

	/**
  * search body by string
  * @param string searchText to be looked up
  */
  public static function searchByString($query)
  {
		return static::find()->where("UPPER(content) LIKE '%".strtoupper($query)."%'");
	}

	/**
	 * Will return the next post after this one... If no one behind it, then jump to start
	 * @return the next record
	 * @todo if the result is NULL, we need to return the first post
	 */
	public function getNextPost()
	{
		return static::find()
			->where('id > :id', [':id' => $this->id])
			->orderBy('created_at ASC')->limit(1)->One();
	}

	/**
	 * Will return the previous post after this one... If no one behind it, then jump to start
	 * @return the next record
	 * @todo if the result is NULL, we need to return the first post
	 */
	public function getPreviousPost()
	{
		return static::find()
			->where('id < :id', [':id' => $this->id])
			->orderBy('created_at DESC')->limit(1)->One();
	}

}
