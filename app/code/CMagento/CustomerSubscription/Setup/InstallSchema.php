<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 1/30/19
 * Time: 2:03 PM
 */

namespace CMagento\CustomerSubscription\Setup;


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
        if(!$setup->tableExists('customer_subscriptions')){
            $table = $setup->getConnection()->newTable(
                $setup->getTable('customer_subscriptions')
            )
                ->addColumn(
                    'subscription_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Log Entry ID'
                )->addColumn(
                    'customer_fk_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Log Entry ID'
                )
                ->addColumn(
                    'type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Subscription Type'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                    null,
                    ['nullable => false'],
                    'Date of Creation'
                )->setComment('Customer Subscription Table');
            $setup->getConnection()->createTable($table);

            $setup->getConnection()->addForeignKey(
                $setup->getFkName(
                    'customer_subscriptions',
                    'customer_fk_id',
                    'customer_entity',
                    'entity_id'),
                $setup->getTable('customer_subscriptions'),
                'customer_fk_id',
                $setup->getTable('customer_entity'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
        }
        $setup->endSetup();
    }
}