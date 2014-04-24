<?php

namespace frenzelgmbh\sblog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frenzelgmbh\sblog\models\Post;

/**
 * PostForm represents the model behind the search form about Post.
 */
class PostForm extends Model
{
	public $id;
	public $title;
	public $content;
	public $tags;
	public $status;
	public $author_id;
	public $time_create;
	public $time_update;

	public function rules()
	{
		return [
			[['id', 'author_id', 'time_create', 'time_update'], 'integer'],
			[['title', 'content', 'tags', 'status'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'author_id' => 'Author ID',
			'time_create' => 'Time Create',
			'time_update' => 'Time Update',
		];
	}

	public function search($params)
	{
		$query = Post::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'content', true);
		$this->addCondition($query, 'tags', true);
		$this->addCondition($query, 'status', true);
		$this->addCondition($query, 'author_id');
		$this->addCondition($query, 'time_create');
		$this->addCondition($query, 'time_update');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
  {
      if (($pos = strrpos($attribute, '.')) !== false) {
          $modelAttribute = substr($attribute, $pos + 1);
      } else {
          $modelAttribute = $attribute;
      }

      $value = $this->$modelAttribute;
      if (trim($value) === '') {
          return;
      }
      if ($partialMatch) {
          $query->andWhere(['like', $attribute, $value]);
      } else {
          $query->andWhere([$attribute => $value]);
      }
  }
}
