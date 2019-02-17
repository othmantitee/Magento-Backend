<?php
/**
 * Created by PhpStorm.
 * User: othman
 * Date: 2/12/19
 * Time: 2:19 PM
 */

namespace CMagento\Author\Setup;


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
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '2.3.0') < 0) {
                $installer->getConnection()->addColumn(
                    $installer->getTable('cmagento_author'),
                    'image',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 255,
                        'default' => '',
                        'nullable' => false,
                        'comment' => 'Image'
                    ]

                );
        }
        $installer->endSetup();
    }
}