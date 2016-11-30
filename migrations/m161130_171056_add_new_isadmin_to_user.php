<?php

use yii\db\Migration;

class m161130_171056_add_new_isadmin_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'isAdminActual', 'integer');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'isAdminActual');
    }

}
