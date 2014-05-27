<?php

/**
 * The migration script for the sblog
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m130530_050429_blogtables extends \yii\db\Migration
{
	public function up()
	{
		
		switch (Yii::$app->db->driverName) {
	      case 'mysql':
	        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
	        break;
	      case 'pgsql':
	        $tableOptions = null;
	        break;
	      default:
	        throw new RuntimeException('Your database is not supported!');
	    }

		$this->createTable('{{%post}}',array(
				'id'          => Schema::TYPE_PK,
				'title'       => Schema::TYPE_STRING .'(128) NOT NULL',
				'content'     => Schema::TYPE_STRING.' NULL',
				'tags'        => Schema::TYPE_STRING,
				'status'      => Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
				'author_id'   => Schema::TYPE_INTEGER.' NULL',
				'time_create' => Schema::TYPE_INTEGER,
				'time_update' => Schema::TYPE_INTEGER,
		),$tableOptions);

		$this->createTable('{{%comment}}',array(
				'id'            => Schema::TYPE_PK,
				'content'       => Schema::TYPE_STRING.' NULL',
				'status'        => Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
				'author_id'     => Schema::TYPE_INTEGER.' NULL',
				'time_create'   => Schema::TYPE_INTEGER,
				'comment_table' => Schema::TYPE_INTEGER.' NULL',
				'comment_id'    => Schema::TYPE_INTEGER.' NULL',
		),$tableOptions);

		/**
		* Add all needed fields to user in one_site belongs to many users
		**/
		$this->addForeignKey('FK_post_author','{{%post}}','author_id','{{%user}}','id');
		$this->addForeignKey('FK_comment_author','{{%comment}}','author_id','{{%user}}','id');
	}

	public function down()
	{
		//drop FK's first
		$this->dropForeignKey('FK_post_author','{{%post}}');
		$this->dropForeignKey('FK_comment_author','{{%comment}}');

		$this->dropTable('{{%post}}');
		$this->dropTable('{{%comment}}');
	}
}
