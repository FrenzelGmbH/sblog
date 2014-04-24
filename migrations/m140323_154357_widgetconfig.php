<?php

use yii\db\Schema;

class m140323_154357_widgetconfig extends \yii\db\Migration
{
    public function up()
    {
      $this->createTable('tbl_widget',array(
          'id'                      => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
          'name'                    => 'VARCHAR(200)',          
          'wgt_table'               => 'INTEGER UNSIGNED DEFAULT NULL',
          'wgt_id'                  => 'INTEGER UNSIGNED DEFAULT NULL',
          'param1_str'              => 'VARCHAR(200)',
          'param2_int'              => 'INTEGER DEFAULT NULL',
          'param3_date'             => 'DATE DEFAULT NULL',
          'status'                  => 'VARCHAR(255) NOT NULL DEFAULT "created"',
          'time_deleted'            => 'INTEGER DEFAULT NULL',
          'time_create'             => 'INTEGER',
      ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
    }

    public function down()
    {
        $this->dropTable('tbl_widget');
    }
}
