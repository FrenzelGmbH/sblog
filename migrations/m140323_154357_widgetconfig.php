<?php

/**
 * The migration script for the sblog
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m140323_154357_widgetconfig extends \yii\db\Migration
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

      $this->createTable('{{%widget}}',array(
          'id'                      => Schema::TYPE_PK,
          'name'                    => Schema::TYPE_STRING .'(200)',          
          'wgt_table'               => Schema::TYPE_INTEGER.' NULL',
          'wgt_id'                  => Schema::TYPE_INTEGER.' NULL',
          'param1_str'              => Schema::TYPE_STRING .'(200)',
          'param2_int'              => Schema::TYPE_INTEGER.' NULL',
          'param3_date'             => Schema::TYPE_DATE.' NULL',
          'status'                  => Schema::TYPE_STRING .'(255) NOT NULL DEFAULT "created"',
          'time_deleted'            => Schema::TYPE_INTEGER.' NULL',
          'created_at'             => Schema::TYPE_INTEGER.' NULL',
      ),$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%widget}}');
    }
}
