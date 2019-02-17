<?php
/**
 *
 *
 */
namespace ITGSoftware\Brands\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Upgrade the magento2fresh DB schema
 */

    class UpgradeSchema implements UpgradeSchemaInterface
    {
        /**
         * {@inhertidoc}
         *
         * @param SchemaSetupInterface $setup
         * @param ModuleContextInterface $context
         * @return void
         */
        public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context)
        {
            $setup->startSetup();
            if(version_compare($context->getVersion(),'2.0.0','<')){
                $setup->getConnection()->addColumn(
                    $setup->getTable('itg_brands_brand'),
                    'email',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 64,
                        'nullable' => false,
                        'default' => '',
                        'comment' => 'Official Email'
                    ]
                );

                $setup->endSetup();
            }
        }
    }