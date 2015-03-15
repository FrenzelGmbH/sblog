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
				'id'          	=> Schema::TYPE_PK,
				'title'       	=> Schema::TYPE_STRING .'(128) NOT NULL',
				'content'     	=> Schema::TYPE_STRING.' NULL',
				'tags'        	=> Schema::TYPE_STRING,
				'status'      	=> Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
				//possible reference to user
		      	'user_id'           => Schema::TYPE_INTEGER.' NULL',
		      	//module fields
		      	'mod_table'         => Schema::TYPE_STRING .'(100)',
		      	'mod_id'            => Schema::TYPE_INTEGER.' NULL',
		      	//interface fields
		      	'system_key'        => Schema::TYPE_STRING .'(100)',
		      	'system_name'       => Schema::TYPE_STRING .'(100)',
		      	'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
		      	// timestamps
		      	'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
		      	'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
		      	'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',
		      	//Foreign Keys
		      	'categories_id'     => Schema::TYPE_INTEGER.' NULL',
		      	'author_id'     	=> Schema::TYPE_INTEGER.' NULL'
		),$tableOptions);

		/**
		* Add all needed fields to user in one_site belongs to many users
		**/
		$this->addForeignKey('FK_post_author','{{%post}}','author_id','{{%user}}','id');
	}

	public function down()
	{
		//drop FK's first
		$this->dropForeignKey('FK_post_author','{{%post}}');

		$this->dropTable('{{%post}}');
	}
}
