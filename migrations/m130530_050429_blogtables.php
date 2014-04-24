<?php

class m130530_050429_blogtables extends \yii\db\Migration
{
	public function up()
	{
		$this->createTable('tbl_post',array(
				'id'          => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				'title'       => 'VARCHAR(128) NOT NULL',
				'content'     => 'TEXT NULL',
				'tags'        => 'TEXT',
				'status'      => 'VARCHAR(255) NOT NULL DEFAULT "created"',
				'author_id'   => 'INTEGER DEFAULT NULL',
				'time_create' => 'INTEGER',
				'time_update' => 'INTEGER',
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

		$this->createTable('tbl_comment',array(
				'id'            => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				'content'       => 'TEXT NULL',
				'status'        => 'VARCHAR(255) NOT NULL DEFAULT "created"',
				'author_id'     => 'INTEGER DEFAULT NULL',
				'time_create'   => 'INTEGER',
				'comment_table' => 'INTEGER UNSIGNED DEFAULT NULL',
				'comment_id'    => 'INTEGER UNSIGNED DEFAULT NULL',
		),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

		/**
		* Add all needed fields to user in one_site belongs to many users
		**/
		$this->addForeignKey('FK_post_author','tbl_post','author_id','tbl_user','id');
		$this->addForeignKey('FK_comment_author','tbl_comment','author_id','tbl_user','id');
	}

	public function down()
	{
		//drop FK's first
		$this->dropForeignKey('FK_post_author','tbl_post');
		$this->dropForeignKey('FK_comment_author','tbl_comment');

		$this->dropTable('tbl_post');
		$this->dropTable('tbl_comment');
	}
}
