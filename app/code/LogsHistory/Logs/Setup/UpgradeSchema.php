<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 3:51 PM
 */

namespace LogsHistory\Logs\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $setup->startSetup();

        if(version_compare($context->getVersion(), '1.3.0', '<')) {

            $setup->getConnection()->changeColumn(
                'logshistory_log_entries',
                'customer_Id',
                'customer_fk_id',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true,
                ]
            );

            $setup->getConnection()->addForeignKey(
                $setup->getFkName(
                    'logshistory_log_entries',
                    'customer_fk_id',
                    'customer_entity',
                    'entity_id'),
                $setup->getTable('logshistory_log_entries'),
                'customer_fk_id',
                $setup->getTable('customer_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
        }
        $setup->endSetup();

    }
}
