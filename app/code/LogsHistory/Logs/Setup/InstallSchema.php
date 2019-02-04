<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 2:03 PM
 */

namespace LogsHistory\Logs\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(!$setup->tableExists('logshistory_log_entries')){
            $table = $setup->getConnection()->newTable(
                $setup->getTable('logshistory_log_entries')
            )
                ->addColumn(
                    'entry_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Log Entry ID'
                )
                ->addColumn(
                    'ip_address',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    15,
                    ['nullable => false'],
                    'IP Address'
                )
                ->addColumn(
                    'user_agent',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'User Agent'
                )
                ->addColumn(
                    'entry_date',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '255',
                    [],
                    'Entry Date'
                )->setComment('Logs Entry Table');
            $setup->getConnection()->createTable($table);

        }
        $setup->endSetup();
    }
}