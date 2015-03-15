<?php

class m130613_155334_tagcloud extends \yii\db\Migration
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
            case 'mssql':
              $tableOptions = null;
              break;
            default:
              throw new RuntimeException('Your database is not supported!');
        }

		$this->createTable('{{%tag}}',array(
				'id'        => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				'name'      => 'VARCHAR(128) NOT NULL',
				'frequency' => 'INTEGER DEFAULT 1',
		),$tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%tag}}');
	}
}
