<?php

use Phinx\Migration\AbstractMigration;

class LightUrlMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('lu_url', array('id' => false, 'primary_key' => array('id')));
        $table->addColumn('id', 'integer', array('identity' => true))
            ->addColumn('heavy_url', 'string', array('limit' => 250))
            ->addColumn('short_key', 'string', array('limit' => 250))
            ->addColumn('user', 'integer', array('limit' => 11))
            ->addColumn('created_at','datetime',array('default' => 'CURRENT_TIMESTAMP'))
            ->addIndex(array('id'), array('unique' => true))
            ->addIndex(array('short_key'), array('unique' => true))
            ->addIndex(array('heavy_url'), array('unique' => true))
            ->create();
    }

}


